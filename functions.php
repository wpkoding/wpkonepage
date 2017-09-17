<?php
add_action( 'after_setup_theme', 'wpkonepage_setup' );
function wpkonepage_setup() {
    add_theme_support( 'title-tag' );
	register_nav_menu( 'top', __('Top Menu', 'wpkonepage') );
}

add_action( 'wp_enqueue_scripts', 'wpkonepage_add_theme_scripts' );
function wpkonepage_add_theme_scripts() {
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Bellefair|Lato:300,400,700,900' );
	wp_enqueue_style( 'font-awesome', get_theme_file_uri('assets/css/font-awesome.min.css') );
	wp_enqueue_style( 'twbs4-style', get_theme_file_uri('assets/css/bootstrap.min.css') );
	wp_enqueue_style( 'style', get_stylesheet_uri(), array('dashicons') );

	wp_enqueue_script( 'jquery-slim', get_theme_file_uri('assets/js/jquery-slim.min.js') );
	wp_enqueue_script( 'popper', get_theme_file_uri('assets/js/popper.min.js') );
	wp_enqueue_script( 'tagsort-script', get_theme_file_uri('assets/js/tagsort.min.js'), array('jquery') );
    wp_enqueue_script( 'twbs4-script', get_theme_file_uri('assets/js/bootstrap.min.js') );
	wp_enqueue_script( 'bs-validator', 'https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js',array(),false,true );
	wp_enqueue_script( 'wpkonepage-script', get_theme_file_uri('assets/js/wpkonepage.js'),array(),false,true );	

    wp_localize_script( 'wpkonepage-script', 'wpkonepage', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'ajaxnonce' => wp_create_nonce('wpkonepage_cf_nonce')
    ));
}

add_action("wp_ajax_wpkonepage_contact_form", "wpkonepage_contact_form");
add_action("wp_ajax_nopriv_wpkonepage_contact_form", "wpkonepage_contact_form");
function wpkonepage_contact_form() {

    if ( !wp_verify_nonce( $_POST['nonce'], "wpkonepage_cf_nonce") ) {
        die("no way for you :p");
    }

    parse_str($_POST['dt'], $dt);

    $name = sanitize_text_field( $dt['name'] );
    $email = sanitize_email( $dt['email'] );
    $subject = "[wpkonepage.contact] ".sanitize_text_field( $dt['subject'] );
    $message = sanitize_textarea_field( $dt['message'] );

    // This is just example of email address, replace it with your email
    $to = 'wpkonepage@example.com';

    $headers[] = "Content-Type: text/html; charset=UTF-8";
    $headers[] = "Reply-To: $name <$email>";
     
    $sendmail = wp_mail( $to, $subject, $message, $headers );

    die($sendmail);
}

require get_parent_theme_file_path( '/inc/bs4navwalker.php' );