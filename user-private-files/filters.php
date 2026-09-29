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

// Filter to remove upf-docs from REST API media listing (/wp/v2/media)
add_filter('rest_attachment_query', 'exclude_upf_doc_from_rest_media_query_cllbck');
function exclude_upf_doc_from_rest_media_query_cllbck($args) {

    $meta_query = array(
        array(
            'key'     => 'upf_doc',
            'compare' => 'NOT EXISTS'
        )
    );

    if (isset($args['meta_query'])) {
        $args['meta_query'] = array_merge($args['meta_query'], $meta_query);
    } else {
        $args['meta_query'] = $meta_query;
    }

    return $args;
}

// Block single upf-doc items from REST API (/wp/v2/media/<id>, embeds)
add_filter('rest_request_before_callbacks', 'block_upf_doc_from_rest_media_item_cllbck', 10, 3);
function block_upf_doc_from_rest_media_item_cllbck($response, $handler, $request) {
    if (preg_match('#^/wp/v2/media/(\d+)#', $request->get_route(), $matches) && metadata_exists('post', (int) $matches[1], 'upf_doc')) {
        return new WP_Error('rest_post_invalid_id', __('Invalid post ID.'), array('status' => 404));
    }
    return $response;
}