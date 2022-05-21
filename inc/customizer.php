<?php
/**
 * Software Agency Theme Customizer
 *
 * @package Software Agency
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function software_agency_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'software_agency_custom_controls' );

function software_agency_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 
		'selector' => '.logo .site-title a', 
	 	'render_callback' => 'software_agency_customize_partial_blogname',
	)); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
		'selector' => 'p.site-description', 
		'render_callback' => 'software_agency_customize_partial_blogdescription',
	));

	//add home page setting pannel
	$software_agency_parent_panel = new Software_Agency_WP_Customize_Panel( $wp_customize, 'software_agency_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'VW Settings', 'software-agency' ),
		'priority' => 10,
	));

	// Layout
	$wp_customize->add_section( 'software_agency_left_right', array(
    	'title' => esc_html__( 'General Settings', 'software-agency' ),
		'panel' => 'software_agency_panel_id'
	) );

	$wp_customize->add_setting('software_agency_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'software_agency_sanitize_choices'
	));
	$wp_customize->add_control(new Software_Agency_Image_Radio_Control($wp_customize, 'software_agency_width_option', array(
        'type' => 'select',
        'label' => esc_html__('Width Layouts','software-agency'),
        'description' => esc_html__('Here you can change the width layout of Website.','software-agency'),
        'section' => 'software_agency_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/assets/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/assets/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/assets/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('software_agency_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'software_agency_sanitize_choices'
	));
	$wp_customize->add_control('software_agency_theme_options',array(
        'type' => 'select',
        'label' => esc_html__('Post Sidebar Layout','software-agency'),
        'description' => esc_html__('Here you can change the sidebar layout for posts. ','software-agency'),
        'section' => 'software_agency_left_right',
        'choices' => array(
            'Left Sidebar' => esc_html__('Left Sidebar','software-agency'),
            'Right Sidebar' => esc_html__('Right Sidebar','software-agency'),
            'One Column' => esc_html__('One Column','software-agency'),
            'Three Columns' => esc_html__('Three Columns','software-agency'),
            'Four Columns' => esc_html__('Four Columns','software-agency'),
            'Grid Layout' => esc_html__('Grid Layout','software-agency')
        ),
	) );

	$wp_customize->add_setting('software_agency_page_layout',array(
        'default' => 'One Column',
        'sanitize_callback' => 'software_agency_sanitize_choices'
	));
	$wp_customize->add_control('software_agency_page_layout',array(
        'type' => 'select',
        'label' => esc_html__('Page Sidebar Layout','software-agency'),
        'description' => esc_html__('Here you can change the sidebar layout for pages. ','software-agency'),
        'section' => 'software_agency_left_right',
        'choices' => array(
            'Left Sidebar' => esc_html__('Left Sidebar','software-agency'),
            'Right Sidebar' => esc_html__('Right Sidebar','software-agency'),
            'One Column' => esc_html__('One Column','software-agency')
        ),
	) );

    //Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'software_agency_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'software_agency_switch_sanitization'
    ) );
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','software-agency' ),
		'section' => 'software_agency_left_right'
    )));

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'software_agency_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'software_agency_switch_sanitization'
    ) );
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','software-agency' ),
		'section' => 'software_agency_left_right'
    )));

    //Pre-Loader
	$wp_customize->add_setting( 'software_agency_loader_enable',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'software_agency_switch_sanitization'
    ) );
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','software-agency' ),
        'section' => 'software_agency_left_right'
    )));

	$wp_customize->add_setting('software_agency_loader_icon',array(
        'default' => 'Two Way',
        'sanitize_callback' => 'software_agency_sanitize_choices'
	));
	$wp_customize->add_control('software_agency_loader_icon',array(
        'type' => 'select',
        'label' => esc_html__('Pre-Loader Type','software-agency'),
        'section' => 'software_agency_left_right',
        'choices' => array(
            'Two Way' => esc_html__('Two Way','software-agency'),
            'Dots' => esc_html__('Dots','software-agency'),
            'Rotate' => esc_html__('Rotate','software-agency')
        ),
	) );

	//Top Header
	$wp_customize->add_section( 'software_agency_top_header' , array(
    	'title' => esc_html__( 'Top Header', 'software-agency' ),
		'panel' => 'software_agency_panel_id'
	) );

	$wp_customize->add_setting('software_agency_top_bar_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('software_agency_top_bar_text',array(
		'label'	=> esc_html__('Anouncement Text','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Lorem ipsum dolor sit amet ipsum dolor sit amet.', 'software-agency' ),
        ),
		'section'=> 'software_agency_top_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('software_agency_support_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('software_agency_support_text',array(
		'label'	=> esc_html__('Support Text','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Support', 'software-agency' ),
        ),
		'section'=> 'software_agency_top_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('software_agency_support_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('software_agency_support_link',array(
		'label'	=> esc_html__('Support Link','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'https://www.example.com/support', 'software-agency' ),
        ),
		'section'=> 'software_agency_top_header',
		'type'=> 'url'
	));

	$wp_customize->add_setting('software_agency_wishlist_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('software_agency_wishlist_text',array(
		'label'	=> esc_html__('Wishlist Text','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Wishlist', 'software-agency' ),
        ),
		'section'=> 'software_agency_top_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('software_agency_wishlist_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('software_agency_wishlist_link',array(
		'label'	=> esc_html__('Wishlist Link','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'https://www.example.com/wishlist', 'software-agency' ),
        ),
		'section'=> 'software_agency_top_header',
		'type'=> 'url'
	));

	$wp_customize->add_setting('software_agency_location_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('software_agency_location_text',array(
		'label'	=> esc_html__('Location Text','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Our Address', 'software-agency' ),
        ),
		'section'=> 'software_agency_top_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('software_agency_phone_number_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('software_agency_phone_number_text',array(
		'label'	=> esc_html__('Phone Number Text','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Reach Us', 'software-agency' ),
        ),
		'section'=> 'software_agency_top_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('software_agency_phone_number',array(
		'default'=> '',
		'sanitize_callback'	=> 'software_agency_sanitize_phone_number'
	));	
	$wp_customize->add_control('software_agency_phone_number',array(
		'label'	=> esc_html__('Phone Number','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( '+91 123 456 7890', 'software-agency' ),
        ),
		'section'=> 'software_agency_top_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('software_agency_email_address_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('software_agency_email_address_text',array(
		'label'	=> esc_html__('Email Address Text','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Email Us At', 'software-agency' ),
        ),
		'section'=> 'software_agency_top_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('software_agency_email_address',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_email'
	));	
	$wp_customize->add_control('software_agency_email_address',array(
		'label'	=> esc_html__('Email Address','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'example@support.com', 'software-agency' ),
        ),
		'section'=> 'software_agency_top_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('software_agency_get_started_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('software_agency_get_started_text',array(
		'label'	=> esc_html__('Button Text','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Get Started', 'software-agency' ),
        ),
		'section'=> 'software_agency_top_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('software_agency_get_started_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('software_agency_get_started_link',array(
		'label'	=> esc_html__('Button Link','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'https://www.example.com/get-started', 'software-agency' ),
        ),
		'section'=> 'software_agency_top_header',
		'type'=> 'url'
	));

	//Slider
	$wp_customize->add_section( 'software_agency_slidersettings' , array(
    	'title' => esc_html__( 'Slider Settings', 'software-agency' ),
		'panel' => 'software_agency_panel_id'
	) );

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('software_agency_slider_arrows',array(
		'selector'        => '#slider .carousel-caption h1',
		'render_callback' => 'software_agency_customize_partial_software_agency_slider_arrows',
	));

	$wp_customize->add_setting( 'software_agency_slider_arrows',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'software_agency_switch_sanitization'
    ));  
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_slider_arrows',array(
      	'label' => esc_html__( 'Show / Hide Slider','software-agency' ),
      	'section' => 'software_agency_slidersettings'
    )));

	for ( $count = 1; $count <= 3; $count++ ) {
		$wp_customize->add_setting( 'software_agency_slider_page' . $count, array(
			'default'  => '',
			'sanitize_callback' => 'software_agency_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'software_agency_slider_page' . $count, array(
			'label'    => esc_html__( 'Select Slider Page', 'software-agency' ),
			'description' => esc_html__('Slider image size (1400 x 550)','software-agency'),
			'section'  => 'software_agency_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//content layout
	$wp_customize->add_setting('software_agency_slider_content_option',array(
        'default' => 'Left',
        'sanitize_callback' => 'software_agency_sanitize_choices'
	));
	$wp_customize->add_control(new Software_Agency_Image_Radio_Control($wp_customize, 'software_agency_slider_content_option', array(
        'type' => 'select',
        'label' => esc_html__('Slider Content Layouts','software-agency'),
        'section' => 'software_agency_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/slider-content3.png',
    ))));

    //Slider excerpt
	$wp_customize->add_setting( 'software_agency_slider_excerpt_number', array(
		'default'              => 25,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'software_agency_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'software_agency_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','software-agency' ),
		'section'     => 'software_agency_slidersettings',
		'type'        => 'range',
		'settings'    => 'software_agency_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );
 
	//Product Section
	$wp_customize->add_section('software_agency_product_section',array(
		'title'	=> esc_html__('BestSelling Product Section','software-agency'),
		'panel' => 'software_agency_panel_id',
	));

	$wp_customize->add_setting( 'software_agency_product_settings' , array(
		'default' => '',
		'sanitize_callback' => 'software_agency_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'software_agency_product_settings' , array(
		'label'    => esc_html__( 'Select Produt Page', 'software-agency' ),
		'section'  => 'software_agency_product_section',
		'type'     => 'dropdown-pages'
	) );

	//Blog Post
	$wp_customize->add_panel( $software_agency_parent_panel );

	$BlogPostParentPanel = new Software_Agency_WP_Customize_Panel( $wp_customize, 'software_agency_blog_post_parent_panel', array(
		'title' => esc_html__( 'Blog Post Settings', 'software-agency' ),
		'panel' => 'software_agency_panel_id',
		'priority' => 20,
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'software_agency_post_settings', array(
		'title' => esc_html__( 'Post Settings', 'software-agency' ),
		'panel' => 'software_agency_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('software_agency_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'software_agency_customize_partial_software_agency_toggle_postdate', 
	));

	$wp_customize->add_setting( 'software_agency_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'software_agency_switch_sanitization'
    ) );
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','software-agency' ),
        'section' => 'software_agency_post_settings'
    )));

    $wp_customize->add_setting( 'software_agency_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'software_agency_switch_sanitization'
    ) );
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_toggle_author',array(
		'label' => esc_html__( 'Author','software-agency' ),
		'section' => 'software_agency_post_settings'
    )));

    $wp_customize->add_setting( 'software_agency_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'software_agency_switch_sanitization'
    ) );
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_toggle_comments',array(
		'label' => esc_html__( 'Comments','software-agency' ),
		'section' => 'software_agency_post_settings'
    )));

    $wp_customize->add_setting( 'software_agency_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'software_agency_switch_sanitization'
	));
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_toggle_tags', array(
		'label' => esc_html__( 'Tags','software-agency' ),
		'section' => 'software_agency_post_settings'
    )));

    $wp_customize->add_setting( 'software_agency_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'software_agency_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'software_agency_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','software-agency' ),
		'section'     => 'software_agency_post_settings',
		'type'        => 'range',
		'settings'    => 'software_agency_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog layout
    $wp_customize->add_setting('software_agency_blog_layout_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'software_agency_sanitize_choices'
    ));
    $wp_customize->add_control(new Software_Agency_Image_Radio_Control($wp_customize, 'software_agency_blog_layout_option', array(
        'type' => 'select',
        'label' => esc_html__('Blog Layouts','software-agency'),
        'section' => 'software_agency_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout3.png',
    ))));

    $wp_customize->add_setting('software_agency_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'software_agency_sanitize_choices'
	));
	$wp_customize->add_control('software_agency_excerpt_settings',array(
        'type' => 'select',
        'label' => esc_html__('Post Content','software-agency'),
        'section' => 'software_agency_post_settings',
        'choices' => array(
        	'Content' => esc_html__('Content','software-agency'),
            'Excerpt' => esc_html__('Excerpt','software-agency'),
            'No Content' => esc_html__('No Content','software-agency')
        ),
	) );

    // Button Settings
	$wp_customize->add_section( 'software_agency_button_settings', array(
		'title' => esc_html__( 'Button Settings', 'software-agency' ),
		'panel' => 'software_agency_blog_post_parent_panel',
	));

	$wp_customize->add_setting( 'software_agency_button_border_radius', array(
		'default'              => 8,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'software_agency_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'software_agency_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','software-agency' ),
		'section'     => 'software_agency_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('software_agency_button_text', array( 
		'selector' => '.post-main-box .more-btn a', 
		'render_callback' => 'software_agency_customize_partial_software_agency_button_text', 
	));

    $wp_customize->add_setting('software_agency_button_text',array(
		'default'=> esc_html__('READ MORE','software-agency'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('software_agency_button_text',array(
		'label'	=> esc_html__('Add Button Text','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'READ MORE', 'software-agency' ),
        ),
		'section'=> 'software_agency_button_settings',
		'type'=> 'text'
	));

	// Related Post Settings
	$wp_customize->add_section( 'software_agency_related_posts_settings', array(
		'title' => esc_html__( 'Related Posts Settings', 'software-agency' ),
		'panel' => 'software_agency_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('software_agency_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'software_agency_customize_partial_software_agency_related_post_title', 
	));

    $wp_customize->add_setting( 'software_agency_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'software_agency_switch_sanitization'
    ) );
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_related_post',array(
		'label' => esc_html__( 'Related Post','software-agency' ),
		'section' => 'software_agency_related_posts_settings'
    )));

    $wp_customize->add_setting('software_agency_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('software_agency_related_post_title',array(
		'label'	=> esc_html__('Add Related Post Title','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Related Post', 'software-agency' ),
        ),
		'section'=> 'software_agency_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('software_agency_related_posts_count',array(
		'default'=> 3,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('software_agency_related_posts_count',array(
		'label'	=> esc_html__('Add Related Post Count','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( '3', 'software-agency' ),
        ),
		'section'=> 'software_agency_related_posts_settings',
		'type'=> 'number'
	));

	//Responsive Media Settings
	$wp_customize->add_section('software_agency_responsive_media',array(
		'title'	=> esc_html__('Responsive Media','software-agency'),
		'panel' => 'software_agency_panel_id',
	));

    $wp_customize->add_setting( 'software_agency_resp_slider_hide_show',array(
      	'default' => 1,
     	'transport' => 'refresh',
      	'sanitize_callback' => 'software_agency_switch_sanitization'
    ));  
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_resp_slider_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Slider','software-agency' ),
      	'section' => 'software_agency_responsive_media'
    )));

	$wp_customize->add_setting( 'software_agency_metabox_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'software_agency_switch_sanitization'
    ));  
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_metabox_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Metabox','software-agency' ),
      	'section' => 'software_agency_responsive_media'
    )));

    $wp_customize->add_setting( 'software_agency_sidebar_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'software_agency_switch_sanitization'
    ));  
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_sidebar_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Sidebar','software-agency' ),
      	'section' => 'software_agency_responsive_media'
    )));

    $wp_customize->add_setting( 'software_agency_resp_scroll_top_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'software_agency_switch_sanitization'
    ));  
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_resp_scroll_top_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','software-agency' ),
      	'section' => 'software_agency_responsive_media'
    )));

	//Footer Text
	$wp_customize->add_section('software_agency_footer',array(
		'title'	=> esc_html__('Footer Settings','software-agency'),
		'panel' => 'software_agency_panel_id',
	));	

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('software_agency_footer_text', array( 
		'selector' => '.copyright p a', 
		'render_callback' => 'software_agency_customize_partial_software_agency_footer_text', 
	));
	
	$wp_customize->add_setting('software_agency_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('software_agency_footer_text',array(
		'label'	=> esc_html__('Copyright Text','software-agency'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Copyright 2020, .....', 'software-agency' ),
        ),
		'section'=> 'software_agency_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('software_agency_copyright_alingment',array(
        'default' => 'center',
        'sanitize_callback' => 'software_agency_sanitize_choices'
	));
	$wp_customize->add_control(new Software_Agency_Image_Radio_Control($wp_customize, 'software_agency_copyright_alingment', array(
        'type' => 'select',
        'label' => esc_html__('Copyright Alignment','software-agency'),
        'section' => 'software_agency_footer',
        'settings' => 'software_agency_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/assets/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/assets/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/assets/images/copyright3.png'
    ))));

	$wp_customize->add_setting( 'software_agency_footer_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'software_agency_switch_sanitization'
    ));  
    $wp_customize->add_control( new Software_Agency_Toggle_Switch_Custom_Control( $wp_customize, 'software_agency_footer_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll to Top','software-agency' ),
      	'section' => 'software_agency_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('software_agency_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'software_agency_customize_partial_software_agency_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('software_agency_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'software_agency_sanitize_choices'
	));
	$wp_customize->add_control(new Software_Agency_Image_Radio_Control($wp_customize, 'software_agency_scroll_top_alignment', array(
        'type' => 'select',
        'label' => esc_html__('Scroll To Top','software-agency'),
        'section' => 'software_agency_footer',
        'settings' => 'software_agency_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout3.png'
    ))));

    // Has to be at the top
	$wp_customize->register_panel_type( 'Software_Agency_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'Software_Agency_WP_Customize_Section' );
}

add_action( 'customize_register', 'software_agency_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class Software_Agency_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'software_agency_panel';
	    public function json() {
			$array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
			$array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
			$array['content'] = $this->get_content();
			$array['active'] = $this->active();
			$array['instanceNumber'] = $this->instance_number;
			return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class Software_Agency_WP_Customize_Section extends WP_Customize_Section {
	    public $section;
	    public $type = 'software_agency_section';
	    public function json() {
			$array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
			$array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
			$array['content'] = $this->get_content();
			$array['active'] = $this->active();
			$array['instanceNumber'] = $this->instance_number;

			if ( $this->panel ) {
			$array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
			} else {
			$array['customizeAction'] = 'Customizing';
			}
			return $array;
    	}
  	}
}

// Enqueue our scripts and styles
function software_agency_customize_controls_scripts() {
	wp_enqueue_script( 'software-agency-customizer-controls', get_theme_file_uri( '/assets/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'software_agency_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Software_Agency_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Software_Agency_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new Software_Agency_Customize_Section_Pro( $manager,'software_agency_go_pro', array(
			'priority'   => 1,
			'title'    => esc_html__( 'SOFTWARE AGENCY PRO', 'software-agency' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'software-agency' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/software-company-wordpress-theme/'),
		) )	);

		$manager->add_section(new Software_Agency_Customize_Section_Pro($manager,'software_agency_get_started_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'Documentation', 'software-agency' ),
			'pro_text' => esc_html__( 'Docs', 'software-agency' ),
			'pro_url'  => admin_url('themes.php?page=software_agency_guide'),
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'software-agency-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'software-agency-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Software_Agency_Customize::get_instance();