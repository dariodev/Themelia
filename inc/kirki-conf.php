<?php
if ( class_exists( 'Kirki' ) ) {

	Kirki::add_config( 'themelia_config', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
		'disable_output' => false,
	) );

	//Kirki_Fonts_Google::$force_load_all_variants = true;

	 /****
	 * -> START Layout
	 *    Section: layout
	 */
	Kirki::add_field( 'themelia_config', array(
		'type'        => 'number',
		'settings'    => 'site_width',
		'label'       => esc_attr__( 'Site width', 'themelia' ),
		'description' => 'Maximum width of the main wrapper in pixels.',
		'section'     => 'layout',
		'default'     => 1340,
		'choices'     => array(
			'min'  => '640',
			'max'  => '3200',
			'step' => '5',
		),
		'transport' => 'postMessage',
		'js_vars' => array(
			array(
				'element'  => '.grid-container',
				'property' => 'max-width',
				'units'    => 'px',
			),
		),
	) );

	Kirki::add_field( 'themelia_config', array(
		'type'        => 'select',
		'settings'    => 'footer_widget_columns',
		'label'       => __( 'Footer Widgets', 'themelia' ),
		'description' => __( 'Choose number of widget columns in footer widget area. Each column can have any number of widgets.', 'themelia' ),
		'section'     => 'layout',
		'default'     => 'none',
		'priority'    => 100,
		'choices'     => array(
			'0' => esc_attr__( '0 Widgets', 'themelia' ),
			'1' => esc_attr__( '1 Widget',  'themelia' ),
			'2' => esc_attr__( '2 Widgets', 'themelia' ),
			'3' => esc_attr__( '3 Widgets', 'themelia' ),
			'4' => esc_attr__( '4 Widgets', 'themelia' ),
		),
		'transport' => 'auto',
	) );

	/* - END Layout
	 **/


	/*
	 * -> SECTION Site Title & Header (themelia_header_settings)
	 *
	 */
	Kirki::add_section( 'themelia_header_settings', array(
		'title'          => esc_attr__( 'Site Title &amp; Header', 'themelia' ),
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	   /*
		* -> START Site Title & Header
		* Section: themelia_header_settings
		*/

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'select',
			'settings'    => 'site_header_layout',
			'label'       => __( 'Header Layout', 'themelia' ),
			'description' => __( 'Select layout for header elements (branding and main navigation).', 'themelia' ),
			'section'     => 'themelia_header_settings',
			'default'     => 'header-inline-title-menu',
			'priority'    => 10,
			'multiple'    => 1,
			'choices'     => array(
				'header-inline-title-menu'	=> esc_attr__( 'Inline: Title - Menu (Default)', 'themelia' ),
				'header-inline-menu-title'	=> esc_attr__( 'Inline: Menu - Title', 'themelia' ),
				'header-stack-left'			=> esc_attr__( 'Stack: Left aligned', 'themelia' ),
				'header-stack-right'		=> esc_attr__( 'Stack: Right aligned', 'themelia' ),
				'header-stack-center'		=> esc_attr__( 'Stack: Centered', 'themelia' ),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'     => 'custom',
			'settings' => 'custom_hr',
			'label'    => '',
			'section'  => 'themelia_header_settings',
			'default'  => '<hr>',
			'priority' => 10,
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'     => 'radio',
			'settings' => 'sticky_header',
			'label'    => __( 'Header Type', 'themelia' ),
			'section'  => 'themelia_header_settings',
			'default'  => 'no-sticky',
			'priority' => 10,
			'choices'  => [
				'no-sticky' => [
					esc_html__( 'No Sticky', 'themelia' ),
					esc_html__( 'Normal Header', 'themelia' ),
				],
				'sticky'    => [
					esc_html__( 'Sticky Header', 'themelia' ),
					esc_html__( 'Always stick your header to the top', 'themelia' ),
				],
				'headroom'  => [
					esc_html__( 'Sticky Headroom', 'themelia' ),
					esc_html__( 'Hide your header until you need it', 'themelia' ),
				],
			],
		) );

		Kirki::add_field( 'themelia_config', [
			'type'        => 'number',
			'settings'    => 'main_padding',
			'description' => esc_html__( 'If your Header Type is Sticky or Sticky Headroom, the main content will need top padding. Adjust if your header is bigger or smaller (default is 86px)', 'themelia' ),
			'section'     => 'themelia_header_settings',
			'default'     => 86,
			'choices'     => array(
				'min'  => 0,
				'max'  => 180,
				'step' => 1,
			),
			'output' => array(
				array(
					'element'  => '.headroom + .main, .sticky-header + .main',
					'property' => 'padding-top',
					'units'    => 'px',
				),
			),
		] );

		Kirki::add_field( 'themelia_config', array(
			'type'     => 'custom',
			'settings' => 'custom_hr_2',
			'label'    => '',
			'section'  => 'themelia_header_settings',
			'default'  => '<hr>',
			'priority' => 10,
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'site_header_background',
			'label'       => esc_attr__( 'Site Header Background', 'themelia' ),
			'description' => esc_attr__( 'Background color for header area.', 'themelia' ),
			'section'     => 'themelia_header_settings',
			'default'     => '#fff',
			'priority'    => 10,
			'inline_css'  => false,
			'transport'   => 'auto',
			'choices'     => array(
				'alpha' => true,
			),
			'output' => array(
				array(
					'element'  => '.site-header',
					'property' => 'background-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'site_header_separator',
			'label'       => __( 'Site Header Separator', 'themelia' ),
			'description' => __( 'Thin border between Site Header and Content Area.', 'themelia' ),
			'section'     => 'themelia_header_settings',
			'default'     => 'rgba(39,55,64,0.14)',
			'priority'    => 10,
			'inline_css'  => false,
			'transport'   => 'auto',
			'choices'     => array(
				'alpha' => true,
			),
			'output' => array(
				array(
					'element'  => '.site-header:after',
					'property' => 'background-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'     => 'custom',
			'settings' => 'custom_hr_3',
			'label'    => '',
			'section'  => 'themelia_header_settings',
			'default'  => '<hr>',
			'priority' => 10,
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'toggle',
			'settings'    => 'site_title',
			'label'       => __( 'Display Site Title', 'themelia' ),
			'description' => __( 'Uncheck to hide visually (always available for screen readers).', 'themelia' ),
			'section'     => 'themelia_header_settings',
			'default'     => '1',
			'priority'    => 10,
			'transport'   => 'auto',
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'site_title_font',
			'label'       => esc_attr__( 'Site Title', 'themelia' ),
			'description' => esc_attr__( 'Customize the look of the Site Title.', 'themelia' ),
			'section'     => 'themelia_header_settings',
			'default'     => array(
				'font-family'    => 'Roboto',
				'variant'        => '700',
				'font-size'      => '1.789em',
				'line-height'    => '1.2',
				'letter-spacing' => '0',
				'subsets'        => array( 'latin' ),
				'text-transform' => 'none',
			),
			'priority'  => 25,
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.site-title',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'      => 'multicolor',
			'settings'  => 'site_title_link_color',
			'section'   => 'themelia_header_settings',
			'priority'  => 25,
			'choices'   => array(
				'link'   => esc_attr__( 'Color', 'themelia' ),
				'hover'  => esc_attr__( 'Hover', 'themelia' ),
				'active' => esc_attr__( 'Active', 'themelia' ),
			),
			'default' => array(
				'link'   => '#22222A',
				'hover'  => '#22222A',
				'active' => '#22222A',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'choice'   => 'link',
					'element'  => '.site-title-wrap .site-title, .site-title-wrap:visited .site-title',
					'property' => 'color',
				),
				array(
					'choice'   => 'hover',
					'element'  => '.site-title-wrap:hover .site-title',
					'property' => 'color',
				),
				array(
					'choice'   => 'active',
					'element'  => '.site-title-wrap:active .site-title',
					'property' => 'color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'toggle',
			'settings'    => 'site_description',
			'label'       => __( 'Display Site Description', 'themelia' ),
			'description' => __( 'Uncheck to hide only visually, but have it available for screen readers.', 'themelia' ),
			'section'     => 'themelia_header_settings',
			'default'     => '1',
			'priority'    => 25,
			'transport'   => 'auto',
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'      => 'typography',
			'settings'  => 'site_description_font',
			'section'   => 'themelia_header_settings',
			'default'   => array(
				'font-family'    => 'Roboto',
				'variant'        => '400',
				'font-size'      => '0.789em',
				'letter-spacing' => '0.025em',
				'line-height'    => '1.2',
				'subsets'        => array( 'latin' ),
				'text-transform' => 'none',
				'color'          => '#6f767a',
			),
			'priority'  => 25,
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.site-description',
				),
			),
		) );

	/* - END Site Title & Header
	 **/


	/*
	 * -> SECTION Main Navigation (themelia_menu_typography)
	 *
	 */
	Kirki::add_section( 'themelia_menu_typography', array(
		'title'          => esc_attr__( 'Main Navigation', 'themelia' ),
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	   /*
		* -> START Main Navigation
		*/
		Kirki::add_field( 'themelia_config', array(
			'type'      => 'typography',
			'settings'  => 'nav_typography',
			'label'     => esc_attr__( 'Typography', 'themelia' ),
			'section'   => 'themelia_menu_typography',
			'priority'  => 25,
			'default'   => array(
				'font-family'    => 'Roboto',
				'font-size'      => '16px',
				'line-height'    => '1.4',
				'variant'        => '500',
				'subsets'        => array( 'latin' ),
				'text-transform' => 'none',
				'letter-spacing' => '0',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.sm-simple',
				),
			),
		) );

	   /*
		* -> START Main Navigation Colors
		*/

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'nav_link_color',
			'label'       => esc_attr__( 'Top level - Text', 'themelia' ),
			'section'     => 'themelia_menu_typography',
			'priority'    => 25,
			'choices'     => array(
				'link'    => esc_attr__( 'Color', 'themelia' ),
				'hover'   => esc_attr__( 'Hover', 'themelia' ),
				'active'  => esc_attr__( 'Active', 'themelia' ),
			),
			'default'     => array(
				'link'    => 'rgba(34, 34, 42, 1)',
				'hover'   => '#000',
				'active'  => '#000',
			),
			'transport' => 'auto',
			'output' => array(
				array(
				  'choice'   => 'link',
				  'element'  => '.sm-simple a, .sm-simple a:visited',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'hover',
				  'element'  => '.sm-simple a:hover, .sm-simple > li > a.highlighted',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'active',
				  'element'  => '.sm-simple a:active, .sm-simple > li > a.highlighted:active',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'link',
				  'element'  => '.hamburger-inner, .hamburger-inner:before, .hamburger-inner:after',
				  'property' => 'background-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'nav_link_highlight',
			'label'       => esc_attr__( 'Top Links - Highlight Border', 'themelia' ),
			'section'     => 'themelia_menu_typography',
			'priority'    => 25,
			'choices'     => array(
				'hover'   => esc_attr__( 'Hover', 'themelia' ),
				'current' => esc_attr__( 'Current', 'themelia' ),
			),
			'default'     => array(
				'hover'   => '#B10E1E',
				'current' => '#BA321D',
			),
			'transport' => 'auto',
			'output'   => array(
				array(
				  'choice'   => 'hover',
				  'element'  => '.sm-simple > li > a:hover:before,.sm-simple > li > a.highlighted:before',
				  'property' => 'background',
				),
				array(
				  'choice'   => 'current',
				  'element'  => '.sm-simple > li.current-menu-item > a:before,.sm-simple > li.current_page_item > a:before,.sm-simple > li.current_page_parent > a:before,.sm-simple > li.current-page-ancestor > a:before',
				  'property' => 'background',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'nav_sub_link_color',
			'label'       => esc_attr__( 'Drop Down - Text', 'themelia' ),
			'section'     => 'themelia_menu_typography',
			'priority'    => 25,
			'inline_css'  => false,
			'choices'     => array(
				'link'    => esc_attr__( 'Color', 'themelia' ),
				'hover'   => esc_attr__( 'Hover', 'themelia' ),
				'active'  => esc_attr__( 'Active', 'themelia' ),
			),
			'default'     => array(
				'link'    => '#121212',
				'hover'   => '#b10e1e',
				'active'  => '#b10e1e',
			),
			'transport' => 'auto',
			'output' => array(
				array(
				  'choice'   => 'link',
				  'element'  => '.sm-simple .sub-menu a, .sm-simple .sub-menu a:visited',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'hover',
				  'element'  => '.sm-simple .sub-menu a:hover, .sm-simple .sub-menu li a.highlighted',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'active',
				  'element'  => '.sm-simple .sub-menu a:active, .sm-simple .sub-menu li a.highlighted:active',
				  'property' => 'color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'nav_sub_link_bg',
			'label'       => esc_attr__( 'Drop Down - Background', 'themelia' ),
			'section'     => 'themelia_menu_typography',
			'priority'    => 25,
			'inline_css' => false,
			'choices'     => array(
				'link'    => esc_attr__( 'BG Color', 'themelia' ),
				'hover'   => esc_attr__( 'BG Hover', 'themelia' ),
				'active'  => esc_attr__( 'BG Active', 'themelia' ),
			),
			'default'     => array(
				'link'    => '#fff',
				'hover'   => '#fff',
				'active'  => '#fff',
			),
			'transport' => 'auto',
			'output' => array(
				array(
				  'choice'   => 'link',
				  'element'  => '.sm-simple .sub-menu li a',
				  'property' => 'background-color',
				),
				array(
				  'choice'   => 'hover',
				  'element'  => '.sm-simple .sub-menu li a:hover, .sm-simple .sub-menu li a.highlighted',
				  'property' => 'background-color',
				),
				array(
				  'choice'   => 'active',
				  'element'  => '.sm-simple .sub-menu li a:active',
				  'property' => 'background-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'nav_sub_link_borders',
			'label'       => esc_attr__( 'Drop Down - Borders', 'themelia' ),
			'section'     => 'themelia_menu_typography',
			'priority'    => 25,
			'inline_css'  => false,
			'choices'     => array(
				'outline'   => esc_attr__( 'Outline', 'themelia' ),
				'separator' => esc_attr__( 'Separators', 'themelia' ),
			),
			'default' => array(
				'outline'   => 'rgba(39, 55, 64, 0.09)',
				'separator' => 'rgba(39, 55, 64, 0.09)',
			),
			'transport' => 'auto',
			'output'   => array(
				array(
				  'choice'   => 'outline',
				  'element'  => '.sm-simple .sub-menu',
				  'property' => 'border-color',
				),
				array(
				  'choice'   => 'separator',
				  'element'  => '.sm-simple .sub-menu li',
				  'property' => 'border-color',
				),
				array(
				  'choice'   => 'outline',
				  'element'  => '.sm-simple .sub-menu ul',
				  'property' => 'border-top-color',
				),
			),
		) );
		/* - END Main Navigation Colors
		 **/


	/*
	 * -> SECTION Hamburger Menu (themelia_mobile_menu)
	 *
	 */
	Kirki::add_section( 'themelia_mobile_menu', array(
		'title'          => __( 'Mobile Menu', 'themelia' ),
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'slider',
			'settings'    => 'hamburger_breakpoint',
			'label'       => esc_html__( 'Hamburger Menu Breakpoint', 'themelia' ),
			'description' => esc_html__( 'Move slider to the viewport width where you want the hamburger menu appear. Max size is 1920 (size in px). Also you can input your own value in the number field, click and type in a custom number. (Default 1200)', 'themelia' ),
			'section'     => 'themelia_mobile_menu',
			'default'     => 1200,
			'choices'     => array(
				'min'  => 0,
				'max'  => 1920,
				'step' => 1,
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'slider',
			'settings'    => 'headerstack_breakpoint',
			'label'       => esc_html__( 'Header Stacked & Centered Breakpoint', 'themelia' ),
			'description' => esc_html__( 'If you do not want to use Hamburger Menu, you may set a breakpoint where the site title and the main menu will appear stacked and centered. This will work only if Hamburger Menu Breakpoint value is set to 0. Move slider to the desired viewport width (size in px). Also you can input your own value in the number field, click and type in a custom number. (Default 0)', 'themelia' ),
			'section'     => 'themelia_mobile_menu',
			'default'     => 0,
			'choices'     => array(
				'min'  => 0,
				'max'  => 1920,
				'step' => 1,
			),
		) );

		/* - END Main Hamburger Menu
		 **/


	/*
	 * -> SECTION Base Typography
	 *
	 */
	Kirki::add_section( 'themelia_base_typography', array(
		'title'          => __( 'Body Text, Links & Buttons', 'themelia' ),
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	   /*
		* -> START Base Typography
		*/
		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'base_typography',
			'label'       => esc_attr__( 'Body Text', 'themelia' ),
			'description' => esc_attr__( 'Base typography settings.', 'themelia' ),
			'section'     => 'themelia_base_typography',
			'default'     => array(
				'font-family'    => 'Roboto',
				'variant'        => 'regular',
				'line-height'    => '1.6',
				'letter-spacing' => '0',
				'subsets'        => array( 'latin' ),
				'color'          => '#22222A',
			),
			'priority'  => 25,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element' => 'body',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'body_link',
			'label'       => esc_attr__( 'Body Links', 'themelia' ),
			'description' => esc_attr__( 'Colors for regular links.', 'themelia' ),
			'section'     => 'themelia_base_typography',
			'priority'    => 25,
			'choices'     => array(
				'link'    => esc_attr__( 'Color', 'themelia' ),
				'visited' => esc_attr__( 'Visited', 'themelia' ),
				'hover'   => esc_attr__( 'Hover', 'themelia' ),
				'active'  => esc_attr__( 'Active', 'themelia' ),
			),
			'default'     => array(
				'link'    => '#005ea5',
				'visited' => '#005ea5',
				'hover'   => '#2e3191',
				'active'  => '#2e3191',
			),
			'transport'   => 'auto',
			'output'      => array(
				array(
					'choice'   => 'link',
					'element'  => 'a',
					'property' => 'color',
				),
				array(
					'choice'   => 'visited',
					'element'  => 'a:visited',
					'property' => 'color',
				),
				array(
					'choice'   => 'hover',
					'element'  => 'a:hover',
					'property' => 'color',
				),
				array(
					'choice'   => 'active',
					'element'  => 'a:active',
					'property' => 'color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'     => 'custom',
			'settings' => 'custom_btn_header',
			'label'    => '',
			'section'  => 'themelia_base_typography',
			'default'  => esc_attr__( 'Buttons Color', 'themelia' ),
			'priority' => 10,
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'buttons_color',
			'label'       => esc_attr__( 'Buttons Color', 'themelia' ),
			'description' => esc_attr__( 'Colors for buttons.', 'themelia' ),
			'section'     => 'themelia_base_typography',
			'priority'    => 25,
			'choices'     => array(
				'btn-primary'    => esc_attr__( 'Primary (Form)', 'themelia' ),
				'btn-cart'       => esc_attr__( 'Cart (Shop)', 'themelia' ),
				'btn-secondary'  => esc_attr__( 'Secondary', 'themelia' ),
			),
			'default'     => array(
				'btn-primary'    => '#00823B',
				'btn-cart'       => '#00823B',
				'btn-secondary'  => '#E8E8E8',
			),
		) );



   /*
	* -> SECTION Modular Scale
	*
	*/
	Kirki::add_section( 'themelia_modular_scale', array(
		'title'          => __( 'Typographic Scale', 'themelia' ),
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	   /*
		* -> START Modular Scale
		*/

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'text',
			'settings'    => 'base_typography_xl',
			'label'       => esc_attr__( 'Extra Large screens', 'themelia' ),
			'description' => esc_attr__( 'Base font size for big desktops (1800px <).', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => '1.188em',
			'priority'    => 25
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'select',
			'settings'    => 'modular_scale_desktop_big',
			//'label'       => esc_attr__( 'Large screens', 'themelia' ),
			'description' => esc_attr__( 'Modular Scale for extra large screens.', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => 'perfect-fourth',
			'priority'    => 25,
			'multiple'    => 1,
			'choices'     => array(
				'major-second'   => esc_attr__( '[1.125] - Major Second ', 'themelia' ),
				'minor-third'    => esc_attr__( '[1.200] - Minor Third ', 'themelia' ),
				'major-third'    => esc_attr__( '[1.250] - Major Third ', 'themelia' ),
				'perfect-fourth' => esc_attr__( '[1.333] - Perfect Fourth ', 'themelia' ),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'text',
			'settings'    => 'base_typography_large',
			'label'       => esc_attr__( 'Large screens', 'themelia' ),
			'description' => esc_attr__( 'Base font size for desktops, laptops and some tablets in horizontal mode (1200px <> 1800px).', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => '1.188em',
			'priority'    => 25
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'select',
			'settings'    => 'modular_scale_desktop',
			//'label'       => esc_attr__( 'Large screens', 'themelia' ),
			'description' => esc_attr__( 'Modular Scale for large screens.', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => 'major-third',
			'priority'    => 25,
			'multiple'    => 1,
			'choices'     => array(
				'major-second'   => esc_attr__( '[1.125] - Major Second ', 'themelia' ),
				'minor-third'    => esc_attr__( '[1.200] - Minor Third ', 'themelia' ),
				'major-third'    => esc_attr__( '[1.250] - Major Third ', 'themelia' ),
				'perfect-fourth' => esc_attr__( '[1.333] - Perfect Fourth ', 'themelia' ),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'text',
			'settings'    => 'base_typography_medium',
			'label'       => esc_attr__( 'Mediums screens', 'themelia' ),
			'description' => esc_attr__( 'Base font size for Tablets and other medium size devices (600px <> 1200px).', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => '1.125em',
			'priority'    => 25
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'select',
			'settings'    => 'modular_scale_tablet',
			//'label'       => esc_attr__( 'Medium screens', 'themelia' ),
			'description' => esc_attr__( 'Modular Scale for medium screens.', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => 'major-second',
			'priority'    => 25,
			'multiple'    => 1,
			'choices'     => array(
				'major-second'   => esc_attr__( '[1.125] - Major Second ', 'themelia' ),
				'minor-third'    => esc_attr__( '[1.200] - Minor Third ', 'themelia' ),
				'major-third'    => esc_attr__( '[1.250] - Major Third ', 'themelia' ),
				'perfect-fourth' => esc_attr__( '[1.333] - Perfect Fourth ', 'themelia' ),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'text',
			'settings'    => 'base_typography_small',
			'label'       => esc_attr__( 'Small screens', 'themelia' ),
			'description' => esc_attr__( 'Base font size in for Smartphones and other small devices (< 600px).', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => '1em',
			'priority'    => 25
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'select',
			'settings'    => 'modular_scale_mobile',
			//'label'       => esc_attr__( 'Small screens', 'themelia' ),
			'description' => esc_attr__( 'Modular Scale for small screens.', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => 'minor-third',
			'priority'    => 25,
			'multiple'    => 1,
			'choices'     => array(
				'major-second'   => esc_attr__( '[1.125] - Major Second ', 'themelia' ),
				'minor-third'    => esc_attr__( '[1.200] - Minor Third ', 'themelia' ),
				'major-third'    => esc_attr__( '[1.250] - Major Third ', 'themelia' ),
				'perfect-fourth' => esc_attr__( '[1.333] - Perfect Fourth ', 'themelia' ),
			),
		) );


   /*
	* -> SECTION Headings & Entry Titles
	*
	*/
	Kirki::add_section( 'themelia_headings_typography', array(
		'title'          => esc_attr__( 'Headings &amp; Entry Titles', 'themelia' ),
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	   /*
		* -> START Headings
		*/
		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'headings_all',
			'label'       => esc_attr__( 'Headings', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'font-family' => 'Roboto',
				'variant'	  => '700',
				'line-height' => '1.2',
				//'color'       => '#121212',
				'subsets'     => array( 'latin' ),
			),
			'priority'  => 25,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element' => 'h1, h2, h3, h4, h5, h6',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'entry_title_link',
			'label'       => esc_attr__( 'Entry Title Link (Loop)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'priority'    => 25,
			'choices'     => array(
				'link'    => esc_attr__( 'Color', 'themelia' ),
				'visited' => esc_attr__( 'Visited', 'themelia' ),
				'hover'   => esc_attr__( 'Hover', 'themelia' ),
				'active'  => esc_attr__( 'Active', 'themelia' ),
			),
			'default'     => array(
				'link'    => '#121212',
				'visited' => '#121212',
				'hover'   => '#333',
				'active'  => '#444',
			),
			'transport'   => 'auto',
			'output'      => array(
				array(
				  'choice'   => 'link',
				  'element'  => '.entry-title a',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'visited',
				  'element'  => '.entry-title a:visited',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'hover',
				  'element'  => '.entry-title a:hover',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'active',
				  'element'  => '.entry-title a:active',
				  'property' => 'color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'		=> 'typography',
			'settings'	=> 'entry_title_link_2',
			//'label'	=> esc_attr__( '', 'themelia' ),
			'section'	=> 'themelia_headings_typography',
			'default'	=> array(
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'priority'	=> 25,
			'transport' => 'auto',
			'output'	=> array(
				array(
					'element' => '.plural .entry-title',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'	   => 'typography',
			'settings' => 'entry_title_singular',
			'label'    => esc_attr__( 'Entry Title (Single Post)', 'themelia' ),
			'section'  => 'themelia_headings_typography',
			'default'  => array(
				'color'          => '#121212',
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'priority'	=> 25,
			'transport' => 'auto',
			'output'	=> array(
				array(
					'element' => '.singular-post .entry-title',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'     => 'typography',
			'settings' => 'entry_title_page',
			'label'    => esc_attr__( 'Page Title', 'themelia' ),
			'section'  => 'themelia_headings_typography',
			'default'  => array(
				'color'          => '#121212',
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'priority'	=> 25,
			'transport' => 'auto',
			'output'	=> array(
				array(
					'element' => '.singular-page .entry-title',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'     => 'typography',
			'settings' => 'sidebar_widget_title',
			'label'    => esc_attr__( 'Widget Title (left or right sidebar)', 'themelia' ),
			'section'  => 'themelia_headings_typography',
			'default'  => array(
				'color'          => '#121212',
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'priority'	=> 25,
			'transport' => 'auto',
			'output'	=> array(
				array(
					'element' => '.sidebar-primary .widget-title',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'     => 'typography',
			'settings' => 'sidebar_footer_widget_title',
			'label'    => esc_attr__( 'Widget Title (footer sidebar)', 'themelia' ),
			'section'  => 'themelia_headings_typography',
			'default'  => array(
				'color'          => '#121212',
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'priority'	=> 25,
			'transport' => 'auto',
			'output'	=> array(
				array(
					'element' => '.sidebar-footer .widget-title',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'headings_h1',
			'label'       => esc_attr__( 'Headings 1 (H1)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'letter-spacing' => '0',
				'color'          => '#121212',
				'text-transform' => 'none',
			),
			'priority'  => 25,
			'transport' => 'auto',
			'output'   => array(
				array(
					'element' => '.entry-content h1',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'headings_h2',
			'label'       => esc_attr__( 'Headings 2 (H2)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'letter-spacing' => '0',
				'color'          => '#121212',
				'text-transform' => 'none',
			),
			'priority'  => 25,
			'transport' => 'auto',
			'output'   => array(
				array(
					'element' => '.entry-content h2',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'headings_h3',
			'label'       => esc_attr__( 'Headings 3 (H3)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'letter-spacing' => '0',
				'color'          => '#121212',
				'text-transform' => 'none',
			),
			'priority'  => 25,
			'transport' => 'auto',
			'output'   => array(
				array(
					'element' => '.entry-content h3',
				),
				array(
					'element' => '.sidebar-subsidiary h3',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'headings_h4',
			'label'       => esc_attr__( 'Headings 4 (H4)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'letter-spacing' => '0',
				'color'          => '#121212',
				'text-transform' => 'none',
			),
			'priority'    => 25,
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.entry-content h4',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'headings_h5',
			'label'       => esc_attr__( 'Headings 5 (H5)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'letter-spacing' => '0',
				'color'          => '#121212',
				'text-transform' => 'none',
			),
			'priority'  => 25,
			'transport' => 'auto',
			'output'   => array(
				array(
					'element' => '.entry-content h5',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'headings_h6',
			'label'       => esc_attr__( 'Headings 6 (H6)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'letter-spacing' => '0',
				'color'          => '#121212',
				'text-transform' => 'none',
			),
			'priority'  => 25,
			'transport' => 'auto',
			'output'   => array(
				array(
					'element' => '.entry-content h6',
				),
			),
		) );
		/* - END Headings
		 **/


   /*
	* -> SECTION Links & secondary
	*
	*/
	Kirki::add_section( 'themelia_secondary_typography', array(
		'title'          => __( 'Breadcrumbs & Secondary Text', 'themelia' ),
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	   /*
		* -> START Links & secondary
		*/

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'toggle',
			'settings'    => 'display_breadcrumbs',
			'label'       => __( 'Display Breadcrumbs', 'themelia' ),
			'description' => __( 'Check to display Breadcrumb navigation (below main menu).', 'themelia' ),
			'section'     => 'themelia_secondary_typography',
			'default'     => '1',
			'transport'   => 'auto',
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'secondary_font_link',
			'label'       => esc_attr__( 'Secondary Text Colors', 'themelia' ),
			'description' => esc_attr__( 'Colors for Secondary Text.', 'themelia' ),
			'section'     => 'themelia_secondary_typography',
			'priority'    => 25,
			'choices'     => array(
				'text'    => esc_attr__( 'Text', 'themelia' ),
				'link'    => esc_attr__( 'Link', 'themelia' ),
				'hover'   => esc_attr__( 'Hover', 'themelia' ),
				'active'  => esc_attr__( 'Active', 'themelia' ),
			),
			'default'     => array(
				'text'    => '#6d7377',
				'link'    => '#141414',
				'hover'   => 'rgba(0,0,0,0.7)',
				'active'  => 'rgba(0,0,0,0.7)',
			),
			'transport'   => 'auto',
			'output'     => array(
				array(
				  'choice'   => 'text',
				  'element'  => 'breadcrumb-trail, .secondary-text, .wp-caption-text',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'link',
				  'element'  => '.breadcrumb-trail a, .breadcrumb-trail a:visited, .entry-more-link, .entry-more-link:visited, .more-link, .more-link:visited, .social-navigation a, .social-navigation a:visited',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'hover',
				  'element'  => '.breadcrumb-trail a:hover, .entry-more-link:hover, .more-link:hover, .social-navigation a:hover',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'active',
				  'element'  => '.breadcrumb-trail a:active, .entry-more-link:active, .more-link:active, .social-navigation a:active',
				  'property' => 'color',
				),
			),
		) );


   /*
	* -> SECTION Colors
	*    Add into the default WP section - Colors (along with bacgeound color)
	*
	*/

	   /*
		* -> START General
		*/

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'posts_separator',
			'label'       => esc_attr__( 'Separators - Content', 'themelia' ),
			'description' => esc_attr__( 'Horizontal lines between posts.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.1)',
			'transport'   => 'auto',
			'choices'     => array(
				'alpha' => true,
			),
			'output'      => array(
				array(
				  'element'  => '.archive .post, .blog .post, .search .entry',
				  'property' => 'border-bottom-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'hr_separator',
		  //'label'       => esc_attr__( 'Separators', 'themelia' ),
			'description' => esc_attr__( 'Horizontal lines - hr tag.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.1)',
			'transport'   => 'auto',
			'choices'     => array(
				'alpha' => true,
			),
			'output'      => array(
				array(
				  'element'  => 'hr',
				  'property' => 'border-bottom-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'meta_separator_primary',
		  //'label'       => esc_attr__( 'Separators', 'themelia' ),
			'description' => esc_attr__( 'Author box top border.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.45)',
			'transport'   => 'auto',
			'choices'     => array(
				'alpha' => true,
			),
			'output'      => array(
				array(
				  'element'  => '.author-info',
				  'property' => 'border-top-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'meta_separator_secondary',
		  //'label'       => esc_attr__( 'Separators', 'themelia' ),
			'description' => esc_attr__( 'Posts navigation and Reply title top color.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.45)',
			'transport'   => 'auto',
			'choices'     => array(
				'alpha' => true,
			),
			'output'      => array(
				array(
				  'element'  => 'h4.comments-number',
				  'property' => 'border-top-color',
				),
				array(
				  'element'  => '.post-navigation .nav-links',
				  'property' => 'border-top-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'sideli_separator',
			'label'       => esc_attr__( 'Separators - Sidebar', 'themelia' ),
			'description' => esc_attr__( 'Sidebar list elements - thin border.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.1)',
			'transport'   => 'auto',
			'choices'     => array(
				'alpha' => true,
			),
			'output'      => array(
				array(
				  'element'  => '.main .sidebar li',
				  'property' => 'border-bottom-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'subsidiary_widget_area_separator',
			'label'       => esc_attr__( 'Separators - Sections', 'themelia' ),
			'description' => esc_attr__( 'Horizontal top border between subsidiary widget area and content.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.1)',
			'transport'   => 'auto',
			'choices'     => array(
				'alpha' => true,
			),
			'output'      => array(
				array(
				  'element'  => '.sidebar-subsidiary',
				  'property' => 'border-top-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'footer_widgets_area_separator',
		  //'label'       => esc_attr__( 'Separators - Sections', 'themelia' ),
			'description' => esc_attr__( 'Horizontal top border for footer widgets area.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.1)',
			'transport'   => 'auto',
			'choices'     => array(
				'alpha' => true,
			),
			'output'      => array(
				array(
				  'element'  => '.sidebar-footer',
				  'property' => 'border-top-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'footer_copyright_separator',
		  //'label'       => esc_attr__( 'Separators - Sections', 'themelia' ),
			'description' => esc_attr__( 'Horizontal top border for footer (copyright area).', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.1)',
			'transport'   => 'auto',
			'choices'     => array(
				'alpha' => true,
			),
			'output'      => array(
				array(
				  'element'  => '.site-footer',
				  'property' => 'border-top-color',
				),
			),
		) );

	/*
 	* -> SECTION Blog Settings
 	*
 	*/
 	Kirki::add_section( 'themelia_blog_settings', array(
 		'title'          => __( 'Blog Settings', 'themelia' ),
 		'priority'       => 25,
 		'capability'     => 'edit_theme_options',
 	) );

 	   /*
 		* -> START Blog Settings
 		*/

			Kirki::add_field( 'themelia_config', array(
				'type'        => 'checkbox',
				'settings'    => 'postby_excerpt',
				'label'       => __( 'Hide author - Post Excerpt', 'themelia' ),
				'description' => __( 'If checked author name (post by) will not be shown along with post date on post excerpt.', 'themelia' ),
				'section'     => 'themelia_blog_settings',
				'default'     => '',
			) );

			Kirki::add_field( 'themelia_config', array(
				'type'        => 'checkbox',
				'settings'    => 'postby_full',
				'label'       => __( 'Hide author - Single Post', 'themelia' ),
				'description' => __( 'If checked author name (post by) will not be shown along with post date on single post.', 'themelia' ),
				'section'     => 'themelia_blog_settings',
				'default'     => '',
			) );

	 		Kirki::add_field( 'themelia_config', array(
	 			'type'        => 'radio',
	 			'settings'    => 'comments_link_visual',
	 			'label'       => __( 'Comments Link', 'themelia' ),
	 			'description' => __( 'Change the look of the comments link. Shown next to date and author name (if comments are not disallowed in Discussion Settings or per individual article).', 'themelia' ),
	 			'section'     => 'themelia_blog_settings',
	 			'default'     => 'cl_text',
				'choices'     => array(
					'cl_text' => array(
						esc_attr__( 'Textual Link (eg. 5 comments)', 'themelia' ),
						esc_attr__( 'Display textual link along with the number of comments.', 'themelia' ),
					),
					'cl_icon'   => array(
						esc_attr__( 'Icon Link (eg. icon 5)', 'themelia' ),
						esc_attr__( 'Display Icon along with the number of comments.', 'themelia' ),
					),
				),
	 		) );

			Kirki::add_field( 'themelia_config', array(
				'type'        => 'checkbox',
				'settings'    => 'comments_link_zero',
				'label'       => __( 'Show "0 comments" or "icon 0"', 'themelia' ),
				'description' => __( 'By default "0 comments" message is hidden. If checked the comments link will be shown even if no comments are left for particular post (on both excerpt and single post). (Default: unchecked)', 'themelia' ),
				'section'     => 'themelia_blog_settings',
				'default'     => '',
			) );

			Kirki::add_field( 'themelia_config', array(
	 			'type'        => 'checkbox',
	 			'settings'    => 'comments_link_excerpt',
	 			'label'       => __( 'Hide on Post Excerpt', 'themelia' ),
	 			'description' => __( 'If checked the comments link will not be shown on post excerpt. (Default: unchecked)', 'themelia' ),
	 			'section'     => 'themelia_blog_settings',
	 			'default'     => '',
	 		) );

			Kirki::add_field( 'themelia_config', array(
	 			'type'        => 'checkbox',
	 			'settings'    => 'comments_link_full',
	 			'label'       => __( 'Hide on Single Post', 'themelia' ),
	 			'description' => __( 'If checked the comments link will not be shown on single post. (Default: unchecked)', 'themelia' ),
	 			'section'     => 'themelia_blog_settings',
	 			'default'     => '',
	 		) );

			Kirki::add_field( 'themelia_config', array(
	 			'type'        => 'radio',
	 			'settings'    => 'excerpt_or_content',
	 			'label'       => __( 'Excerpts or Full Post Content on archives', 'themelia' ),
	 			'description' => __( 'Switch between displaying Excerpts or Full Content. Applies to the normal post format on the blog page, archives and search results.', 'themelia' ),
	 			'section'     => 'themelia_blog_settings',
	 			'default'     => 'excerpt',
				'choices'     => array(
					'excerpt' => array(
						esc_attr__( 'Excerpt (Default)', 'themelia' ),
						esc_attr__( 'Use auto excerpt or manual excerpt. To manually add an excerpt to a post, simply write one in the Excerpt field under the post edit box. An excerpt can be as short or as long as you wish. When a post has no manual excerpt WordPress generates an excerpt automatically by selecting the first 55 words of the post.', 'themelia' ),
					),
					'full'   => array(
						esc_attr__( 'Full Content', 'themelia' ),
						esc_attr__( 'The full post content will be displayed, optionally you may use the More tag to create a teaser from the content that precedes the More tag. ', 'themelia' ),
					),
				),
	 		) );

		/* - END General
		 **/
}
