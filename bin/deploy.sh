#!/bin/bash
#
# Deploy the committed CSD Schools parent theme to one school's production site,
# or to every school in turn (ServerPilot droplet, *.csd509j.net school sites):
# git archive HEAD → rsync over the site user's SSH key alias → purge caches
# → health check.
#
#   bin/deploy.sh <school>          dry run: list what would change, touch nothing
#   bin/deploy.sh <school> --go     deploy that school for real
#   bin/deploy.sh all [--go]        every school in turn, stopping at the first failure
#   add --verbose to a dry run to list every deleted file
#
# Ships exactly what is committed, never the working tree. Paths marked
# export-ignore in .gitattributes stay behind, and rsync --delete clears anything
# on the server that is not in the export. A --go run snapshots the live theme
# first and restores it if the site stops answering 200.
#
# Adapted from the greengeeks-deploy skill's template; replaces DeployHQ, which
# shipped this repo to every school on each push.

set -euo pipefail

# --- Configuration ----------------------------------------------------------

THEME=csdschools
GITHUB=git@github.com:csd509j/SchoolsTheme.git
GITHUB_KEY=$HOME/.ssh/AbideWebDesign-GitHub
BRANCH=master
MIN_FILES=150
KEEP_SNAPSHOTS=5
CF_PURGE=1                                          # 0 = never purge Cloudflare on deploy

# Every school runs this parent theme under its own child theme. lpms (Linus
# Pauling Middle) is left out on purpose: it has no public hostname.
SCHOOLS="adams bessiecoleman chs cvhs franklin garfield kathrynjonesharrison lincoln mtview cjh"

# HOST is the ~/.ssh/config alias (site user, key only).
configure_target() {
	case $1 in
		cjh)
			HOST=csd509j                            # Corvallis Junior High has its own system user
			WP=/srv/users/csd509j/apps/cjh/public
			URL=https://corvallisjuniorhigh.csd509j.net/
			;;
		adams|bessiecoleman|chs|cvhs|franklin|garfield|kathrynjonesharrison|lincoln|mtview)
			HOST=csd
			WP=/srv/users/csd/apps/$1/public
			URL=https://$1.csd509j.net/
			;;
		*)
			return 1
			;;
	esac
}

# ---------------------------------------------------------------------------

SSH=(ssh -o BatchMode=yes -o LogLevel=ERROR)

die() {
	echo "✗ $*" >&2
	exit 1
}

USAGE="usage: bin/deploy.sh <school>|all [--go] [--verbose] [--skip-push-check]"

TARGET=
GO=0
SKIP_PUSH_CHECK=0
VERBOSE=0
FLAGS=()

for arg in "$@"; do
	case $arg in
		--go) GO=1; FLAGS+=("$arg") ;;
		--skip-push-check) SKIP_PUSH_CHECK=1; FLAGS+=("$arg") ;;
		--verbose) VERBOSE=1; FLAGS+=("$arg") ;;
		-*) die "unknown option: $arg ($USAGE)" ;;
		*)
			[ -z "$TARGET" ] || die "one school or all, not both $TARGET and $arg ($USAGE)"
			TARGET=$arg
			;;
	esac
done

[ -n "$TARGET" ] || die "name a school or all ($USAGE). Schools: $SCHOOLS"

# Each school runs as its own invocation, so a failed health check rolls back
# that school and leaves the ones after it untouched.
if [ "$TARGET" = all ]; then
	for school in $SCHOOLS; do
		echo
		"$0" "$school" ${FLAGS[@]+"${FLAGS[@]}"} || die "stopped at $school — the schools after it were not touched"
	done

	exit 0
fi

configure_target "$TARGET" || die "unknown school: $TARGET. Schools: $SCHOOLS"

DEST=$WP/wp-content/themes/$THEME

cd "$(git rev-parse --show-toplevel)"

grep -q '^Theme Name:' style.css 2>/dev/null || die "run this from the theme repository"

# --- What gets deployed -----------------------------------------------------

if ! git diff --quiet || ! git diff --cached --quiet; then
	die "uncommitted changes to tracked files — commit or stash them first"
fi

if [ $GO = 1 ] && [ "$(git branch --show-current)" != "$BRANCH" ]; then
	die "$TARGET only deploys from $BRANCH"
fi

SHA=$(git rev-parse HEAD)

# Every school runs exactly what GitHub has, so the servers can always be
# rebuilt from the repo.
if [ $SKIP_PUSH_CHECK = 0 ]; then
	GIT_SSH="ssh -o BatchMode=yes"

	if [ -f "$GITHUB_KEY" ]; then
		GIT_SSH="$GIT_SSH -i $GITHUB_KEY -o IdentitiesOnly=yes"
	fi

	REMOTE_SHA=$(GIT_SSH_COMMAND="$GIT_SSH" git ls-remote "$GITHUB" "refs/heads/$BRANCH" 2>/dev/null | cut -f1 || true)

	[ -n "$REMOTE_SHA" ] || die "could not read $BRANCH from GitHub (--skip-push-check to override)"

	[ "$REMOTE_SHA" = "$SHA" ] || die "$TARGET must run what GitHub has on $BRANCH — GitHub is at ${REMOTE_SHA:0:7}, you are at ${SHA:0:7}"
fi

if [ $GO = 1 ]; then
	for f in .gitattributes bin/deploy.sh; do
		git ls-files --error-unmatch "$f" >/dev/null 2>&1 || die "$f is not committed — commit it before a real deploy"
	done
fi

WORK=$(mktemp -d)
trap 'rm -rf "$WORK"' EXIT

EXPORT=$WORK/export
mkdir "$EXPORT"

# --worktree-attributes lets a new .gitattributes shape a dry run before it is
# committed; for --go, the checks above guarantee it matches HEAD.
git archive --worktree-attributes --format=tar HEAD | tar -x -C "$EXPORT"

# An empty or partial export plus --delete would wipe the live theme.
[ -f "$EXPORT/style.css" ] && [ -f "$EXPORT/functions.php" ] || die "export is missing style.css or functions.php — refusing to sync"

FILES=$(find "$EXPORT" -type f | wc -l | tr -d ' ')

[ "$FILES" -ge "$MIN_FILES" ] || die "export has only $FILES files (MIN_FILES=$MIN_FILES) — refusing to sync"

# macOS ships openrsync, which has no --chmod, so the modes are set here and -p
# carries them across.
find "$EXPORT" -type d -exec chmod 755 {} +
find "$EXPORT" -type f -exec chmod 644 {} +

"${SSH[@]}" "$HOST" "grep -q '^Theme Name:' '$DEST/style.css'" || die "$HOST:$DEST does not look like the theme folder"

# --checksum compares content. -t is left off on purpose: unchanged files keep
# their server mtime, so only files that really changed get a new filemtime()
# cache-busting version.
RSYNC=(rsync -rlpz --checksum --delete --itemize-changes -e "${SSH[*]}")

echo "→ $TARGET  ($HOST, $URL)"
echo "  commit  ${SHA:0:7}  $(git log -1 --format=%s)"
echo "  export  $FILES files"
echo

PLAN=$("${RSYNC[@]}" --dry-run "$EXPORT/" "$HOST:$DEST/")

CHANGED=$(echo "$PLAN" | awk '/^[<>]f[^+]/ { print $2 }')
ADDED=$(echo "$PLAN" | awk '/^[<>]f\+/ { print $2 }')
DELETED=$(echo "$PLAN" | sed -n 's/^\*deleting  *//p')
PERMS=$(echo "$PLAN" | grep -c '^\.f' || true)

lines() {
	if [ -n "$1" ]; then
		echo "$1" | wc -l | tr -d ' '
	else
		echo 0
	fi
}

echo "  $(lines "$CHANGED") changed, $(lines "$ADDED") new, $(lines "$DELETED") deleted, $PERMS permission-only"

if [ -n "$CHANGED" ]; then
	echo
	echo "  Changed:"
	echo "$CHANGED" | sed 's/^/    /'
fi

if [ -n "$ADDED" ]; then
	echo
	echo "  New:"
	echo "$ADDED" | sed 's/^/    /'
fi

if [ -n "$DELETED" ]; then
	echo
	echo "  Deleted from the server:"

	if [ $VERBOSE = 1 ]; then
		echo "$DELETED" | sed 's/^/    /'
	else
		# One line per top-level folder with an example, so a large clean-up
		# stays reviewable.
		echo "$DELETED" | awk -F/ '
			{
				key = (NF > 1) ? $1 "/" : $0
				if (!(key in n)) eg[key] = $0
				n[key]++
			}
			END {
				for (k in n) printf "%d\t%s\t%s\n", n[k], k, eg[k]
			}' | sort -t$'\t' -k1,1nr -k2,2 | awk -F'\t' '{ printf "    %5d  %-24s e.g. %s\n", $1, $2, $3 }'

		echo "    (--verbose lists every file)"
	fi
fi

# ACF Extended saves field groups to acf-json/ on the server whenever one is
# edited in production wp-admin, so a difference here may be a live edit.
if printf '%s\n%s\n' "$CHANGED" "$DELETED" | grep -q '^acf-json/'; then
	echo
	echo "  ! acf-json/ differs from the server. If a field group was edited in"
	echo "    production wp-admin, copy the server's file into git first or the"
	echo "    deploy overwrites that edit."
fi

if [ $GO = 0 ]; then
	echo
	echo "Dry run — nothing on $HOST was changed. Deploy with: bin/deploy.sh $TARGET --go"
	exit 0
fi

# --- Deploy -----------------------------------------------------------------

STAMP=$(date +%Y%m%d-%H%M%S)
SNAP=deploy-backups/$THEME-$TARGET-$STAMP.tar.gz

# Sites are moving from QUIC.cloud to Cloudflare one at a time, and LiteSpeed
# Cache is retired after the move, so the caches are found at deploy time rather
# than configured here: LiteSpeed while its plugin is active, and Cloudflare
# (the whole host) once the Abide Cloudflare Purge mu-plugin is configured.
# --url pins each school's host for wp-cli, since some school sites have built
# their URLs from the request host.
PURGE="cd '$WP' || exit 1
if wp --url='$URL' plugin is-active litespeed-cache 2>/dev/null; then
	wp --url='$URL' litespeed-purge all >/dev/null 2>&1 && echo 'LiteSpeed purged' || echo 'LiteSpeed purge FAILED, purge from wp-admin'
fi
if [ $CF_PURGE = 1 ] && wp --url='$URL' eval 'exit( function_exists( \"abide_cf_configured\" ) && abide_cf_configured() ? 0 : 1 );' >/dev/null 2>&1; then
	wp --url='$URL' abide-cf-purge site >/dev/null 2>&1 && echo 'Cloudflare purged' || echo 'Cloudflare purge FAILED, see wp abide-cf-purge status'
fi"

rollback() {
	echo "✗ $1 — restoring the snapshot" >&2
	"${SSH[@]}" "$HOST" "set -e; T=\$(mktemp -d); tar -xzf ~/$SNAP -C \$T; rsync -rlpt --delete \$T/$THEME/ '$DEST/'; rm -rf \$T" >/dev/null
	"${SSH[@]}" "$HOST" "$PURGE" >/dev/null || true
	die "rolled back — $TARGET is on its previous code (snapshot kept at ~/$SNAP)"
}

echo
echo "→ snapshot  ~/$SNAP"
"${SSH[@]}" "$HOST" "mkdir -p ~/deploy-backups && tar -czf ~/$SNAP -C '$WP/wp-content/themes' '$THEME' && ls -1t ~/deploy-backups/$THEME-$TARGET-*.tar.gz | tail -n +$((KEEP_SNAPSHOTS + 1)) | xargs -r rm -f"

echo "→ sync"
"${RSYNC[@]}" "$EXPORT/" "$HOST:$DEST/" >/dev/null || rollback "sync failed partway"

echo "→ purge caches"
PURGED=$("${SSH[@]}" "$HOST" "$PURGE" || true)

if [ -n "$PURGED" ]; then
	echo "$PURGED" | sed 's/^/  /'
else
	echo "  none active"
fi

echo "→ health check"
CODE=$(curl -s -o "$WORK/health.html" -w '%{http_code}' --max-time 30 "$URL?deploy=$STAMP" || true)

if [ "$CODE" != 200 ] || grep -q 'There has been a critical error' "$WORK/health.html"; then
	rollback "$URL answered $CODE after the deploy"
fi

"${SSH[@]}" "$HOST" "echo '$STAMP ${SHA:0:7} $(whoami) $THEME $TARGET' >> ~/deploy-backups/deploy.log"

echo "✓ $TARGET is on ${SHA:0:7}  (snapshot ~/$SNAP)"

# Theme CSS/JS carry filemtime() versions, so only cached HTML can be stale.
EDGE=$(curl -sI --max-time 15 "$URL" | tr -d '\r' | awk -F': ' 'tolower($1) == "server" { print tolower($2) }')

case $EDGE in
	cloudflare)
		if ! echo "$PURGED" | grep -q '^Cloudflare purged'; then
			echo "  Cloudflare fronts the site: cached HTML expires within 2 hours, or purge"
			echo "  the URL in Cloudflare → Caching → Configuration → Custom Purge."
		fi
		;;
	sucuri*)
		echo "  Sucuri fronts the site: clear its cache from the Sucuri dashboard if a"
		echo "  page's markup must change right away."
		;;
esac
