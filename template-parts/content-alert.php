<?php
$alert = false;

$tz = new DateTimeZone( 'America/Los_Angeles' );

$date_now = new DateTime( 'now', $tz );

$alerts = get_posts( array(
	'post_type' => 'emergency-alert',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'orderby' => 'date',
	'order' => 'DESC',
) );

if ( $alerts ) {

	foreach ( $alerts as $alert_post ) {

		$sites = get_post_meta( $alert_post->ID, 'sites', true );

		if ( ! is_array( $sites ) ) {

			if ( $sites ) {

				$sites = array( $sites );

			} else {

				$sites = array();

			}

		}

		if ( ! in_array( get_bloginfo( 'name' ), $sites, true ) ) {

			continue;

		}

		$start = false;

		$end = false;

		$start_time = get_post_meta( $alert_post->ID, 'start_time', true );

		$end_time = get_post_meta( $alert_post->ID, 'end_time', true );

		if ( ! $start_time || ! $end_time ) {

			continue;

		}

		try {

			$start = new DateTime( $start_time, $tz );

		} catch ( Exception $e ) {

			$start = false;

		}

		try {

			$end = new DateTime( $end_time, $tz );

		} catch ( Exception $e ) {

			$end = false;

		}

		if ( ! $start || ! $end ) {

			continue;

		}

		if ( $start->format( 'Y-m-d H:i:s' ) <= $date_now->format( 'Y-m-d H:i:s' ) && $end->format( 'Y-m-d H:i:s' ) >= $date_now->format( 'Y-m-d H:i:s' ) ) {

			$alert_title = get_post_meta( $alert_post->ID, 'alert_title', true );

			if ( ! $alert_title ) {

				$alert_title = get_the_title( $alert_post->ID );

			}

			$alert_color = get_post_meta( $alert_post->ID, 'alert_color', true );

			if ( ! $alert_color ) {

				$alert_color = 'C36714';

			}

			$alert = array(
				'acf' => array(
					'alert_color' => ltrim( (string) $alert_color, '#' ),
					'alert_sub_title' => (string) get_post_meta( $alert_post->ID, 'alert_sub_title', true ),
					'link_to_post' => get_post_meta( $alert_post->ID, 'link_to_post', true ),
					'link' => (string) get_post_meta( $alert_post->ID, 'link', true ),
					'alert_title' => (string) $alert_title,
				),
			);

			break;

		}

	}

}
?>

<?php if ( $alert ): ?>

	<div class="alert-emergency-body" style="background-color: #<?php echo esc_attr( $alert['acf']['alert_color'] ); ?>">
		
		<div class="container">
		
			<div class="row">
		
				<div class="col-12">
		
					<h4><?php echo esc_html( $alert['acf']['alert_sub_title'] ); ?></h4>	
		
					<?php if ( $alert['acf']['link_to_post'] && $alert['acf']['link'] ): ?>

						<h3>

							<a class="stretched-link" href="<?php echo esc_url( $alert['acf']['link'] ); ?>">

								<?php echo esc_html( $alert['acf']['alert_title'] ); ?>

							</a>

						</h3>
		
					<?php else: ?>

						<h3><?php echo esc_html( $alert['acf']['alert_title'] ); ?></h3>

					<?php endif; ?>
		
				</div>
		
			</div>				

		</div>

	</div>
	
<?php endif; ?>
