<?php

add_action( 'wp_head', function () {

	// footer shadow options.
	$footer_border 			= get_theme_mod( 'footer_border', false );
	$footer_border_size 	= get_theme_mod( 'footer_border_size', '1' );
	$footer_border_space 	= get_theme_mod( 'footer_border_space', '20' );
	$footer_border_color 	= get_theme_mod( 'footer_border_color', '#777' );
	?>
		<style>

			<?php if ( $footer_border ) : ?>
				.site-footer {
					border-top: <?php echo esc_attr( $footer_border_size ); ?>px solid <?php echo esc_attr( $footer_border_color ); ?>;
					padding-top: <?php echo esc_attr( $footer_border_space ); ?>px;
				}
			<?php endif; ?>

		</style>
	<?php
} );

/**
 * Adding footer custimizer settings.
 */
add_action( 'customize_register' , function( $wp_customize ) {

	$wp_customize->add_setting(
		'footer_border',
		array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'footer_border_checkbox',
		array(
			'label'       => esc_html__('Border', 'commander-go'),
			'description' => esc_html__('Display a border on top of the footer', 'commander-go'),
			'section'     => 'go_footer_settings',
			'settings'    => 'footer_border',
			'type'        => 'checkbox',
			'priority'	  => 211
		)
	);

	$wp_customize->add_setting(
		'footer_border_color',
		array(
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
			'default'           => '#777',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_border_color',
			array(
				'label'    => esc_html__('Border Color', 'commander-go'),
				'section'  => 'go_footer_settings',
				'settings' => 'footer_border_color',
				'priority' => 212
			)
		)
	);

	$wp_customize->add_setting(
		'footer_border_size',
		array(
			'default'           => 1,
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new \Go\Customizer\Range_Control(
			$wp_customize,
			'footer_border_size',
			array(
				'default'     => 1,
				'type'        => 'go_range_control',
				'label'       => esc_html__( 'Border Width', 'commander-go' ),
				'description' => 'px',
				'section'     => 'go_footer_settings',
				'priority'    => 213,
				'input_attrs' => array(
					'min'  => 1,
					'max'  => 250
				),
			)
		)
	);

	$wp_customize->add_setting(
		'footer_border_space',
		array(
			'default'           => 20,
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new \Go\Customizer\Range_Control(
			$wp_customize,
			'footer_border_space',
			array(
				'default'     => 20,
				'type'        => 'go_range_control',
				'label'       => esc_html__( 'Top Space', 'commander-go' ),
				'description' => 'px',
				'section'     => 'go_footer_settings',
				'priority'    => 214,
				'input_attrs' => array(
					'min'  => 1,
					'max'  => 250
				),
			)
		)
	);

});

?>