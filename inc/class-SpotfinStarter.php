<?php

class SpotfinStarter
{

	public static $instance;

	public static function init()
	{
		if ( is_null( self::$instance ) )
			self::$instance = new SpotfinStarter();
		return self::$instance;
	}

	private function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_action( 'after_setup_theme', array( $this, 'supports') );
		add_action( 'after_setup_theme', array( $this, 'menus' ) );
		add_action( 'widgets_init', array( $this, 'sidebars' ) );
	}

	public function wp_enqueue_scripts()
	{

		// CSS
		wp_enqueue_style( 'spotfin-style', get_stylesheet_uri() );

		// JS
		wp_enqueue_script( 'jquery' );
		
		wp_enqueue_script( 'spotfin-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
		
		wp_enqueue_script( 'spotfin-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
	public function supports()
	{
		load_theme_textdomain( 'spotfin', get_template_directory() . '/languages' );
		
		add_theme_support( 'title-tag' );
		
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support('post-thumbnails');
		
	}
	public function menus()
	{
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'spotfin' ),
		) );
	}
	public function sidebars() 
	{
		$defaults = array(
		    'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    'after_widget' => '</div>',
		    'before_title' => '<h3 class="widget-before-title">',
		    'after_title' => '</h3>'
		);
		 
		$sidebars = array(
			array(
		        'id' => 'sidebar-1',
		        'name' => esc_html__( 'Sidebar', 'spotfin' ),
		        'description' => __( 'Sidebar' ),
		    ),
		);
		 
		// register all sidebars with defaults
		foreach ( $sidebars as $sidebar )
		{
		    register_sidebar( array_merge( $defaults, $sidebar ) );
		}
		
	}

}

SpotfinStarter::init();