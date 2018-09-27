<?php

/**
 * Customize for taxonomy with dropdown, extend the WP customizer
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

if ( ! function_exists( 'multiuso_customize_register' ) ) {
	function multiuso_customize_register( $wp_customize ) {

		//Divider
		class Multiuso_Divider extends WP_Customize_Control {
			public function render_content() {
				echo '<hr style="margin: 15px 0;border-top: 1px dashed #919191;" />';
			}
		}

		//Titles
		class Multiuso_Info extends WP_Customize_Control {
			public $type = 'info';
			public $label = '';

			public function render_content() {
				?>
                <h3 style="margin-top:30px;border:1px solid;padding:5px;color:#58719E;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
				<?php
			}
		}

		//Titles
		class Multiuso_Theme_Info extends WP_Customize_Control {
			public $type = 'info';
			public $label = '';

			public function render_content() {
				?>
                <h3><?php echo esc_html( $this->label ); ?></h3>
				<?php
			}
		}


		//___Footer area___//
		$wp_customize->add_panel( 'multiuso_header_panel', array(
			'priority'       => 100,
			'capability'     => 'manage_options',
			'theme_supports' => '',
			'title'          => __( 'Header area', 'multiuso' ),
		) );

		$wp_customize->add_section(
			'multiuso_header_meta',
			array(
				'title'       => __( 'Navigation Settings', 'multiuso' ),
				'priority'    => 100,
				'panel'       => 'multiuso_header_panel',
				'description' => __( 'checked this checkbox to active offcanvas navigation on all screen size.',
					'multiuso' ),
			)
		);
		$wp_customize->add_setting(
			'multiuso_offcanvas',
			array(
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'multiuso_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'multiuso_offcanvas',
			array(
				'type'    => 'checkbox',
				'section' => 'multiuso_header_meta',
				'label'   => __( 'Off-canvas Navigation', 'multiuso' ),
			)
		);

		function multiuso_sanitize_checkbox( $checked ) {
			// Boolean check.
			return ( ( isset( $checked ) && true == $checked ) ? true : false );
		}

		$wp_customize->add_section(
			'multiuso_header_carousel',
			array(
				'title'       => __( 'Blog Page Post Carousel', 'multiuso' ),
				'priority'    => 100,
				'panel'       => 'multiuso_header_panel',
				'description' => __( 'Select the category you want to view in carousel.', 'multiuso' ),
			)
		);
		/*select taxonomy*/
		$wp_customize->add_setting( 'multiuso_taxonomy_dropdown_setting', array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_data'
		) );

		$wp_customize->add_control( new MULTIUSO_My_Dropdown_Category_Control( $wp_customize,
			'multiuso_taxonomy_dropdown_setting', array(
				'section'     => 'multiuso_header_carousel',
				'label'       => esc_html__( 'Slider posts category', 'multiuso' ),
				'description' => esc_html__( 'Select the category that the slider will show posts from. If no category is selected, the slider will be disabled.',
					'multiuso' ),
				// Uncomment to pass arguments to wp_dropdown_categories()
				//'dropdown_args' => array(
				//	'taxonomy' => 'post_tag',
				//),
			) ) );
		//add number of post
		$wp_customize->add_setting(
			'multiuso_header_carousel_number_of_post',
			array(
				'default'           => '5',
				'sanitize_callback' => 'wp_kses_data',
			)
		);

		$wp_customize->add_control(
			'multiuso_header_carousel_number_of_post',
			array(
				'label'       => __( 'Number Of Post', 'multiuso' ),
				'section'     => 'multiuso_header_carousel',
				'description' => __( 'Give the numaric value how many post you want to show in carousel.', 'multiuso' ),
			)
		);
		/*__Taxanomy Carousel__*/
		$wp_customize->add_section(
			'multiuso_taxanomy_carousel',
			array(
				'title'       => __( 'Category Carousel', 'multiuso' ),
				'priority'    => 100,
				'panel'       => 'multiuso_header_panel',
				'description' => __( 'checked this checkbox to active taxanomy carousel.', 'multiuso' ),
			)
		);
		$wp_customize->add_setting(
			'multiuso_taxanomy_carousel_checkbox',
			array(
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'multiuso_taxanomy_carousel_sanitize_checkbox',
				'default'           => true,
			)
		);

		$wp_customize->add_control(
			'multiuso_taxanomy_carousel_checkbox',
			array(
				'type'    => 'checkbox',
				'section' => 'multiuso_taxanomy_carousel',
				'label'   => __( 'Active Carousel', 'multiuso' ),
			)
		);

		function multiuso_taxanomy_carousel_sanitize_checkbox( $checked ) {
			// Boolean check.
			return ( ( isset( $checked ) && true == $checked ) ? true : false );
		}

		//___Footer area___//
		$wp_customize->add_panel( 'multiuso_footer_panel', array(
			'priority'       => 100,
			'capability'     => 'manage_options',
			'theme_supports' => '',
			'title'          => __( 'Footer area', 'multiuso' ),
		) );

		$wp_customize->add_section(
			'multiuso_footer_meta',
			array(
				'title'       => __( 'Footer Meta', 'multiuso' ),
				'priority'    => 100,
				'panel'       => 'multiuso_footer_panel',
				'description' => __( 'Copyright Text', 'multiuso' ),
			)
		);
		//Front page
		$wp_customize->add_setting(
			'front_footer_meta',
			array(
				'default'           => '',
				'sanitize_callback' => 'wp_kses_data',
			)
		);

		$wp_customize->add_control(
			'front_footer_meta',
			array(
				'type'        => 'textarea',
				'label'       => __( 'Footer Copyright Text', 'multiuso' ),
				'section'     => 'multiuso_footer_meta',
				'description' => __( 'Add the footer copyright text for front page', 'multiuso' ),
			)
		);


		// add a setting for the site logo
		$wp_customize->add_setting(
			'your_theme_logo',
			array(
				'default'           => '#',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		// Add a control to upload the logo
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'your_theme_logo',
			array(
				'label'       => __( 'Upload Logo', 'multiuso' ),
				'section'     => 'title_tagline',
				'settings'    => 'your_theme_logo',
				'description' => __( 'Upload logo for footer', 'multiuso' ),
			)
		) );
		// Add theme primary color.
		$wp_customize->add_setting( 'parimary_color', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'parimary_color', array(
			'label'   => __( 'Parimary Color', 'multiuso' ),
			'section' => 'colors',
		) ) );
		// Add theme secondary color.
		$wp_customize->add_setting( 'secondary_color', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
			'label'   => __( 'Secondary Color', 'multiuso' ),
			'section' => 'colors',
		) ) );
		// Add theme Header color.
		$wp_customize->add_setting( 'header_color', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
			'label'   => __( 'Header Background Color', 'multiuso' ),
			'section' => 'colors',
		) ) );
		// Add link color setting and control.
		$wp_customize->add_setting( 'link_color', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'   => __( 'Link Color', 'multiuso' ),
			'section' => 'colors',
		) ) );
		// Add link hover color setting and control.
		$wp_customize->add_setting( 'link_hover_color', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
			'label'   => __( 'Link Hover Color', 'multiuso' ),
			'section' => 'colors',
		) ) );
	}
}
add_action( 'customize_register', 'multiuso_customize_register' );

if ( ! class_exists( 'MULTIUSO_My_Dropdown_Category_Control' ) ) {
	class MULTIUSO_My_Dropdown_Category_Control extends WP_Customize_Control {
		/**
		 * @access public
		 * @var    array
		 */
		public $defaults = array();

		public $type = 'dropdown-category';
		protected $dropdown_args = false;

		protected function render_content() {
			?><label><?php
			if ( ! empty( $this->label ) ) :
				?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
			endif;
			if ( ! empty( $this->description ) ) :
				?><span class="description customize-control-description"><?php echo $this->description; ?></span><?php
			endif;
			// Set defaults
			$this->defaults        = array(
				'show_option_none' => __( 'None (This will make carousel deactivate)', 'multiuso' ),
				'orderby'          => 'name',
				'hide_empty'       => 0,
				'id'               => $this->id,
				'selected'         => $this->value(),
				'hierarchical'     => true
			);
			$dropdown_args         = wp_parse_args( $this->dropdown_args, $this->defaults );
			$dropdown_args['echo'] = false;
			$dropdown              = wp_dropdown_categories( $dropdown_args );
			$dropdown              = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
			echo $dropdown;
			?></label><?php
		}
	}
}