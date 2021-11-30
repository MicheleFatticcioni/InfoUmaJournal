<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

<div class="container mt-5">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    the_title( '<h1 class="mb-5">', '</h1>');
    echo '<p>';
        echo get_field('riassunto');
    echo '</p>';
    echo '<div class="mb-2">';
    echo get_field('embed');
    echo '</div>';
    if(get_the_content(get_the_ID())){
        echo '<div>';
        echo '<hr>';
        the_content();
        echo '</div>';
    };
    endwhile; else :
        _e( 'Sorry, no posts matched your criteria.', 'picostrap' );
    endif;
 ?>
</div>

 

<?php get_footer();