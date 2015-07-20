<?php
/*
 *  UCFBands Theme Functionality
 *  Shortcode: Hero (Bootstrap- "Jumbotron"-like thing)
 *    
 *  @author Jordan Pakrosnis
*/


/**
 * UCFBands Shortcode: Hero
 *
 * @author Jordan Pakrosnis
 */
function ucfbands_shortcode_hero( $atts, $content = null ) {
    
    
    //-- ATTRIBUTES --//
	$atts = shortcode_atts( array(
        'padding'   => 'med',  // Options: sm, med, lg
        'color'     => 'gold', // Options: Core Colors
        'image'     => '',
        'title'     => '',
	), $atts, 'hero' );

    
    //-- SET VARS --//
    
    // Attributes
    $hero_padding = $atts['padding'];
    $hero_color =   $atts['background-color'];
    $hero_image =   $atts['image'];
    $hero_title =   $atts['title'];
    
    // Attribute Helpers
    $hero_classes = '';
    
    // Output
    $shortode_output = '';
    
    
    
    //=========//
    //  LOGIC  //
    //=========//    

    //-- CLASSES --//
    
    // General
    $hero_classes .= 'hero ';
    
    // Padding
    if ($hero_padding)
        $hero_classes .= 'hero-padding-' . $hero_padding . ' ';
    
    // Background Color
    if ($hero_color)
        $hero_classes .= 'hero-' . $hero_color;
    
    // Background Image
    if ($hero_image)
        $hero_image = ' style="background-image: url(\'' . $hero_image . '\');" ';
    
    
    //-- TITLE --//
    
    
    
    //==========//
    //  OUTPUT  //
    //==========//
    
    // Start Opening Tag
    $shortcode_output .= '<section ';
    
    
        // Classes
        $shortcode_output .= 'class="' . $hero_classes . '"';
    
    
        // Background Image
        $shortcode_output .= $hero_image;
    
    
    // Close Opening Tag
    $shortcode_output .= '>';
    
    
        // Content
        $shortcode_output .= do_shortcode($content);
    
    
    // Closing Tag
    $shortcode_output .= '</section>';    
    
    
    
    // Return Output String
	return $shortcode_output;
    
} // ucfbands_shortcode_button()

// Register the shortcode
add_shortcode( 'hero', 'ucfbands_shortcode_hero' );
