<?php get_header(); ?>

<div id="content" class="post-detail">

	<?php while (have_posts()) : the_post(); ?>  	

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
						$video_src = "//player.vimeo.com/video/" . $custom_field["Vimeo ID"] . "?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff;&amp;autoplay=1";

						break;

					case 'Vine':

						$custom_field["Vine ID"] = get_post_meta($post->ID, 'Vine ID', true);
						$vine_video = @file_get_contents("https://vine.co/oembed.json?url=https%3A%2F%2Fvine.co%2Fv%2F" . $custom_field["Vine ID"] . "&omit_script=true");

						if($vine_video === FALSE) {  
							break;
						}

						$vine_video_data = json_decode($vine_video);
						$thumb_src = $vine_video_data->thumbnail_url;
						$video_src = $vine_video_data->html;

						break;

					case 'Instagram':

						$custom_field["Instagram ID"] = get_post_meta($post->ID, 'Instagram ID', true);
						$instagram_video = @file_get_contents("http://api.instagram.com/oembed?url=http://instagr.am/p/" . $custom_field["Instagram ID"] . "/&omitscript=true");

						if($instagram_video === FALSE) {  
							break;
						}

						$instagram_video_data = json_decode($instagram_video);
						$thumb_src = $instagram_video_data->thumbnail_url;
						$video_src = $instagram_video_data->html;

						break;

					default:
						break;
				
				}
				
			?>

							<?php // diebug($thumb_src); ?>


			<div class="<?php echo $custom_field["Video Source"] == "Vine" || $custom_field["Video Source"] == "Instagram" ? "vine-instagram" : "video-container" ?>">

				<?php if($custom_field["Video Source"] == "Vine" || $custom_field["Video Source"] == "Instagram"): ?>

					<?php echo $video_src; ?>

				<?php else: ?>

					<iframe src="<?php echo $video_src; ?>" 
					width="500" 
					height="281"
					frameborder="0">
					</iframe>

				<?php endif; ?>

			</div>

			<h2 id="heading-page"><?php the_title();?></h2>

			<div class="social clearfix">

				<div class="fb-share-button" 
					 data-href="<?php the_permalink(); ?>" 
					 data-layout="button_count">
				</div>

				<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>

			</div>	

			<?php the_content(); ?>

			<div id="newsletter-signup">

				<!-- Begin MailChimp Signup Form -->
				<link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
				<style type="text/css">
					#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
					/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
					   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
				</style>
				<div id="mc_embed_signup">
				<form action="//nyc.us10.list-manage.com/subscribe/post?u=3426458e585da3ea10b5b07c8&amp;id=8ce1d4e22f" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				    <div id="mc_embed_signup_scroll">
					<h2>Get the best videos delivered to your inbox!</h2>
				<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
				<div class="mc-field-group">
					<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
				</label>
					<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
				</div>
					<div id="mce-responses" class="clear">
						<div class="response" id="mce-error-response" style="display:none"></div>
						<div class="response" id="mce-success-response" style="display:none"></div>
					</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
				    <div style="position: absolute; left: -5000px;"><input type="text" name="b_3426458e585da3ea10b5b07c8_8ce1d4e22f" tabindex="-1" value=""></div>
				    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
				    </div>
				</form>
				</div>
				<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
				<!--End mc_embed_signup-->

			</div>

		</div>

	<?php endwhile;?>

	<!-- end of the loop -->

	<?php wp_reset_postdata(); ?>

	<div id="related" class="clearfix">

		<div id="ad-sidebar">

			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Curate - Sidebar -->
			<ins class="adsbygoogle"
			     style="display:inline-block;width:300px;height:250px"
			     data-ad-client="ca-pub-4728203339084155"
			     data-ad-slot="4587401037"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>

		</div>

		<h2>Related Videos</h2>

		<?php

		$post_categories = get_the_category($id);
		$post_category_ids = array();
		
		for($i = 0; $i < count($post_categories); $i++){

			array_push($post_category_ids, $post_categories[$i]->cat_ID);

		}

		$args = array( 
			'category__in' => $post_category_ids,
			'post__not_in' => array($post->ID),
			'post_type' => 'video',
			'posts_per_page' => 10,
			'order' => 'DESC',
			'post_parent'=>0
		);
		// the query
		$videos_query = new WP_Query($args);

		?>

		<?php if ( $videos_query->have_posts() ) : ?>

			<!-- the loop -->
			<?php while ( $videos_query->have_posts() ) : $videos_query->the_post(); ?>

				<div class="related-post clearfix">
						
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

					<div class="related-post-thumb">

						<a href="<?php the_permalink(); ?>" class="screenshot">
							
							<?php if(checkRemoteFile($thumb_src)): ?>

								<img class="lazy" 
								 	 data-original="<?php echo $thumb_src; ?>" 
								 	 src="<?php echo bloginfo("template_url"); ?>/img/lazy.gif">

							<?php else: ?>

								<img class="lazy" 
								 	 data-original="<?php echo bloginfo("template_url") ?>/img/no-thumb.png" 
								 	 src="<?php echo bloginfo("template_url"); ?>/img/lazy.gif">

							<?php endif; ?>

							
						</a>
					
					</div>

					<h2 class="related-post-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>

				</div>	

			<?php endwhile; ?>
			<!-- end of the loop -->

			<?php wp_reset_postdata(); ?>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>	