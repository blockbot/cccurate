<?php

// register nav menu
function register_theme_menus() {
  register_nav_menus(
    array(
      'site-menu' => __( 'Site Menu' ),
    )
  );
}
add_action( 'init', 'register_theme_menus' );

// enable thumbnails
add_theme_support( 'post-thumbnails' ); 

// add image sizes
add_image_size("blog_feed", 250, 250, true);

// set excerpt length
function custom_excerpt_length( $length ) {
	return 15;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

function edit_admin_menus() {

    global $menu;
     
    remove_menu_page('edit.php'); 

}
add_action( 'admin_menu', 'edit_admin_menus' );

function curate_remove_default_new_content_menu() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('new-post');
    $wp_admin_bar->remove_menu('new-media');
    $wp_admin_bar->remove_menu('new-page');
    $wp_admin_bar->remove_menu('new-user');
}
add_action( 'wp_before_admin_bar_render', 'curate_remove_default_new_content_menu' );

// non WP helper functions

if(!function_exists('diebug')) {
    
    function diebug($obj, $suppress = false)
    {
        
        echo '<pre><font size=2>';
        var_dump($obj);
        echo '</font></pre>';
        
        if(!$suppress) {
            $trace = debug_backtrace();
            echo "<font size=2>" . $trace[0]['file'];
            echo ': ' . $trace[0]['line'] . '</font>';
        }        
        
        die();
    }
}

function namespace_add_custom_types($query) {

	if(is_category() || is_tag() && empty( $query->query_vars['suppress_filters'])) {
	
		$query->set( 'post_type', array(
			'post', 'nav_menu_item', 'video'
		));
		
		return $query;
	
	}

}
add_filter('pre_get_posts', 'namespace_add_custom_types');

function baw_hack_wp_title_for_home($title){

  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return get_bloginfo('description') . ' - ' . get_bloginfo('title');
  }
  return $title;

}
add_filter('wp_title', 'baw_hack_wp_title_for_home');

function checkRemoteFile($url) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if(curl_exec($ch)!==FALSE) {
        return true;
    } else {
        return false;
    }

}

function myfeed_request($qv) {
    if (isset($qv['feed']))
        $qv['post_type'] = get_post_types();
    return $qv;
}
add_filter('request', 'myfeed_request');

?>