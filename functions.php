<?php
/**
 *
 *
 * @package worldpress
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
function register_main_menu() {
  register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'register_main_menu' );

function sidebar_widgets_init() {
	register_sidebar( array(
		'name'          => 'Right Sibebar',
		'id'            => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'sidebar_widgets_init' );

function worldpress_customize_register( $wp_customize ) {
   //All our sections, settings, and controls will be added here
	$wp_customize->add_section( 'worldpress_social' , array(
    'title'      => __( 'Social Network Profile', 'worldpress' ),
    'priority'   => 50,
	) );
	$wp_customize->add_setting('facebook_profile_link',array(
		'default'=>'https://www.facebook.com/',
		'transport'   => 'refresh',
	));
	$wp_customize->add_setting('twitter_profile_link',array(
		'default'=>'https:/twitter.com/',
		'transport'   => 'refresh',
	));
	$wp_customize->add_setting('google_profile_link',array(
		'default'=>'https://plus.google.com/',
		'transport'   => 'refresh',
	));
	$wp_customize->add_setting('pinterest_profile_link',array(
		'default'=>'https://www.pinterest.com/',
		'transport'   => 'refresh',
	));	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook_profile', array(
		'label'        => __( 'Link to your Facebook page', 'worldpress' ),
		'section'    => 'worldpress_social',
		'settings'   => 'facebook_profile_link',
		'type' => 'text',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_profile', array(
		'label'        => __( 'Link to your Twitter page', 'worldpress' ),
		'section'    => 'worldpress_social',
		'settings'   => 'twitter_profile_link',
		'type' => 'text',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google_profile', array(
		'label'        => __( 'Link to your Google Plus page', 'worldpress' ),
		'section'    => 'worldpress_social',
		'settings'   => 'google_profile_link',
		'type' => 'text',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pinterest_profile', array(
		'label'        => __( 'Link to your Pinterest page', 'worldpress' ),
		'section'    => 'worldpress_social',
		'settings'   => 'pinterest_profile_link',
		'type' => 'text',
	) ) );
}
add_action( 'customize_register', 'worldpress_customize_register' );

/*
*Add customized version of bootstrap css and js asset to the theme
*/
function wordpress_assets() {
	wp_enqueue_style( 'bootstrapcss', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'sitecss', get_template_directory_uri().'/style.css',array('bootstrapcss') );
	wp_enqueue_script( 'bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, false );
	wp_enqueue_script( 'sitejs', get_template_directory_uri() . '/js/script.js', array('bootstrapjs'), null, false );
}
add_action( 'wp_enqueue_scripts', 'wordpress_assets' );
