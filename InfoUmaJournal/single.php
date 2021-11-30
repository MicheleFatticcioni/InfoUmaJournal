<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

//handler_number_of_readings(get_the_ID());
if ( have_posts() ) : 
    while ( have_posts() ) : the_post();
    $avatar_url = (get_field('avatr', 'user_'. get_the_author_meta('ID') )['url'] ? get_field('avatr', 'user_'. get_the_author_meta('ID') )['url'] : "http://infouma-journal.local/wp-content/uploads/2021/09/download.png" );
    $avatar_title = (get_field('avatr', 'user_'. get_the_author_meta('ID') )['title'] ? get_field('avatr', 'user_'. get_the_author_meta('ID') )['title'] : "Avatar" );
 ?>
 <div class="d-flex container-fluid" style="height:50vh;background:url(<?php echo (get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_stylesheet_directory_uri(  ).'/img/rete.jpg') ?>)  center / cover no-repeat;"></div>

    
    <div class="container p-md-5 bg-light" style="margin-top:-100px">
        <div class="row">
            
            <div class="col-md-12">
                <?php 
                //CATS
                if (!get_theme_mod("singlepost_disable_entry_cats") &&  has_category() ) {
                    $terms = get_the_terms( get_the_ID(), 'category');
                    $term = array_pop($terms);
    
                    $color = (get_field('colore_etichetta', $term) ? get_field('colore_etichetta', $term) : '#333');
                    ?>
                    <div class="entry-categories mb-3">
                        
                        <div class="entry-categories-inner">
                            <span class="category-label" style="background-color: <?php echo $color ?>"><?php the_category(' '); ?></span>
                        </div><!-- .entry-categories-inner -->
                    </div><!-- .entry-categories -->
                    <?php
                }
                
                ?>

                <h1><?php the_title();?></h1>
                
                <?php if (!get_theme_mod("singlepost_disable_entry_meta") ): ?>
                    <div class="post-meta" id="single-post-meta">
                        <p class="text-secondary">
                            <img class="avatar avatar--small me-3" src="<?php echo $avatar_url ?>" alt="<?php echo $avatar_title; ?>">
                            <span class="text-secondary post-author"> <?php echo get_the_author_posts_link() ?></span> - 
                            <span class="post-date"><?php echo get_the_date() ?> </span> - 
                            <span class="post-view"><i class="far fa-clock ms-1 me-1"></i><?php echo get_reading_time(get_the_ID()); ?></span>
                            <span class="post-reading-time"><i class="far fa-eye ms-3 me-1"></i><?php echo get_number_of_readings(get_the_ID()); ?></span>
                        </p>
                    </div> 
                <?php endif; ?>

            </div><!-- /col -->
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <?php the_content(); ?>
            </div><!-- /col -->
        </div>
    </div>

<?php
    endwhile;
 else :
     _e( 'Sorry, no posts matched your criteria.', 'picostrap' );
 endif;
 ?>



<script>
     (function($) {
    $(document).ready(function() {
        var postId = parseInt('<?php echo get_the_ID() ?>');
        var ajaxPath = window.location.origin + '/wp-admin/admin-ajax.php';
        setTimeout(() => {
            $.ajax({
                type: "POST",
                url: ajaxPath,
                data: {
                    action: 'handler_number_of_readings',
                    post_id : postId
                },
                success: function (response) {
                   console.log(response) 
                }
            });
        }, 6000);
    
    })
})(jQuery);

 </script>

<?php get_footer();
