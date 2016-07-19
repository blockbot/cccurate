<?php 

/* template name: MVS */

get_header();

?>

<div id="content" class="stack-full-width">

	<?php

		date_default_timezone_set('America/New_York'); // CDT
		$current_date = date('m/d/Y -- H:i:s');

		$datetime = new DateTime('tomorrow');
		echo $datetime->format('d-m-Y H:i:s');

		echo $current_date;
		$xml = file_get_contents("http://gdata.youtube.com/feeds/api/videos/JWNm5DUSZkc");
		$vimeo = file_get_contents("http://vimeo.com/api/v2/video/118394841.php");
		$vimeo_video_data = unserialize($vimeo);

		$temp = $wp_query; 
		$wp_query = null; 
		$wp_query = new WP_Query(); 
  		$args = array( 
			'post_type' => 'video',
			'tag' => 'music-video'
		);
		// the query
		$wp_query -> query($args);

		diebug($wp_query->posts);
		//diebug($wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'stream-video' AND post_status = 'publish'"));

		// $p = xml_parser_create();
		// xml_parse_into_struct($p, $xml, $vals, $index);
		// xml_parser_free($p);

		diebug($vimeo_video_data[0]["duration"]);


		$temp = $wp_query; 
		$wp_query = null; 
		$wp_query = new WP_Query(); 
  		$args = array( 
			'post_type' => 'stream-video',
			'posts_per_page' => 1,
			'order' => 'DESC',
			'paged' => $paged
		);
		// the query
		$wp_query -> query($args);

		?>

		<?php if ( $wp_query->have_posts() ) : ?>

			<!-- the loop -->
			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<div id="post" data-post-id="<?php echo $post->ID; ?>">

					<?php

						$custom_field["Video Source"] = get_post_meta($post->ID, 'Video Source', true);

						switch ($custom_field["Video Source"]) {

							case 'Youtube':
								
								$custom_field["Youtube ID"] = get_post_meta($post->ID, 'Youtube ID', true);
								$thumb_src = 'http://img.youtube.com/vi/' . $custom_field["Youtube ID"] . '/maxresdefault.jpg';
								$video_src = '//www.youtube.com/embed/' . $custom_field["Youtube ID"] . "?rel=0&showinfo=1&autoplay=1";

								break;

							case 'Vimeo':
								
								$custom_field["Vimeo ID"] = get_post_meta($post->ID, 'Vimeo ID', true);
								$vimeo_video = file_get_contents("http://vimeo.com/api/v2/video/" . $custom_field["Vimeo ID"] . ".php");
								
								if($vimeo_video === FALSE) {  
									break;
								}
								
								$vimeo_video_data = unserialize($vimeo_video);
								$thumb_src = $vimeo_video_data[0]["thumbnail_large"];
								$video_src = "//player.vimeo.com/video/" . $custom_field["Vimeo ID"] . "?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff;";

								break;

							default:
								break;
						
						}
						
					?>

					<?php // diebug($thumb_src); ?>

					<div class="video-container">

						<iframe src="<?php echo $video_src; ?>" 
						width="500" 
						height="281"
						frameborder="0">
						</iframe>

					</div>

				</div>

	<?php endwhile; endif; ?>

	<!-- end of the loop -->

	<?php wp_reset_postdata(); ?>

</div>

<?php get_footer(); ?>