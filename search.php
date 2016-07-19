<?php

get_header(); 

?>

<div id="content" class="stack-full-width">

	<h2 id="heading-page">Search Results:</h2>

	<div class="posts">

		<?php
			global $wp_query;
			$total_results = $wp_query;
		?>

		<?php if ( $total_results->have_posts() ) : ?>

			<!-- the loop -->
			<?php while ( $total_results->have_posts() ) : $total_results->the_post(); ?>	

				<div class="post">

					<div class="post-content">

						<?php get_template_part( 'templates/video', 'thumb' ); ?>

					</div>

				</div>	

			<?php endwhile; ?>
			<!-- end of the loop -->

			<?php wp_reset_postdata(); ?>

		<?php else: ?>

			<div class="post">

				<div class="post-content">

					<h2 class="title-no-results">Sorry, we couldn't find any results. Here is a random video to make up for it.</h2>

					<?php

					$args = array( 
						'post_type' => 'video',
						'posts_per_page' => 1,
						'orderby' => 'rand',
						'post_parent'=>0
					);
					// the query
					$videos_query = new WP_Query($args);

					?>

					<?php if ( $videos_query->have_posts() ) : ?>

						<!-- the loop -->
						<?php while ( $videos_query->have_posts() ) : $videos_query->the_post(); ?>


							<?php

								$custom_field["Video Source"] = get_post_meta($post->ID, 'Video Source', true);
								
								switch ($custom_field["Video Source"]) {

									case 'Youtube':
										
										$custom_field["Youtube ID"] = get_post_meta($post->ID, 'Youtube ID', true);
										$thumb_src = 'http://img.youtube.com/vi/' . $custom_field["Youtube ID"] . '/maxresdefault.jpg';

										break;

									case 'Vimeo':
										
										$custom_field["Vimeo ID"] = get_post_meta($post->ID, 'Vimeo ID', true);
										$vimeo_video = file_get_contents("http://vimeo.com/api/v2/video/" . $custom_field["Vimeo ID"] . ".php");
										$vimeo_video_data = unserialize($vimeo_video);
										$thumb_src = $vimeo_video_data[0]["thumbnail_large"];

										break;

									default:
										break;
								
								}
								
							?>

							<a href="<?php the_permalink(); ?>" class="screenshot">
								
								<?php $custom_field["Youtube ID"] = get_post_meta($post->ID, 'Youtube ID', true); ?>
								<img src="<?php echo $thumb_src; ?>">

							</a>

							<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>

						<?php endwhile; ?>
						<!-- end of the loop -->

						<?php wp_reset_postdata(); ?>

					<?php endif; ?>

				</div>

			</div>	

		<?php endif; ?>

		<div class="next-posts">	
    		<?php next_posts_link('') ?>
		</div>

	</div>	

<?php get_footer(); ?>	