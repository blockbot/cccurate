<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title(''); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	

    <?php if(is_singular()): ?>

	    <meta name="twitter:card" content="photo" />
		<meta name="twitter:site" content="@_cccurate_" />
		<meta name="twitter:title" content="<?php the_title(); ?>" />

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

		<?php if(checkRemoteFile($thumb_src)): ?>

			<meta name="twitter:image" content="<?php echo $thumb_src; ?>" />
			<meta property="og:image" content="<?php echo $thumb_src; ?>" />

		<?php else: ?>

			<meta name="twitter:image" content="<?php echo bloginfo("template_url") ?>/img/no-thumb.png" />
			<meta property="og:image" content="<?php echo bloginfo("template_url") ?>/img/no-thumb.png" />

		<?php endif; ?>

	<?php else: ?>

		<meta name="twitter:image" content="<?php echo bloginfo("template_url") ?>/img/no-thumb.png" />
		<meta property="og:image" content="<?php echo bloginfo("template_url") ?>/img/no-thumb.png" />

	<?php endif; ?>

	<meta name="twitter:url" content="<?php the_permalink(); ?>" />

    <?php wp_head(); ?>

    <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/library/css/main.css">
    <script src="<?php bloginfo("template_url"); ?>/library/js/vendor/modernizr-2.6.2.min.js"></script>


</head>
<body <?php body_class(); ?>>

    <div id="container">

    	<header class="clearfix">

	        <nav id="main">

	        	<a id="nav-bars" href="javascript:void(0);">
	        		
	        		<div class="nav-bar"></div>
	        		<div class="nav-bar"></div>
	        		<div class="nav-bar"></div>
	        	
	        	</a>

	        	<div id="nav-item-container">

		            <?php 
		                
			            //get nav item data
			            $nav = wp_get_nav_menu_items( "site-menu"); 
			        
			            // loop through nav item data and create the nav
			            $nav_item_index = 0;
		        
		            ?>

		            <?php foreach($nav as $nav_item): ?>

		                <!-- on load first item should be set to active -->
		                <a href="<?php echo $nav_item->url; ?>" 
		                	class="<?php echo $nav_item_index == 0 ?  'nav-home-active ' : ''; ?>btn-nav-home" 
		                	data-nav-id="<?php echo $nav_item->object_id; ?>">

		                    <?php echo $nav_item->title; ?>

		                </a>

		            	<?php $nav_item_index++; ?>

			        <?php endforeach; ?>

		        </div>

	        </nav>

        	<h1><a href="<?php bloginfo("url") ?>" id="theme-logo"><span>cccurate</span></a></h1>    

        	<?php get_search_form(); ?>

        	<?php if(!is_singular()): ?>

	        	<div id="video-length-filter" class="clearfix">

	        		<p>Length Filter: </p>
	        		<p><a href="?length=default">Everything</a></p>
	        		<p><a href="?length=short" title="Less than 1 minute">Short</a></p>
	        		<p><a href="?length=medium" title="1 - 5 minutes">Medium</a></p>
	        		<p><a href="?length=long" title="More than 5 minutes">Long</a></p>

	        	</div>

       		<?php endif; ?>

	    </header>