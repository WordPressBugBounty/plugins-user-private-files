<?php
// Handle plugin activation/deactivation
class Upvf_Actdeact{
	static function upvf_plugin_activate(){
		self::upvf_protect_upf_dir();
	}

	static function upvf_plugin_deactivate(){

        // Clean up old rules
		$htaccess = ABSPATH.".htaccess";
		$written = insert_with_markers ( $htaccess, "User Private Files", '' );
		// upf-docs/.htaccess is kept on purpose - files stay protected while the plugin is inactive
	}

	// Add folder-level rules in upf-docs/.htaccess to route every file request through dl-file.php
	static function upvf_protect_upf_dir(){
		$upload_dir = wp_upload_dir();
		$upf_dir_path = $upload_dir['basedir'] . "/upf-docs";
		if ( ! wp_mkdir_p( $upf_dir_path ) ) {
			return false;
		}

		$htaccess = $upf_dir_path . "/.htaccess";
		$htcode = self::upvf_upf_dir_htcode();
		if ( file_exists( $htaccess ) && file_get_contents( $htaccess ) === $htcode ) {
			return true;
		}
		return false !== @file_put_contents( $htaccess, $htcode );
	}

	static function upvf_upf_dir_htcode(){
		$htcode = array(
			"RewriteEngine On",
			"RewriteRule ^(.*)$ " . home_url( '/' ) . "?file=$1 [R=302,QSA,L]",
			"<IfModule !mod_rewrite.c>",
			"  Require all denied",
			"</IfModule>",
		);
		return implode( "\n", $htcode ) . "\n";
	}

}
