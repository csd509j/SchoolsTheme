<?php
/**
 * Template Name: Password Reset 
 *
 * @package WordPress
 * @subpackage CSD Schools
 * @since CSD Schools 1.0
 */

get_header(); ?>

<div id="primary" class="content-area py-2">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-6 bg-light py-2">
				<h2 class="text-center mb-1"><?php _e('Password Reset','csdschools'); ?></h2>		
					<?php
					
					global $wpdb;
					
					$error = '';
					$success = '';
					
					// check if we're in reset form
					if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] ):
						$email = trim($_POST['user_login']);
						
						if( empty( $email ) ):
							
							$error = 'Enter a username or e-mail address..';
						
						elseif( ! is_email( $email )):
							
							$error = 'Invalid username or e-mail address.';
						
						elseif( ! email_exists( $email ) ):
							
							$error = 'There is no user registered with that email address.';
						
						else:
							
							$random_password = wp_generate_password( 12, false );
							$user = get_user_by( 'email', $email );
							
							$update_user = wp_update_user( array (
									'ID' => $user->ID, 
									'user_pass' => $random_password
								)
							);
							
							// if  update user return true then lets send user an email containing the new password
							if( $update_user ):
								$to = $email;
								$subject = 'Your new password';
								$sender = get_option('name');
								
								$message = 'Your new password is: '.$random_password;
								
								$headers[] = 'MIME-Version: 1.0' . "\r\n";
								$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								$headers[] = "X-Mailer: PHP \r\n";
								$headers[] = 'From: '.$sender.' < '.$email.'>' . "\r\n";
								
								$mail = wp_mail( $to, $subject, $message, $headers );
								if( $mail )
									$success = 'Check your email address for your new password.';
									
							else
								$error = 'Something went wrong updating your account.';
							endif;
							
						endif;
						
						if( ! empty( $error ) )
							echo '<div class="alert alert-danger"><p class="error"><strong>ERROR:</strong> '. $error .'</p></div>';
						
						if( ! empty( $success ) )
							echo '<div class="alert alert-warning"><p class="success">'. $success .'</p></div>';
					
					endif;
				?>

				<!--html code-->
				<form method="post">
					<p><?php _e('Please enter your username or email address. You will receive an email your new password.','csdschools'); ?></p>
					<div class="form-group">
						<label for="user_login"><?php _e('Username or Email','csdschools'); ?>:</label>
						<?php $user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : ''; ?>
						<input type="text" name="user_login" id="user_login" class="form-control" value="<?php echo $user_login; ?>" />
					</div>
					<input type="hidden" name="action" value="reset" />
					<input type="submit" value="<?php _e('Get New Password','csdschools'); ?>" class="btn btn-primary btn-lg btn-block" id="submit" />
				</form>
				<p class="meta text-center pt-2 mb-0"><a href="<?php echo home_url('/login'); ?>">Back to Login</a></p>
			</div>
		</div>			
	</div>		
</div>
<?php get_footer(); ?>