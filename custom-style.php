<?php
	/*---------------------------First highlight color-------------------*/

	$software_agency_first_color = get_theme_mod('software_agency_first_color');

	$software_agency_custom_css= "";

	if($software_agency_first_color != false){
		$software_agency_custom_css .='.wp-block-button .wp-block-button__link:hover, .post-main-box:hover h2 a, .post-main-box:hover .post-info a, .post-info:hover a, .middle-bar strong a:hover{';
			$software_agency_custom_css .='color: '.esc_attr($software_agency_first_color).'!important;';
		$software_agency_custom_css .='}';
	}

	if($software_agency_first_color != false){
		$software_agency_custom_css .='.woocommerce ul.products li.product a img{';
			$software_agency_custom_css .='border-color: '.esc_attr($software_agency_first_color).';';
		$software_agency_custom_css .='}';
	}

	/*---------------- Second highlight color-------------------*/

	$software_agency_second_color = get_theme_mod('software_agency_second_color');

	if($software_agency_second_color != false){
		$software_agency_custom_css .='a{';
			$software_agency_custom_css .='color: '.esc_attr($software_agency_second_color).';';
		$software_agency_custom_css .='}';
	}

	if($software_agency_first_color != false || $software_agency_second_color != false){
		$software_agency_custom_css .='.custom-social-icons i:hover,.main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a, .main-navigation a:hover, .more-btn a,#comments input[type="submit"],#comments a.comment-reply-link,input[type="submit"],.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,nav.woocommerce-MyAccount-navigation ul li, .scrollup i, .pagination span, .pagination a, .widget_product_search button, .toggle-nav i, .woocommerce ul.products li.product:hover span.onsale{
		background: linear-gradient(to right, '.esc_attr($software_agency_first_color).', '.esc_attr($software_agency_second_color).');
		}';
	}

	/*---------------- Third highlight color-------------------*/

	$software_agency_third_color = get_theme_mod('software_agency_third_color');

	if($software_agency_third_color != false){
		$software_agency_custom_css .='.slide-search input[type="submit"],.get-start-btn, #footer-2,.main-inner-box span.entry-date,.more-btn a:hover,input[type="submit"]:hover,#comments input[type="submit"]:hover,#comments a.comment-reply-link:hover,#slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover,#sidebar h3,.pagination .current,.pagination a:hover,#footer .tagcloud a:hover,#sidebar .tagcloud a:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce span.onsale,.widget_product_search button:hover{';
			$software_agency_custom_css .='background-color: '.esc_attr($software_agency_third_color).';';
		$software_agency_custom_css .='}';
	}

	if($software_agency_third_color != false){
		$software_agency_custom_css .='#footer .textwidget a,#footer li a:hover,.post-main-box:hover h3 a,#sidebar ul li a:hover,.post-navigation a:hover .post-title, .post-navigation a:focus .post-title,.post-navigation a:hover,.post-navigation a:focus, nav.woocommerce-MyAccount-navigation ul li a:hover{';
			$software_agency_custom_css .='color: '.esc_attr($software_agency_third_color).';';
		$software_agency_custom_css .='}';
	}

	/*---------------- Fourth highlight color-------------------*/

	$software_agency_fourth_color = get_theme_mod('software_agency_fourth_color');

	if($software_agency_fourth_color != false){
		$software_agency_custom_css .='#slider .carousel-control-prev-icon,  #slider .carousel-control-next-icon, #footer{';
			$software_agency_custom_css .='background-color: '.esc_attr($software_agency_fourth_color).';';
		$software_agency_custom_css .='}';
	}

	if($software_agency_fourth_color != false){
		$software_agency_custom_css .='h1,h2,h3,h4,h5,h6, .slide-search input[type="submit"],p.site-title a, .logo h1 a, p.site-description,.middle-bar strong,.middle-bar i.fas.fa-phone,.middle-bar i.fas.fa-envelope-open,.get-start-btn a,span.cart_no i,.more-btn a:hover,input[type="submit"]:hover,#comments input[type="submit"]:hover,#comments a.comment-reply-link:hover,#slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover,#sidebar h3,.copyright p a,.pagination .current,.pagination a:hover,#footer .tagcloud a:hover,#sidebar h3 a.rsswidget,#sidebar .tagcloud a:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce span.onsale,.widget_product_search button:hover, #slider .carousel-control-next-icon:hover,#slider .carousel-control-prev-icon:hover,#about-us strong, #slider .carousel-caption h1 a, .post-main-box h2 a,.post-info span a, .woocommerce div.product .product_title, .woocommerce div.product p.price, .woocommerce div.product span.price,.woocommerce ul.products li.product .price, .woocommerce .quantity .qty{';
			$software_agency_custom_css .='color: '.esc_attr($software_agency_fourth_color).';';
		$software_agency_custom_css .='}';
	}

	if($software_agency_fourth_color != false){
		$software_agency_custom_css .='.woocommerce .quantity .qty{';
			$software_agency_custom_css .='border-color: '.esc_attr($software_agency_fourth_color).';';
		$software_agency_custom_css .='}';
	}

	/*---------------------------Width Layout -------------------*/

	$software_agency_theme_lay = get_theme_mod( 'software_agency_width_option','Full Width');
    if($software_agency_theme_lay == 'Boxed'){
		$software_agency_custom_css .='body{';
			$software_agency_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$software_agency_custom_css .='}';
		$software_agency_custom_css .='#slider .carousel-caption h1 a{';
			$software_agency_custom_css .='font-size: 50px;';
		$software_agency_custom_css .='}';
		$software_agency_custom_css .='#slider .carousel-control-prev, #slider .carousel-control-next{';
			$software_agency_custom_css .='bottom: 20px;';
		$software_agency_custom_css .='}';
	}else if($software_agency_theme_lay == 'Wide Width'){
		$software_agency_custom_css .='body{';
			$software_agency_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$software_agency_custom_css .='}';
	}else if($software_agency_theme_lay == 'Full Width'){
		$software_agency_custom_css .='body{';
			$software_agency_custom_css .='max-width: 100%;';
		$software_agency_custom_css .='}';
	}

	/*--------------------------- Slider Content Layout -------------------*/

	$software_agency_theme_lay = get_theme_mod( 'software_agency_slider_content_option','Left');
    if($software_agency_theme_lay == 'Left'){
		$software_agency_custom_css .='#slider .carousel-caption{';
			$software_agency_custom_css .='text-align:left; right: 20%;';
		$software_agency_custom_css .='}';
	}else if($software_agency_theme_lay == 'Center'){
		$software_agency_custom_css .='#slider .carousel-caption{';
			$software_agency_custom_css .='text-align:center; right: 10%; left: 10%;';
		$software_agency_custom_css .='}';
	}else if($software_agency_theme_lay == 'Right'){
		$software_agency_custom_css .='#slider .carousel-caption{';
			$software_agency_custom_css .='text-align:right; right: 10%; left: 20%;';
		$software_agency_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$software_agency_theme_lay = get_theme_mod( 'software_agency_blog_layout_option','Default');
    if($software_agency_theme_lay == 'Default'){
		$software_agency_custom_css .='.post-main-box{';
			$software_agency_custom_css .='';
		$software_agency_custom_css .='}';
	}else if($software_agency_theme_lay == 'Center'){
		$software_agency_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p{';
			$software_agency_custom_css .='text-align:center;';
		$software_agency_custom_css .='}';
		$software_agency_custom_css .='.post-info{';
			$software_agency_custom_css .='margin-top:10px;';
		$software_agency_custom_css .='}';
	}else if($software_agency_theme_lay == 'Left'){
		$software_agency_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, #our-services p{';
			$software_agency_custom_css .='text-align:Left;';
		$software_agency_custom_css .='}';
		$software_agency_custom_css .='.post-main-box h2{';
			$software_agency_custom_css .='margin-top:10px;';
		$software_agency_custom_css .='}';
	}

	/*----------------Responsive Media -----------------------*/

	$software_agency_resp_slider = get_theme_mod( 'software_agency_resp_slider_hide_show',false);
	if($software_agency_resp_slider == true && get_theme_mod( 'software_agency_slider_arrows', false) == false){
    	$software_agency_custom_css .='#slider{';
			$software_agency_custom_css .='display:none;';
		$software_agency_custom_css .='} ';
	}
    if($software_agency_resp_slider == true){
    	$software_agency_custom_css .='@media screen and (max-width:575px) {';
		$software_agency_custom_css .='#slider{';
			$software_agency_custom_css .='display:block;';
		$software_agency_custom_css .='} }';
	}else if($software_agency_resp_slider == false){
		$software_agency_custom_css .='@media screen and (max-width:575px) {';
		$software_agency_custom_css .='#slider{';
			$software_agency_custom_css .='display:none;';
		$software_agency_custom_css .='} }';
	}

	$software_agency_resp_metabox = get_theme_mod( 'software_agency_metabox_hide_show',true);
    if($software_agency_resp_metabox == true){
    	$software_agency_custom_css .='@media screen and (max-width:575px) {';
		$software_agency_custom_css .='.post-info{';
			$software_agency_custom_css .='display:block;';
		$software_agency_custom_css .='} }';
	}else if($software_agency_resp_metabox == false){
		$software_agency_custom_css .='@media screen and (max-width:575px) {';
		$software_agency_custom_css .='.post-info{';
			$software_agency_custom_css .='display:none;';
		$software_agency_custom_css .='} }';
	}

	$software_agency_resp_sidebar = get_theme_mod( 'software_agency_sidebar_hide_show',true);
    if($software_agency_resp_sidebar == true){
    	$software_agency_custom_css .='@media screen and (max-width:575px) {';
		$software_agency_custom_css .='#sidebar{';
			$software_agency_custom_css .='display:block;';
		$software_agency_custom_css .='} }';
	}else if($software_agency_resp_sidebar == false){
		$software_agency_custom_css .='@media screen and (max-width:575px) {';
		$software_agency_custom_css .='#sidebar{';
			$software_agency_custom_css .='display:none;';
		$software_agency_custom_css .='} }';
	}

	$software_agency_resp_scroll_top = get_theme_mod( 'software_agency_resp_scroll_top_hide_show',true);
	if($software_agency_resp_scroll_top == true && get_theme_mod( 'software_agency_footer_scroll',true) != true){
    	$software_agency_custom_css .='.scrollup i{';
			$software_agency_custom_css .='visibility:hidden !important;';
		$software_agency_custom_css .='} ';
	}
    if($software_agency_resp_scroll_top == true){
    	$software_agency_custom_css .='@media screen and (max-width:575px) {';
		$software_agency_custom_css .='.scrollup i{';
			$software_agency_custom_css .='visibility:visible !important;';
		$software_agency_custom_css .='} }';
	}else if($software_agency_resp_scroll_top == false){
		$software_agency_custom_css .='@media screen and (max-width:575px){';
		$software_agency_custom_css .='.scrollup i{';
			$software_agency_custom_css .='visibility:hidden !important;';
		$software_agency_custom_css .='} }';
	}

	/*---------------- Button Settings ------------------*/

	$software_agency_button_border_radius = get_theme_mod('software_agency_button_border_radius');
	if($software_agency_button_border_radius != false){
		$software_agency_custom_css .='.post-main-box .more-btn a{';
			$software_agency_custom_css .='border-radius: '.esc_attr($software_agency_button_border_radius).'px;';
		$software_agency_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$software_agency_copyright_alingment = get_theme_mod('software_agency_copyright_alingment');
	if($software_agency_copyright_alingment != false){
		$software_agency_custom_css .='.copyright p{';
			$software_agency_custom_css .='text-align: '.esc_attr($software_agency_copyright_alingment).';';
		$software_agency_custom_css .='}';
	}