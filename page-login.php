<?php
/**
 * Template Name: Login 
 *
 * @package WordPress
 * @subpackage CSD Schools
 * @since CSD Schools 1.0
 */

if ( is_user_logged_in() ):
	wp_redirect(home_url() . '/wp-admin');
	exit;	
endif;

get_header(); ?>

<div id="primary" class="content-area py-2">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-6 bg-light pt-2">
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();
			
					if ( ! is_user_logged_in() ): // Display WordPress login form:
					
					?>
					
					<h2 class="text-center mb-1"><?php _e('Sign in','csdschools'); ?></h2>
					
					<?php if(isset($_GET['login']) && $_GET['login'] == 'failed'): ?>
					
						<div class="alert alert-danger">
							<strong>ERROR</strong>: <?php _e('Your Username and Password combination is incorrect','csdschools'); ?>.
						</div>
						
					<?php endif; ?>
					
					<?php 
					    $args = array(
					        'redirect' => home_url() . '/wp-admin', 
					        'form_id' => 'loginform',
					        'label_username' => __( 'Username', 'csdschools' ),
					        'label_password' => __( 'Password', 'csdschools' ),
					        'label_remember' => __( 'Remember Me', 'csdschools' ),
					        'label_log_in' => __( 'Sign in', 'csdschools' ),
					        'remember' => true
					    );
					    
					    wp_login_form( $args );
					
						?>
						
						<p class="meta text-center pt-1"><a href="<?php echo wp_lostpassword_url(); ?>" title="Lost Password"><?php _e('Forgot password?','csdschools'); ?></a></p>

					<?php
					
					else: 
						// If logged in:
						
						wp_redirect( home_url() ); 
						exit;
					
					endif;
		
				endwhile;
				
				?>
			</div>
		</div>			
	</div>		
</div>
<?php get_footer(); ?>