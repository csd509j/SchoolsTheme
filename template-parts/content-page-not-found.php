<?php 

$links_col_1 = get_field('popular_pages_list', 'option'); 
$links_col_2 = get_field('popular_resources_list', 'option'); 

?>
<div class="row justify-content-center">
	<div class="col-lg-12 bg-light p-2 mb-2">
		<h2><?php the_field('error_page_title', 'options'); ?></h2>
		<div class="entry-lead">
			<p class="lead"><?php the_field('error_page_message', 'options'); ?></p>
		</div>
		<div id="search-form">
			<form role="search" id="sites-search" class="row no-gutters" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
				<div class="form-group col-md-9 col-lg-10 mb-1 mb-md-0">
					<label class="sr-only" for="search-text">Search</label>
					<input type="text" class="form-control-lg w-100" id="search-text" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s">
				</div>
				<div class="col-md-3 col-lg-2 d-flex align-items-stretch">
					<button type="submit" class="btn btn-primary btn-block">Search</button>
				</div>
			</form>
		</div>	
	</div>
</div>
<div class="row entry-content padding-top-two">
	<div class="col-md-4 col-sm-offset-1">
		<h3>Popular Pages</h3>
		<ul class="list list-flush">
			<?php foreach($links_col_1 as $link): ?>
				<li><a href="<?php echo get_permalink($link); ?>"><?php echo get_the_title($link) ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="col-md-4">
		<h3>Popular Resources</h3>
		<ul class="list list-flush">
			<?php foreach($links_col_2 as $link): ?>
				<li><a target="_blank" href="<?php echo get_permalink($link); ?>"><?php echo get_the_title($link) ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="col-md-4">
		<h3>School Information</h3>
		<p><?php the_field('contact_us_text', 'option'); ?></p>
		<?php the_field('street_address', 'options'); ?><br>	
		<?php the_field('primary_phone', 'options'); ?> - Office<br>
		<?php the_field('attendance_phone', 'options'); ?> - Attendance<br>
	</div>
</div>