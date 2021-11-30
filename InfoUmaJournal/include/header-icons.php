<?php 
function get_header_icons(){
    include get_stylesheet_directory(  ).'/icons/icons.php';
    $output = '';
    if(!is_user_logged_in()){
        $output = '<a href="/login">'.$login_icon.'</a>';
    } else{
        $output = '<a href="/logout">'.$login_icon.'</a>';
    }
    return $output;
}
add_shortcode( 'header-icons', 'get_header_icons' );
