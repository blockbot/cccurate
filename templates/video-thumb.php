<?php

	$custom_field["Video Source"] = get_post_meta($post->ID, 'Video Source', true);
	
	switch ($custom_field["Video Source"]) {

		case 'Youtube':
			
			$custom_field["Youtube ID"] = get_post_meta($post->ID, 'Youtube ID', true);
			$thumb_src = 'http://img.youtube.com/vi/' . $custom_field["Youtube ID"] . '/maxresdefault.jpg';

			break;

		case 'Vimeo':
			
			$custom_field["Vimeo ID"] = get_post_meta($post->ID, 'Vimeo ID', true);
			$vimeo_video = @file_get_contents("http://vimeo.com/api/v2/video/" . $custom_field["Vimeo ID"] . ".php");
			
			if($vimeo_video === FALSE) {  
				break;
			}
			
			$vimeo_video_data = unserialize($vimeo_video);
			$thumb_src = $vimeo_video_data[0]["thumbnail_large"];

			break;

		case 'Vine':

			$custom_field["Vine ID"] = get_post_meta($post->ID, 'Vine ID', true);
			$vine_video = @file_get_contents("https://vine.co/oembed.json?url=https%3A%2F%2Fvine.co%2Fv%2F" . $custom_field["Vine ID"] . "&omit_script=true");

			if($vine_video === FALSE) {  
				break;
			}

			$vine_video_data = json_decode($vine_video);
			$thumb_src = $vine_video_data->thumbnail_url;

			break;

		case 'Instagram':

			$custom_field["Instagram ID"] = get_post_meta($post->ID, 'Instagram ID', true);
			$instagram_video = @file_get_contents("http://api.instagram.com/oembed?url=http://instagr.am/p/" . $custom_field["Instagram ID"] . "/&omitscript=true");


			if($instagram_video === FALSE) {  
				break;
			}

			$instagram_video_data = json_decode($instagram_video);
			$thumb_src = $instagram_video_data->thumbnail_url;

			break;

		default:
			break;
	
	}
	
?>

<a href="<?php the_permalink(); ?>" 
	class="screenshot <?php echo $custom_field["Video Source"] == "Vine" || "Instagram" ? "vine-instagram" : "" ?>">
							
	<?php if(checkRemoteFile($thumb_src)): ?>

		<img class="lazy" 
		 	 data-original="<?php echo $thumb_src; ?>" 
		 	 src="<?php echo bloginfo("template_url"); ?>/img/lazy.gif">

	<?php else: ?>

		<img class="lazy" 
		 	 data-original="<?php echo bloginfo("template_url") ?>/img/no-thumb.png" 
		 	 src="<?php echo bloginfo("template_url"); ?>/img/lazy.gif">

	<?php endif; ?>

	<?php 

		$video_length = get_post_meta($post->ID, 'Video Length', true); 
		$video_minutes = floor($video_length / 60);
		$video_seconds_remainder = $video_length % 60;

		if($video_seconds_remainder < 10){
			$video_seconds_remainder = "0" . $video_seconds_remainder;
		}

	?>

	<p class="video-length-label">
		<?php echo $video_minutes . ":" . $video_seconds_remainder; ?>
	</p>

</a>

<div class="category-links">
	<?php the_category(' '); ?>
</div>	

<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>