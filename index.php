<?php get_header(); ?>

<div id="content" class="stack-full-width">

	<h2 id="heading-page">Latest</h2>

	<div class="posts">

		<?php

		$temp = $wp_query; 
		$wp_query = null; 
		$wp_query = new WP_Query(); 
		$length = $_GET["length"];
		
		switch ($length) {

			case 'short':

				$args = array( 
					'post_type' => 'video',
					'posts_per_page' => 5,
					'order' => 'DESC',
					'paged' => $paged,
					'meta_query' => array(
						array(
							'key' => 'Video Length',
							'value' => '60',
							'type' => 'NUMERIC',
							'compare' => '<'
						)
					)
				);
				break;

			case 'medium':
				$args = array( 
					'post_type' => 'video',
					'posts_per_page' => 5,
					'order' => 'DESC',
					'paged' => $paged,
					'meta_query' => array(
						array(
							'key' => 'Video Length',
							'value' => '60',
							'type' => 'NUMERIC',
							'compare' => '>='
						),
						array(
							'key' => 'Video Length',
							'value' => '300',
							'type' => 'NUMERIC',
							'compare' => '<='
						)
					)
				);
				break;

			case 'long':
				$args = array( 
					'post_type' => 'video',
					'posts_per_page' => 5,
					'order' => 'DESC',
					'paged' => $paged,
					'meta_query' => array(
						array(
							'key' => 'Video Length',
							'value' => '300',
							'type' => 'NUMERIC',
							'compare' => '>'
						)
					)
				);
				break;
			
			default:
				$args = array( 
					'post_type' => 'video',
					'posts_per_page' => 5,
					'order' => 'DESC',
					'paged' => $paged
				);
				break;
		
		}

		// the query
		$wp_query -> query($args);

		?>

		<?php if ( $wp_query->have_posts() ) : ?>

			<!-- the loop -->
			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<div class="post">

					<div class="post-content">

						<?php get_template_part( 'templates/video', 'thumb' ); ?>

					</div>

				</div>	

			<?php endwhile; ?>
			<!-- end of the loop -->

			<div class="next-posts">
				<?php $next_video_link = str_replace("page", "video/page", get_next_posts_page_link()); ?>	
				<a class="first" href="<?php echo $next_video_link; ?>"></a>
			</div>

		<?php endif; ?>

	</div>

</div>

<?php get_footer(); ?>