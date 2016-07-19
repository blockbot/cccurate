<?php get_header(); ?>

<div id="content" class="stack-full-width">

	<h2 id="heading-page"><?php the_title(); ?></h2>

	<div class="posts">

		<?php

		$temp = $wp_query; 
		$wp_query = null; 
		$wp_query = new WP_Query(); 
  		$args = array( 
			'post_type' => 'video',
			'posts_per_page' => 5,
			'order' => 'ASC',
			'paged' => $paged
		);
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