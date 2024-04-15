<?php

add_action( 'wp_head', function () {

	// header shadow options.
	$header_shadow 			= get_theme_mod( 'header_shadow', false );
	$header_shadow_size 	= get_theme_mod( 'header_shadow_size', '20' );
	$header_shadow_color 	= get_theme_mod( 'header_shadow_color', '#aaa' );

	?>
		<style>

			<?php if ( $header_shadow ) : ?>
				#site-header {
					box-shadow: 0 0 <?php echo esc_attr( $header_shadow_size ); ?>px <?php echo esc_attr( $header_shadow_color ); ?>;
				}
			<?php endif; ?>

		</style>
	<?php
} );

/**
 * Adding header custimizer settings.
 */
add_action( 'customize_register' , function( $wp_customize ) {

	$wp_customize->add_setting(
		'header_shadow',
		array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'header_shadow_checkbox',
		array(
			'label'       => esc_html__('Shadow', 'commander-go'),
			'description' => esc_html__('Display a shadow under the header', 'commander-go'),
			'section'     => 'go_header_settings',
			'settings'    => 'header_shadow',
			'type'        => 'checkbox',
			'priority'	  => 211
		)
	);

	$wp_customize->add_setting(
		'header_shadow_color',
		array(
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
			'default'           => '#aaa',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'header_shadow_color',
			array(
				'label'    => esc_html__('Shadow Color', 'commander-go'),
				'section'  => 'go_header_settings',
				'settings' => 'header_shadow_color',
				'priority'	  => 212
			)
		)
	);

	$wp_customize->add_setting(
		'header_shadow_size',
		array(
			'default'           => 20,
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new \Go\Customizer\Range_Control(
			$wp_customize,
			'header_shadow_size',
			array(
				'default'     => 20,
				'type'        => 'go_range_control',
				'label'       => esc_html__( 'Shadow Width', 'commander-go' ),
				'description' => 'px',
				'section'     => 'go_header_settings',
				'priority'    => 213,
				'input_attrs' => array(
					'min'  => 1,
					'max'  => 250
				),
			)
		)
	);
});

?>