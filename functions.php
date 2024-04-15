<?php
/**
 * Commander functions and definitions
 *
 * @package Commander
 */

/**
 * Theme constants.
 */
define( 'COMMANDER_VERSION', '1.0.0' );
define( 'COMMANDER_PLUGIN_DIR', get_template_directory( __FILE__ ) );
define( 'COMMANDER_PLUGIN_URL', get_template_directory_uri( __FILE__ ) );

add_action( 'customize_register', function ($wp_customize) {
	require_once get_parent_theme_file_path( 'includes/classes/customizer/class-range-control.php' );
	$wp_customize->register_control_type( \Go\Customizer\Range_Control::class );
} );

require_once get_theme_file_path( 'customizer/header.php' );
require_once get_theme_file_path( 'customizer/footer.php' );

add_filter( 'body_class', function ( $classes ) {

	if ( !is_singular() && get_theme_mod( 'card_mode', true ) )
		$classes[] = 'card-mode';

	return $classes;

} );


/**
 * Enqueue styles for front-end.
 */
add_action( 'wp_enqueue_scripts', function () {

	wp_enqueue_style(
		'commander-style',
		get_stylesheet_directory_uri() . "/dist/css/style-shared.css",
		array(),
		COMMANDER_VERSION
	);

} );