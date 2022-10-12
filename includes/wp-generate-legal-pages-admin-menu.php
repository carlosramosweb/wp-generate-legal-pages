<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
//=>

add_action( 'admin_menu', 'register_wp_generate_legal_pages_menu_page', 10 );
function register_wp_generate_legal_pages_menu_page() {
    add_menu_page( __( 'Generate Legal Pages', 'wp-generate-legal-pages' ), 'Gerar Páginas', 'edit_posts', 'wp-generate-legal-pages-admin', 'wp_generate_legal_pages_admin', 'dashicons-randomize', 20 );

}
//=>
