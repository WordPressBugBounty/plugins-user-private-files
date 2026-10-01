<?php
/* Handle Access to User files */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) {
   exit;
}

if(!is_user_logged_in()){
	status_header(403);
	die('403 &#8212; Not allowed.');
}

list($basedir) = array_values(array_intersect_key(wp_upload_dir(), array('basedir' => 1)))+array(NULL);
$basedir .= '/upf-docs';
$file =  rtrim($basedir,'/').'/'.str_replace('..', '', isset($_GET[ 'file' ])?sanitize_text_field($_GET[ 'file' ]):'');
if (!$basedir || !is_file($file)) {
	status_header(404);
	die('404 &#8212; File not found.');
}

if(isset($_GET[ 'file' ])){
	$private_file = 'upf-docs/' . sanitize_text_field($_GET[ 'file' ]);
	$file_raw_name = sanitize_text_field($_GET[ 'file' ]);
}
$allowed = $doc_id = 0;
$curr_user_id = get_current_user_id();

// allow access to admin users
if(user_can( $curr_user_id, 'administrator' )){
	$allowed = 1;
} else{
	// if file-author or allowed-user is viewing the file
	global $wpdb;
	$cache_key = 'upf_doc_id_' . md5($private_file);
	$doc_id = wp_cache_get($cache_key, 'upf');
	
	if (false === $doc_id) {
		$doc_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attached_file' AND meta_value = %s LIMIT 1", $private_file ) );
		wp_cache_set($cache_key, $doc_id ? $doc_id : 0, 'upf', 3600);
	}
	
	if ($doc_id) {
		$doc_author = get_post_field("post_author", $doc_id);
		if($curr_user_id == $doc_author){
			$allowed = 1;
		}
		else{
			$upf_allowed_users = get_post_meta($doc_id, 'upf_allowed', true);
			if($upf_allowed_users){
				if(in_array($curr_user_id, $upf_allowed_users)){
					$allowed = 1;
				}
			}
		}
	}

	// If doc is image and not original but different size
	if(!$doc_id){
		// Generated sizes are named "{original}-{width}x{height}.{ext}" by WordPress
		// Derive the original filename so we can look up the true parent attachment via the same exact _wp_attached_file match used above.
		if (preg_match('/^(.+)-\d+x\d+\.(\w+)$/', $file_raw_name, $matches)) {
			$original_private_file = 'upf-docs/' . $matches[1] . '.' . $matches[2];

			$orig_cache_key = 'upf_doc_id_' . md5($original_private_file);
			$candidate_id = wp_cache_get($orig_cache_key, 'upf');
			
			if (false === $candidate_id) {
				$candidate_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attached_file' AND meta_value = %s LIMIT 1", $original_private_file ) );
				wp_cache_set($orig_cache_key, $candidate_id ? $candidate_id : 0, 'upf', 3600);
			}

			if ($candidate_id) {
				// Confirm this candidate's own generated sizes actually include the exact requested file
				$candidate_meta = wp_get_attachment_metadata($candidate_id);
				$size_found = false;
				if (!empty($candidate_meta['sizes']) && is_array($candidate_meta['sizes'])) {
					foreach ($candidate_meta['sizes'] as $size_data) {
						if (isset($size_data['file']) && $size_data['file'] === $file_raw_name) {
							$size_found = true;
							break;
						}
					}
				}

				if ($size_found) {
					$doc_id = $candidate_id;
					$doc_author = get_post_field("post_author", $doc_id);
					if($curr_user_id == $doc_author){
						$allowed = 1;
					}
					else{
						$upf_allowed_users = get_post_meta($doc_id, 'upf_allowed', true);
						if($upf_allowed_users){
							if(in_array($curr_user_id, $upf_allowed_users)){
								$allowed = 1;
							}
						}
					}
				}
			}
		}
	}
}

if(!$allowed){
	status_header(403);
	die('403 &#8212; You do not have Permission to view this file.');
}

// Resolve the file to serve from the authorized attachment's own data, never from the raw client-supplied filename
if ($doc_id) {
	$served_file = false;
	$attached_file = get_attached_file($doc_id);
	if ($attached_file && basename($attached_file) === $file_raw_name) {
		$served_file = $attached_file;
	} else {
		$doc_meta = wp_get_attachment_metadata($doc_id);
		if (!empty($doc_meta['sizes']) && is_array($doc_meta['sizes'])) {
			foreach ($doc_meta['sizes'] as $size_data) {
				if (isset($size_data['file']) && $size_data['file'] === $file_raw_name) {
					$served_file = trailingslashit(dirname($attached_file)) . $size_data['file'];
					break;
				}
			}
		}
	}

	if (!$served_file || !is_file($served_file)) {
		status_header(403);
		die('403 &#8212; You do not have Permission to view this file.');
	}
	$file = $served_file;
	
} // else admin - directly serve the file

$mime = wp_check_filetype($file);
if( false === $mime[ 'type' ] && function_exists( 'mime_content_type' ) )
	$mime[ 'type' ] = mime_content_type( $file );

if( $mime[ 'type' ] )
	$mimetype = $mime[ 'type' ];
else
	$mimetype = 'image/' . substr( $file, strrpos( $file, '.' ) + 1 );

header( 'Content-Type: ' . $mimetype ); // always send this
if ( false === strpos( $_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS' ) )
	header( 'Content-Length: ' . filesize( $file ) );

$last_modified = gmdate( 'D, d M Y H:i:s', filemtime( $file ) );
$etag = '"' . md5( $last_modified ) . '"';
header( "Last-Modified: $last_modified GMT" );
header( 'ETag: ' . $etag );
header( 'Expires: ' . gmdate( 'D, d M Y H:i:s', time() + 100000000 ) . ' GMT' );
header( 'Cache-Control: private, max-age=31536000' );

// Support for Conditional GET
$client_etag = isset( $_SERVER['HTTP_IF_NONE_MATCH'] ) ? stripslashes( sanitize_text_field( $_SERVER['HTTP_IF_NONE_MATCH'] ) ) : false;

if( ! isset( $_SERVER['HTTP_IF_MODIFIED_SINCE'] ) )
	$_SERVER['HTTP_IF_MODIFIED_SINCE'] = false;

$client_last_modified = trim( rest_sanitize_boolean( $_SERVER['HTTP_IF_MODIFIED_SINCE'] ) );

// If string is empty, return 0. If not, attempt to parse into a timestamp
$client_modified_timestamp = $client_last_modified ? strtotime( $client_last_modified ) : 0;

// Make a timestamp for our most recent modification...
$modified_timestamp = strtotime($last_modified);

if ( ( $client_last_modified && $client_etag )
	? ( ( $client_modified_timestamp >= $modified_timestamp) && ( $client_etag == $etag ) )
	: ( ( $client_modified_timestamp >= $modified_timestamp) || ( $client_etag == $etag ) )
	) {
	status_header( 304 );
	exit;
}

// If we made it this far, just serve the file
status_header( 200 );
readfile( $file );
exit;