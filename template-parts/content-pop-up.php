<?php $alert = wp_cache_get( 'alert' ); ?>

<?php if ( isset( $alert ) ): ?>

	<script>
    	
    	$( document ).ready( function() {

			if ( typeof Cookies.get( 'csd_pop_up_visited_<?php echo $alert['id'] ?>' ) === 'undefined' ) {
			  
				const urlParams = new URLSearchParams(window.location.search);
				
				const myParam = urlParams.get('csd_pop');
				
				if ( myParam == <?php echo $alert['id']; ?> ) {
				  
				   Cookies.set( 'csd_pop_up_visited_<?php echo $alert['id'] ?>', 1, { expires: 365 } );
				  
				} else {
				  
				  Cookies.set( 'csd_pop_up_visited_<?php echo $alert['id'] ?>', 0, { expires: 365 } );
				  
				}
			  			
			}
			
			if ( parseInt( Cookies.get( 'csd_pop_up_visited_<?php echo $alert['id'] ?>' ) ) == 0 ) {
				
				setTimeout( function() {
					
					$( '#modalPopup' ).modal( 'show' );
				
				}, 500 );
			
			}
			
			$( '#modalPopup' ).on( 'hide.bs.modal', function ( e ) {
				
				Cookies.set( 'csd_pop_up_visited_<?php echo $alert['id'] ?>', 1, { expires: 365 } );
			
			} );
			
			$( '.btn-popup').on( 'click', function ( e ) {
			
				Cookies.set( 'csd_pop_up_visited_<?php echo $alert['id'] ?>', 1, { expires: 365 } );
				
			} );
	
	  } );
	  
	</script>
	
	<div class="modal fade" id="modalPopup" tabindex="-1" role="dialog" aria-labelledby="modalPopup" aria-hidden="true">
	
		<div class="modal-dialog" role="document">
	
			<div class="modal-content">
	
				<?php if ( $alert['acf']['alert_image_url'] ): ?>
	
					<div class="modal-header p-0">
	
						<div class="d-flex w-100 h-100 justify-content-center">
	
							<img src="<?php echo $alert['acf']['alert_image_url']; ?>" class="img-fluid w-100" />
	
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
	
					<h4 class="font-weight-bold text-uppercase text-primary"><?php echo $alert['acf']['alert_sub_title']; ?></h4>
	'
					<h3 class="mb-0"><?php echo $alert['acf']['alert_title']; ?></h3>
	
				</div>
	
				<div class="modal-footer justify-content-center">
	
					<?php if ( $alert['acf']['link_to_post'] ): ?>
	
						<div class="mr-1">
	
							<a href="#" class="btn btn-dark btn-lg" data-dismiss="modal" aria-label="Close"><?php _e('Close','csdschools'); ?></a>
	
						</div>
	
						<div>
	
							<a href="<?php echo $alert['acf']['link']; ?>?csd_pop=<?php echo $alert['id']; ?>" class="btn-popup btn btn-primary btn-lg" <?php echo ( $alert['acf']['link_type'] == 'External' ? 'target="_blank"' : '' ); ?>><?php _e('Details','csdschools'); ?></a>
	
						</div>
	
					<?php else: ?>
	
						<a href="#" class="btn btn-dark btn-lg btn-block" data-dismiss="modal" aria-label="Close"><?php _e('Close','csdschools'); ?></a>
	
					<?php endif; ?>
	
				</div>
	
			</div>
	
		</div>
	
	</div>
	
<?php endif; ?>