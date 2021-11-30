<?php
function lc_get_post_hero_view($the_posts,$get_posts_shortcode_atts) {
    
    //var_dump($author);
    extract($get_posts_shortcode_atts);
    $out=''; // INIT
    foreach ( $the_posts as $the_post ):   
        $author_id = get_post_field ('post_author', $the_post);
        $display_name = get_the_author_meta( 'nickname' , $author_id ); 
        $out .= '<div class="card-post--big mb-5 min-vh-70">';
        $out .= '<div class="d-flex flex-column bg-cover card-post--inner shadow" style="background-image:linear-gradient(0deg, #2d3748 0%, transparent 100% ), url(' . get_the_post_thumbnail_url($the_post) . ')">'; 
        $out .= ' <div class="container text-center">';
        $out .= ' <div class="content mb-md-7 mb-sm-3 mb-xs-3"><a href="'. get_the_permalink($the_post) . '"><h3 class="mb-4">'. get_the_title($the_post) . '</h3></a>';
        $out .= ' <p class="post-info">Di: <a href="'. get_author_posts_url($author_id) .'">'. $display_name .' </a> <span class="ms-2">'.  get_the_date('', $the_post) .' - '. get_number_of_readings($the_post->ID) .'<i class="far fa-eye ms-1"></i></span></p></div>';
        $out .= '</div>';
        $out .= '</div>';
        $out .= '</div>';
   endforeach;
   return  $out;
}

function lc_get_posts_card_samll_view($the_posts,$get_posts_shortcode_atts) {
    extract($get_posts_shortcode_atts);
    $out=''; // INIT
    foreach ( $the_posts as $the_post ):   
        $author_id = get_post_field ('post_author', $the_post);
        $display_name = get_the_author_meta( 'nickname' , $author_id ); 
        //var_dump(get_reading_time($the_post->ID));

        $out .= '<div class="card-post col-md-4 mb-3 px-2"><div class="d-flex flex-row card-post--inner shadow"><div class="card-post-image"><img src="' . get_the_post_thumbnail_url($the_post) . '" alt="IMMAGINE AUTORE"></div><div class="card-post-body">';
        $out .= '<a class="category" href="' . get_the_category( $the_post )[0]->taxonomy . '/' . get_the_category( $the_post )[0]->category_nicename .'">'. get_the_category( $the_post )[0]->name.'</a>';
        $out .= '<a href="'. get_the_permalink($the_post) . '"><h3 class="h4">'. get_the_title($the_post) . '</h3></a>';
        $out .= '<div class="author-and-post-info"><div>';
        $out .= 'di: <a href="'. get_author_posts_url($author_id) .'">'. $display_name .' </a>';
        $out .= '<p class="mb-1">'. get_number_of_readings($the_post->ID) .'<i class="far fa-eye ms-1"></i></p>';
        $out .= '<p>' . get_the_date('', $the_post) . ' <span></span></p></div></div></div></div></div>';
    
   endforeach;
    
   return  $out;
}

function lc_get_posts_card_big_view($the_posts,$get_posts_shortcode_atts) {
    extract($get_posts_shortcode_atts);
    $out=''; // INIT
    foreach ( $the_posts as $the_post ):   
        //var_dump(get_the_author_posts_link($the_post));
        $avatar_url = (get_field('avatr', 'user_'. get_the_author_meta('ID') )['url'] ? get_field('avatr', 'user_'. get_the_author_meta('ID') )['url'] : "http://infouma-journal.local/wp-content/uploads/2021/09/download.png" );
        $avatar_title = (get_field('avatr', 'user_'. get_the_author_meta('ID') )['title'] ? get_field('avatr', 'user_'. get_the_author_meta('ID') )['title'] : "Avatar" );
       // var_dump($avatar_title);

        $out .= '<div class="card-post--big col-md-4 mb-3 px-2">';
        $out .= '<div class="d-flex flex-column bg-cover card-post--inner shadow" style="background-image:linear-gradient(0deg, #2d3748 0%, transparent 100% ), url(' . get_the_post_thumbnail_url($the_post) . ')">'; 
        $out .= ' <div class="content mb-3"><a href="'. get_the_permalink($the_post) . '"><h3>'. get_the_title($the_post) . '</h3><span>'. get_number_of_readings($the_post->ID) .'<i class="far fa-eye ms-1"></i></span></a></div>';
        $out .= ' <div class="post-info row">';
        $out .= ' <div class="col-md-4"> <img class="avatar avatar--small" src="'. $avatar_url .'" alt="'. $avatar_title .'"></div>';
        $out .= ' <div class="col-md-8 post-info"><p>'. get_the_author_posts_link($the_post) . '</p><p><span>'. get_the_date('', $the_post) . '</span></p></div>';
        $out .= '</div>';
        $out .= '</div>';
        $out .= '</div>';
   endforeach;
   return  $out;
}


function get_article_more_read(){
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'meta_key' => 'number_of_readings',
        'orderby'  => 'meta_value_num',
	    'order'	   => 'DESC'
    );
    $query = new WP_Query($args);
    $output = '';
   if($query->have_posts()): while($query->have_posts()): $query->the_post();
    $output .= '<div class="card-post col-md-4 mb-3 px-2"><div class="d-flex flex-row card-post--inner shadow"><div class="card-post-image"><img src="' . get_the_post_thumbnail_url($the_post) . '" alt="IMMAGINE AUTORE"></div><div class="card-post-body">';
    $output .= '<a class="category" href="' . get_the_category( $the_post )[0]->taxonomy . '/' . get_the_category( $the_post )[0]->category_nicename .'">'. get_the_category( $the_post )[0]->name.'</a>';
    $output .= '<a href="'. get_the_permalink($the_post) . '"><h3 class="h4">'. get_the_title($the_post) . '</h3></a>';
    $output .= '<p>'. get_number_of_readings(get_the_ID()) .'<i class="far fa-eye ms-1"></i></p>';
    $output .= '<div class="author-and-post-info"><div>';
    $output .= 'di: ' . get_the_author_posts_link($the_post);
    $output .= '<p>' . get_the_date() . ' <span></span></p></div></div></div></div></div>';
 
    endwhile; endif;
    return $output;
}
add_shortcode( 'article_more_read', 'get_article_more_read' );