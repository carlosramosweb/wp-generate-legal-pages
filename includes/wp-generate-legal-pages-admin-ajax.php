<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
//=>

add_action( 'wp_ajax_wp_generate_legal_pages_admin_action', 'wp_generate_legal_pages_admin_action_callback' );
add_action( 'wp_ajax_nopriv_wp_generate_legal_pages_admin_action', 'wp_generate_legal_pages_admin_action_callback' );
function wp_generate_legal_pages_admin_action_callback() {
    
	 if( isset( $_POST['update'] ) && isset( $_POST['wpnonce'] ) ) {
		$_update = esc_attr( $_POST['update'] );
		$_wpnonce = esc_attr( $_POST['wpnonce'] );
	 }
	 
	 if( isset( $_wpnonce ) && isset( $_update ) ) {
		if ( ! wp_verify_nonce( $_wpnonce, 'wp-generate-legal-pages-action' ) ) {
            echo 0;
            exit();
			
		} else if ( empty( $_update ) ) {
            echo 0;
            exit();			
		}
		
		$wp_generate_legal_pages = get_option( 'wp_generate_legal_pages_config' );
		if( $wp_generate_legal_pages['enabled'] == "yes" ) {
    		unset( $wp_generate_legal_pages['enabled'] );
    		if( $wp_generate_legal_pages ) {
    		    foreach ( $wp_generate_legal_pages as $key => $page ) {
    		        if( $page == "yes" ) {
    		            $pages_title = wp_generate_legal_pages_name( $key );
    		            $pages_content = wp_generate_legal_pages_content( $key ); 
    		            $pages_content_new = apply_filters('the_content' , $pages_content );
                        $args = array(
                          'post_title'    => wp_strip_all_tags( $pages_title ),
                          'post_content'  => $pages_content_new,
                          'post_status'   => 'publish',
                          'post_author'   => 1,
                          'post_type'   => 'page',
                        );
                         
                        wp_insert_post( $args );
    		        }
    		    }
    		}
            echo 1;
            exit();
		}
	
	 }
    echo 0;
    exit();
}