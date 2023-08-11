<?php $alert = wp_cache_get( 'alert' ); ?>

<?php if ( $alert ): ?>

	<div class="alert-emergency-body" style="background-color: #<?php echo $alert['acf']['alert_color']; ?>">
		
		<div class="container">
		
			<div class="row">
		
				<div class="col-12">
		
					<h4><?php echo $alert['acf']['alert_sub_title']; ?></h4>	
		
					<h3>
		
						<?php if ( $alert['acf']['link_to_post'] ): ?>
		
							<a class="stretched-link" href="<?php echo $alert['acf']['link']; ?>">
		
						<?php endif; ?>
				
						<?php echo $alert['acf']['alert_title']; ?>
						
						<?php if ( $alert['acf']['link_to_post'] ): ?>
		
							</a>
		
						<?php endif; ?>
		
					</h3>
		
				</div>
		
			</div>				

		</div>

	</div>
	
<?php endif; ?>