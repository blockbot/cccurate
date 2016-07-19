<?php get_header(); ?>

<div id="container" class="post-detail">

	<?php while (have_posts()) : the_post(); ?>  	

		<div id="post-detail" data-post-id="<?php echo $post->ID; ?>">

			<div class="idea-image">
				<?php echo get_the_post_thumbnail($post->ID, "large"); ?> 
			</div>

			<div class="idea-content-contain">

				<h2><?php the_title();?></h2>

				<div class="idea-content">

					<div class="idea-content-inner">
						<?php the_content(); ?>	
					</div>
				
				</div>

				<a href="javascript:void(0);" class="btn-idea-show-all">Show All</a>

			</div>

			<?php 
				
			$args = array(
		        'post_type' => 'attachment',
		        'numberposts' => -1,
		        'post_status' => null,
		        'post_parent' => $post->ID,
				'orderby' => 'menu_order ID',
				'order' => "ASC"
		        ); 
		    $attachments = get_posts($args);

		    if(count($attachments) > 1):

			?>

				<div class="idea-media-contain">

					<div class="idea-media-slider">

						<div class="idea-media-images idea-media-type-container active" data-media-type-index="1">

							<div class="slideshow-container">

								<div id="slideshow-1" class="jds-slideshow closed" data-slideshow-id="1">

									<a href="javascript:void(0);" class="btn-prev"></a>
									<a href="javascript:void(0);" class="btn-next"></a>

									<div class="jds-slides clearfix">
										
										<?php  

									    if ($attachments) {
									        foreach ($attachments as $attachment) {
									            $imageTitle = $attachment->post_title;
									            $imageDescription = $attachment->post_content;
												$imageCaption = $attachment->post_excerpt;
												$galleryImage = wp_get_attachment_image_src($id = $attachment->ID, 'full');

										?>

											<div class="jds-slide">
												<img src="<?php echo $galleryImage[0] ?>" alt="<?php echo $galleryImage[0] ?>">
											</div>

										<?php	

									        }
									    }
									    
									    ?>

									</div>	
						
								</div>
								
							</div>

						</div>

					</div>	

				</div>

			<?php endif ?>

		</div>

	<?php endwhile;?>

<?php get_footer(); ?>	