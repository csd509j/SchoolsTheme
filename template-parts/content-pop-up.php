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

				$sites = preg_split( '/\s*<br\s*\/?>\s*|\r\n|\r|\n|,/', wp_strip_all_tags( (string) $sites ) );

				$sites = array_filter( array_map( 'trim', $sites ) );

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

		$alert_type = (string) get_post_meta( $alert_post->ID, 'alert_type', true );

		if ( ! in_array( $alert_type, array( 'Pop-up', 'Both' ), true ) ) {

			continue;

		}

		if ( $start->format( 'Y-m-d H:i:s' ) <= $date_now->format( 'Y-m-d H:i:s' ) && $end->format( 'Y-m-d H:i:s' ) >= $date_now->format( 'Y-m-d H:i:s' ) ) {

			$alert_title = get_post_meta( $alert_post->ID, 'alert_title', true );

			if ( ! $alert_title ) {

				$alert_title = get_the_title( $alert_post->ID );

			}

			$pop_up_image_url = (string) get_post_meta( $alert_post->ID, 'pop_up_image_url', true );

			if ( ! $pop_up_image_url ) {

				$pop_up_image_id = (int) get_post_meta( $alert_post->ID, 'pop_up_image', true );

				if ( $pop_up_image_id ) {

					$pop_up_image_url = (string) wp_get_attachment_image_url( $pop_up_image_id, 'full' );

				}

			}

			$alert = array(
				'id' => (int) $alert_post->ID,
				'acf' => array(
					'pop_up_image_url' => $pop_up_image_url,
					'alert_sub_title' => (string) get_post_meta( $alert_post->ID, 'alert_sub_title', true ),
					'alert_title' => (string) $alert_title,
					'link_to_post' => get_post_meta( $alert_post->ID, 'link_to_post', true ),
					'link' => (string) get_post_meta( $alert_post->ID, 'link', true ),
					'link_type' => (string) get_post_meta( $alert_post->ID, 'link_type', true ),
				),
			);

			break;

		}

	}

}
?>

<?php if ( $alert ): ?>

	<script>
    	
    	$( document ).ready( function() {

			if ( typeof Cookies.get( 'csd_pop_up_visited_<?php echo (int) $alert['id']; ?>' ) === 'undefined' ) {
			  
				const urlParams = new URLSearchParams(window.location.search);
				
				const myParam = urlParams.get('csd_pop');
				
				if ( myParam == <?php echo (int) $alert['id']; ?> ) {
				  
				   Cookies.set( 'csd_pop_up_visited_<?php echo (int) $alert['id']; ?>', 1, { expires: 365 } );
				  
				} else {
				  
				  Cookies.set( 'csd_pop_up_visited_<?php echo (int) $alert['id']; ?>', 0, { expires: 365 } );
				  
				}
			  			
			}
			
			if ( parseInt( Cookies.get( 'csd_pop_up_visited_<?php echo (int) $alert['id']; ?>' ) ) == 0 ) {
				
				setTimeout( function() {
					
					$( '#modalPopup' ).modal( 'show' );
				
				}, 500 );
			
			}
			
			$( '#modalPopup' ).on( 'hide.bs.modal', function ( e ) {
				
				Cookies.set( 'csd_pop_up_visited_<?php echo (int) $alert['id']; ?>', 1, { expires: 365 } );
			
			} );
			
			$( '.btn-popup').on( 'click', function ( e ) {
			
				Cookies.set( 'csd_pop_up_visited_<?php echo (int) $alert['id']; ?>', 1, { expires: 365 } );
				
			} );
	
	  } );
	  
	</script>
	
	<div class="modal fade" id="modalPopup" tabindex="-1" role="dialog" aria-labelledby="modalPopupLabel" aria-hidden="true">
	
		<div class="modal-dialog" role="document">
	
			<div class="modal-content">
	
				<?php if ( $alert['acf']['pop_up_image_url'] ): ?>
	
					<div class="modal-header p-0">
	
						<div class="d-flex w-100 h-100 justify-content-center">
	
							<img src="<?php echo esc_url( $alert['acf']['pop_up_image_url'] ); ?>" class="img-fluid w-100" alt="" />
	
						</div>
	
					</div>		
	
				<?php else: ?>
	
					<div class="modal-header bg-dark py-3">
	
						<div class="d-flex w-100 h-100 justify-content-center">
	
							<i class="fas fa-comment-alt fa-3x text-white"></i>
	
						</div>
	
					</div>						
	
				<?php endif; ?>
	
				<div class="modal-body p-2 text-center">
	
					<h4 class="font-weight-bold text-uppercase text-primary"><?php echo esc_html( $alert['acf']['alert_sub_title'] ); ?></h4>

					<h3 id="modalPopupLabel" class="mb-0"><?php echo esc_html( $alert['acf']['alert_title'] ); ?></h3>
	
				</div>
	
				<div class="modal-footer justify-content-center">
	
					<?php if ( $alert['acf']['link_to_post'] && $alert['acf']['link'] ): ?>
	
						<div class="mr-1">
	
							<a href="#" class="btn btn-dark btn-lg" data-dismiss="modal" aria-label="Close"><?php _e('Close','csdschools'); ?></a>
	
						</div>
	
						<div>
	
							<a href="<?php echo esc_url( $alert['acf']['link'] . '?csd_pop=' . (int) $alert['id'] ); ?>" class="btn-popup btn btn-primary btn-lg" <?php echo ( 'External' == $alert['acf']['link_type'] ? 'target="_blank"' : '' ); ?>><?php _e( 'Details','csdschools' ); ?></a>
	
						</div>
	
					<?php else: ?>
	
						<a href="#" class="btn btn-dark btn-lg btn-block" data-dismiss="modal" aria-label="Close"><?php _e('Close','csdschools'); ?></a>
	
					<?php endif; ?>
	
				</div>
	
			</div>
	
		</div>
	
	</div>
	
<?php endif; ?>
