<?php
/*---------------------------------------------------------
Plugin Name: WP Generate Legal Pages 
Author: carlosramosweb
Author URI: https://profiles.wordpress.org/carlosramosweb/#content-plugins
Donate link: https://donate.criacaocriativa.com/
Description: Plugin desenvolvimento para criar páginas pre-configuradas automáticamente.
Text Domain: wp-generate-legal-pages
Domain Path: /languages/
Version: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html 
------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
//=>

register_activation_hook(__FILE__, 'wp_generate_legal_pages_activate');
function wp_generate_legal_pages_activate(){
    $wp_generate_legal_pages_config = array(
        'enabled' => 'yes',
        'privacy_policy' => 'yes',
        'terms_and_conditions' => 'yes',
        'about_us' => 'yes',
        'contact_us' => 'yes',
    );
    update_option( "wp_generate_legal_pages_config", $wp_generate_legal_pages_config );
    
    $wp_generate_legal_pages_company = array(
        'name' => '',
        'site' => '',
        'about_us' => '',
        'url_site' => '',
        'email' => '',
    );
    update_option( "wp_generate_legal_pages_company", $wp_generate_legal_pages_company );
    return;
}

if( ! defined( 'WP_GENERATE_LEGAL_PAGES_PLUGINS_URL' ) ) {
  define( 'WP_GENERATE_LEGAL_PAGES_PLUGINS_URL', plugins_url( "/wp-generate-legal-pages/" ) );
}
//=>

if( ! defined( 'WP_GENERATE_LEGAL_PAGES_PLUGINS_DIR_PATH' ) ) {
  define( 'WP_GENERATE_LEGAL_PAGES_PLUGINS_DIR_PATH', plugin_dir_path( __FILE__ ) );
}
//=>

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wp_generate_legal_pages_plugin_action_links_settings' );		
function wp_generate_legal_pages_plugin_action_links_settings( $links ) {
	$action_links = array(
		'settings' => '<a href="' . admin_url( 'admin.php?page=wp-generate-legal-pages-admin' ) . '" title="Configuração">Configuração</a>',
		'donate' => '<a href="' . 'https://donate.criacaocriativa.com' . '" title="Doação" class="error" target="_blank">Doação</a>',
	);

	return array_merge( $links, $action_links );
}
//=>

function check_custom_fields( $company_fields ) {
    if( $company_fields ) {
        if( empty( $company_fields['name'] ) ) {
           return false; 
        }
        if( empty( $company_fields['about_us'] ) ) {
           return false; 
        }
        if( empty( $company_fields['site'] ) ) {
           return false; 
        }
        if( empty( $company_fields['url_site'] ) ) {
           return false; 
        }
        if( empty( $company_fields['email'] ) ) {
           return false; 
        }
    }
    return true; 
}

include( WP_GENERATE_LEGAL_PAGES_PLUGINS_DIR_PATH . '/includes/wp-generate-legal-pages-admin-menu.php');
include( WP_GENERATE_LEGAL_PAGES_PLUGINS_DIR_PATH . '/includes/wp-generate-legal-pages-admin.php');
include( WP_GENERATE_LEGAL_PAGES_PLUGINS_DIR_PATH . '/includes/wp-generate-legal-pages-admin-ajax.php');
include( WP_GENERATE_LEGAL_PAGES_PLUGINS_DIR_PATH . '/includes/wp-generate-legal-pages-content.php');

//=>


