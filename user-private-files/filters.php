<?php
// Exit if accessed directly
if ( ! defined('ABSPATH') ) {
   exit;
}

// Filter to return correct status when restoring files & folders
add_filter( 'wp_untrash_post_status', 'upfp_untrash_post_status', 10, 3 );
if (!function_exists('upfp_untrash_post_status')) {
	function upfp_untrash_post_status($new_status, $post_id, $previous_status){
		$post_types = array( 'upf_folder' );

		if ( in_array( get_post_type( $post_id ), $post_types, true ) ) {
			$new_status = $previous_status;
		}

		return $new_status;
	}
}

// filter function to modify uploads directory temporary while uploading files
if (!function_exists('upfp_modify_upload_dir')) {
	function upfp_modify_upload_dir($dir){
		$dir['path'] = $dir['basedir'] . '/upf-docs';
		$dir['url'] = $dir['baseurl'] . '/upf-docs';
		$dir['subdir'] = '/upf-docs';
		return $dir;
	}
}

// Fix larger file not uploading issue
add_filter( 'wp_image_editors', function() {
	return array( 'WP_Image_Editor_GD' ); 
} );

// Filter to remove upf-docs from media library
add_filter('ajax_query_attachments_args', 'exclude_upf_doc_from_media_library_filter_cllbck');
function exclude_upf_doc_from_media_library_filter_cllbck($query) {
    
    $meta_query = array(
        array(
            'key'     => 'upf_doc',
            'value'   => 'true',
            'compare' => 'NOT EXISTS'
        )
    );

    if (isset($query['meta_query'])) {
        $query['meta_query'] = array_merge($query['meta_query'], $meta_query);
    } else {
        $query['meta_query'] = $meta_query;
    }

    return $query;
}

add_action('pre_get_posts', 'exclude_upf_doc_from_media_library_action_cllbck');
function exclude_upf_doc_from_media_library_action_cllbck($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    $screen = get_current_screen();
    if ($screen && $screen->base !== 'upload') {
        return;
    }

    $meta_query = array(
        array(
            'key'     => 'upf_doc',
            'value'   => 'true',
            'compare' => 'NOT EXISTS'
        )
    );

    $query->set('meta_query', array_merge($query->get('meta_query') ?: array(), $meta_query));
}