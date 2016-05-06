<?php
/**
 * zillah Theme Customizer.
 *
 * @package zillah
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function zillah_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    require_once ( 'class/zillah-general-control.php');

	/* Control for hiding search icon*/
	$wp_customize->add_setting( 'zillah_show_search', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'zillah_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'zillah_show_search', array(
		'type' => 'checkbox',
		'label' => __( 'Hide search icon?','zillah' ),
		'description' => __( 'If you check this box, the search icon will disappear from header.','zillah' ),
		'section' => 'title_tagline',
		'priority' => 1,
	) );

    $wp_customize->get_control( 'display_header_text' )->priority = 2;
    $wp_customize->get_control( 'blogname' )->priority = 3;
    $wp_customize->get_control( 'blogdescription' )->priority = 4;
    $wp_customize->get_control( 'custom_logo' )->priority = 5;


	/* Control for social icons */
	$wp_customize->add_section( 'zillah_social_media', array(
		 'title'	=> esc_html__( 'Social Media Icons', 'zillah' ),
		 'priority'	=> 40,
	 ) );

	$wp_customize->add_setting( 'zillah_social_icons', array(
		'default'	=>	json_encode( array(
			array('icon_value'	=>	'fa-facebook-official' , 'link' => '#', 'id' => 'zillah_5702771a213bb'),
			array('icon_value'	=>	'fa-google' , 'link' => '#', 'id' => 'zillah_57027720213bc'),
			array('icon_value'	=>	'fa-instagram' , 'link' => '#', 'id' => 'zillah_57027722213bd')
		) ),
		'transport'	=>	'postMessage',
		'sanitize_callback'	=>	'zillah_sanitize_repeater'
	) );	

    $wp_customize->add_control( new Zillah_General_Repeater( $wp_customize, 'zillah_social_icons', array(
		'label'	=>	esc_html__('Add new social icon','zillah'),
		'section'	=>	'zillah_social_media',
		'priority'	=>	1,
		'zillah_icon_control'	=>	true,
		'zillah_link_control'	=>	true
    ) ) );


    /* Single page header image */
    $wp_customize->add_section( 'zillah_page', array(
		 'title'	=> esc_html__( 'Page settings', 'zillah' ),
		 'priority'	=> 45
	) );

	$wp_customize->add_setting( 'zillah_page_header', array(
		'default'	=>	get_stylesheet_directory_uri().'/images/header-top.jpg',
		'sanitize_callback'	=>	'esc_url',
		'transport'	=>	'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zillah_page_header', array(
		'label'	=>	esc_html__( 'Page header', 'zillah' ),
		'section'	=>	'zillah_page',
		'priority'	=>	1
	) ) );


}
add_action( 'customize_register', 'zillah_customize_register' );

/**
 * Sanitization functions
 */
function zillah_sanitize_checkbox( $input ){
    return ( isset( $input ) && true == $input ? true : false );
}

function zillah_sanitize_repeater( $input ) {
    $input_decoded = json_decode( $input, true );
    if( !empty( $input_decoded ) ) {
        $icons_array = array('none' => 'none','500px' => 'fa-500px','amazon' => 'fa-amazon','android' => 'fa-android','behance' => 'fa-behance','behance-square' => 'fa-behance-square','bitbucket' => 'fa-bitbucket','bitbucket-square' => 'fa-bitbucket-square','american-express' => 'fa-cc-amex','diners-club' => 'fa-cc-diners-club','discover' => 'fa-cc-discover','jcb' => 'fa-cc-jcb','mastercard' => 'fa-cc-mastercard','paypal' => 'fa-cc-paypal','stripe' => 'fa-cc-stripe','visa' => 'fa-cc-visa','codepen' => 'fa-codepen','css3' => 'fa-css3','delicious' => 'fa-delicious','deviantart' => 'fa-deviantart','digg' => 'fa-digg','dribble' => 'fa-dribbble','dropbox' => 'fa-dropbox','drupal' => 'fa-drupal','facebook' => 'fa-facebook','facebook-official' => 'fa-facebook-official','facebook-square' => 'fa-facebook-square','flickr' => 'fa-flickr','foursquare' => 'fa-foursquare','git' => 'fa-git','git-square' => 'fa-git-square','github' => 'fa-github','github-alt' => 'fa-github-alt','github-square' => 'fa-github-square','google' => 'fa-google','google-plus' => 'fa-google-plus','google-plus-square' => 'fa-google-plus-square','html5' => 'fa-html5','instagram' => 'fa-instagram','joomla' => 'fa-joomla','jsfiddle' => 'fa-jsfiddle','linkedin' => 'fa-linkedin','linkedin-square' => 'fa-linkedin-square','opencart' => 'fa-opencart','openid' => 'fa-openid','paypal' => 'fa-paypal','pinterest' => 'fa-pinterest','pinterest-p' => 'fa-pinterest-p','pinterest-square' => 'fa-pinterest-square','rebel' => 'fa-rebel','reddit' => 'fa-reddit','reddit-square' => 'fa-reddit-square','share' => 'fa-share-alt','share-square' => 'fa-share-alt-square','skype' => 'fa-skype','slack' => 'fa-slack','soundcloud' => 'fa-soundcloud','spotify' => 'fa-spotify','stack-overflow' => 'fa-stack-overflow','steam' => 'fa-steam','steam-square' => 'fa-steam-square','tripadvisor' => 'fa-tripadvisor','tumblr' => 'fa-tumblr','tumblr-square' => 'fa-tumblr-square','twitch' => 'fa-twitch','twitter' => 'fa-twitter','twitter-square' => 'fa-twitter-square','vimeo' => 'fa-vimeo','vimeo-square' => 'fa-vimeo-square','vine' => 'fa-vine','whatsapp' => 'fa-whatsapp','wordpress' => 'fa-wordpress','yahoo' => 'fa-yahoo','youtube' => 'fa-youtube','youtube-play' => 'fa-youtube-play','youtube-squar' => 'fa-youtube-square');

        foreach ($input_decoded as $iconk => $iconv) {
            foreach ($iconv as $key => $value) {
                if ( $key == 'icon_value' && !in_array( $value, $icons_array ) ){
                    $input_decoded [$iconk][$key] = 'none';
                }
                if( $key == 'link' ){
                    $input_decoded [$iconk][$key] = esc_url( $value );;
                }
            }
        }
        $result =  json_encode( $input_decoded );
        return $result;
    }
    return $input;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function zillah_customize_preview_js() {
	wp_enqueue_script( 'zillah_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'zillah_customize_preview_js' );
