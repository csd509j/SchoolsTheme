<?php 

if ( get_sub_field('type') == 'Vimeo' ) {

	$url = 'https://player.vimeo.com/video/' . get_sub_field('video_id') . '?title=0&byline=0&portrait=0&badge=0';

} elseif ( get_sub_field('type') == 'Youtube' ) {
	
	$url = 'https://www.youtube.com/embed/' . get_sub_field('video_id') . '?rel=0&amp;controls=0&amp;showinfo=0';
} 

?>
<div class="embed-responsive embed-responsive-16by9 my-2">
	<iframe class="embed-responsive-item" src="<?php echo $url; ?>" title="<?php echo esc_attr( get_sub_field('type') == 'Vimeo' ? __( 'Vimeo video player', 'csdschools' ) : __( 'YouTube video player', 'csdschools' ) ); ?>"></iframe>
</div>