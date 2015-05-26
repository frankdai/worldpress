<?php
/**
 *
 *
 * @package worldpress
 * @since 0.0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

//main navigation
function register_main_menu() {
  register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'register_main_menu' );

//right sidebar
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

//footer widget area 
function footer_first_widget_init() {
	register_sidebar( array(
		'name'          => 'First Footer',
		'id'            => 'first_footer_widget',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'footer_first_widget_init' );

function footer_second_widget_init() {
	register_sidebar( array(
		'name'          => 'Second Footer',
		'id'            => 'second_footer_widget',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'footer_second_widget_init' );

function footer_third_widget_init() {
	register_sidebar( array(
		'name'          => 'Third Footer',
		'id'            => 'third_footer_widget',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'footer_third_widget_init' );


//customizer to let administrator input the social networking profile 
function worldpress_customize_register( $wp_customize ) {
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
*Add our css and js asset to the theme
*/
function wordpress_assets() {
	wp_enqueue_style( 'bootstrapcss', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'sitecss', get_template_directory_uri().'/style.css',array('bootstrapcss') );
	wp_enqueue_script( 'bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, false );
	wp_enqueue_script( 'sitejs', get_template_directory_uri() . '/js/script.js', array('bootstrapjs'), null, false );
	wp_enqueue_script( 'jslide', get_template_directory_uri() . '/js/jslide.min.js', array('jquery'), null, false );
}
add_action( 'wp_enqueue_scripts', 'wordpress_assets' );

//add featured post type to be displayed in home page carousel
function create_post_type() {
  register_post_type( 'feature',
    array(
      'labels' => array(
        'name' => __( 'Featured Post' ),
      ),
      'public'=>true,
      'description'=>'Featured Post Will be promoted',
      'public' => true,
      'has_archive' => true,
      'taxonomies' => array('category','post_tag'),
      'rewrite'=>false
    )
  );
}
add_action( 'init', 'create_post_type' );

//add the feature image field
add_theme_support( 'post-thumbnails' ); 

//html5 form handling
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'widgets' ) );

//add about us text widget to be used in the footer area
class worldpress_about_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'worldpress_about',  
			__( 'About Us', 'text_domain' ),  
			array( 'description' => __( 'About Us Widget', 'text_domain' ), ) //  
		);
	}
	public function widget($args,$instance) {
		extract( $args );
   		$title = apply_filters('widget_title', $instance['title']);
   		$textarea = $instance['textarea'];
   		echo $before_widget;
   		?>
   		<div class="widget-text worldpress-about-widget">
   		<?php echo $before_title . $title . $after_title;;?>
   		<p><?php echo $textarea;?></p>
   		</div>
   		<?php 
   		echo $after_widget;
	}
	public function form($instance) {
		if( $instance) {
		     $title = esc_attr($instance['title']);
		     $textarea = esc_textarea($instance['textarea']);
		} else {
		     $title = 'About Us';
		     $textarea = 'A very fast-learning web design company etc.';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Textarea:', 'wp_widget_plugin'); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
		</p>
		<?php
	}
	public function update($new_instance,$old_instance){
		$instance = $old_instance;
      	$instance['title'] = strip_tags($new_instance['title']);
      	$instance['textarea'] = strip_tags($new_instance['textarea']);
     	return $instance;
	}
}

function wordpress_about_register_widget() {
    register_widget( 'worldpress_about_widget' );
}
add_action( 'widgets_init', 'wordpress_about_register_widget' );