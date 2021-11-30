<?php
// SET A SPECIFIC DESTINATION FOLDER FOT THE COMPILED CSS BUNDLES
function picostrap_get_css_optional_subfolder_name() { return "css-output/"; }

// SET A CUSTOM NAME FOR THE CSS BUNDLE FILE
function picostrap_get_base_css_filename() { return "bundle.css"; }

// DISABLE APPLICATION PASSWORDS for security
add_filter( 'wp_is_application_passwords_available', '__return_false' );

// LOAD CHILD THEME TEXTDOMAIN
//add_action( 'after_setup_theme', function() { load_child_theme_textdomain( 'picostrap-child', get_stylesheet_directory() . '/languages' ); } );

// OPTIONAL ADDITIONAL CSS FILE - [NOT RECOMMENDED]: USE the /sass folder, add your css code to /sass/_custom.sass
//add_action( 'wp_enqueue_scripts',  function  () {	wp_enqueue_style( 'custom', get_stylesheet_directory_uri().'/custom.css' ); });

// OPTIONAL ADDITIONAL JS FILE - just uncomment the row below
//add_action( 'wp_enqueue_scripts', function() {	wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js', array(/* 'jquery' */), null, true); });
 
// OPTIONAL: ADD FONTAWESOME FROM CDN IN FOOTER 

add_action("wp_footer",function(){ ?> <link rel='stylesheet' id='fontawesome-css'  href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' media='all' /> <?php }); 
add_action( 'wp_enqueue_scripts',  function  () {	wp_enqueue_style( 'main', get_stylesheet_directory_uri().'/css-output/main.css' ); });

//add_action( 'wp_enqueue_scripts', function() {	wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), null, true); });


function iuj_ajax_script(){
    wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), null, true);
    wp_localize_script( 'custom', 'obj', array(
        'admin_url' => admin_url( 'admin-ajax.php' )
    ) );
}
add_action( "wp_enqueue_scripts", "iuj_ajax_script" );

//OPTIONAL: ADD ANOTHER CUSTOM GOOGLE FONT, EXAMPLE: Hanalei Fill
// After uncommenting the following code, you will also need to set the font in the BS variable. Here's how:
// Open the WordPress Customizer 
// In the field/s: "Font Family Base" or "Headings Font Family" enter the font name, in this case "Hanalei Fill"

/*
add_action("wp_head",function(){ ?> 
 <link rel="dns-prefetch" href="//fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
 <link href="https://fonts.googleapis.com/css?family=Hanalei+Fill" rel="stylesheet">
 <?php }); 
 */

// OPTIONAL: ADD MORE NAV MENUS
//register_nav_menus( array( 'third' => __( 'Third Menu', 'picostrap' ), 'fourth' => __( 'Fourth Menu', 'picostrap' ), 'fifth' => __( 'Fifth Menu', 'picostrap' ), ) );
// THEN USE SHORTCODE:  [lc_nav_menu theme_location="third" container_class="" container_id="" menu_class="navbar-nav"]

include get_stylesheet_directory().'/include/tmp-shortcode.php';
include get_stylesheet_directory().'/include/header-icons.php';
include get_stylesheet_directory().'/ajax/ajax-functions.php';



function wpdocs_custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


//PER DISABILITARE GUTENBERG RIMUOVERE IL COMMENTO SOTTO
//add_filter('use_block_editor_for_post', '__return_false', 10);

//number of words
function prefix_wcount($id){
    ob_start();
    $text = trim( strip_tags( get_the_content() ) );
    $word_number = substr_count( "$text ", ' ' );
    return sizeof(explode(" ", $content));
}



//FUNZIONE SPOSTATA IN AJAX
/*function handler_number_of_readings($post_ID){
    $number_of_readings_post_meta = get_post_meta($post_ID, 'number_of_readings');
    if(!$number_of_readings_post_meta){
        add_post_meta( $post_ID, 'number_of_readings', 1);
    } else{
        $reading = 1 + intval($number_of_readings_post_meta[0]);
        update_post_meta( $post_ID, 'number_of_readings', $reading );
    }
}*/

function get_number_of_readings($post_ID){
    if(get_post_meta($post_ID, 'number_of_readings')){
        return get_post_meta($post_ID, 'number_of_readings')[0];
    } else{
        return '0';
    }
}


function isa_count_content_words( $content ) {
    $decode_content = html_entity_decode( $content );
    $filter_shortcode = do_shortcode( $decode_content );
    $strip_tags = wp_strip_all_tags( $filter_shortcode, true );
    $count = str_word_count( $strip_tags );
    return $count;
}

function get_reading_time($post_ID){
 
	$words_per_minute = 250;

	// initialize the content
	$content = [];

	// the article title
	$content[] = get_the_title();

	// the article content
	$content[] = get_the_content();

	// all the contents
	$content = implode(' ', $content);

	
	// count the words inside the content
	$words = str_word_count($content);
	
	$tempo = $words / $words_per_minute;

	// count the seconds for the content
	$time = $words / $words_per_minute * 60;

	// add the time for 'read' the featured image
	if( has_post_thumbnail() ){
		$time = $time + 12;
	}

	// formatting the time
	$ii = intdiv($time, 60);
	$ss = $time % 60;
	$duration = $ii.':'.$ss;
	
	// a most readable format
	$timetoread = human_readable_duration($duration);
	
	// Ex. '2 minutes, 52 seconds'
	return $ii;
}


