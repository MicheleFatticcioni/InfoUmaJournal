<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

//handler_number_of_readings(get_the_ID());
if ( have_posts() ) : 
    while ( have_posts() ) : the_post();
 ?>
 <div class="d-flex container-fluid" style="height:50vh;background:url(<?php echo (get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_stylesheet_directory_uri(  ).'/img/rete.jpg') ?>)  center / cover no-repeat;"></div>

    
    <div class="container p-md-5 mb-3 bg-light job-offer" style="margin-top:-100px">
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
                            <span class="post-date">Annuncio del: <?php the_date(); ?> </span>
                            <span class="post-reading-time"><i class="far fa-eye ms-3 me-1"></i><?php echo get_number_of_readings(get_the_ID()); ?></span>
                        </p>
                    </div> 
                <?php endif; ?>

            </div><!-- /col -->
        </div>
        <hr>
        <div class="row job-offer-details">
            <div class="col-md-3">
                <p>Azienda: </p>
            </div><!-- /col -->
            <div class="col-md-9">
                <p><?php echo get_field('nome_e_cognome'); ?></p>
            </div><!-- /col -->

            <div class="col-md-3">
                <p>Email: </p>
            </div><!-- /col -->
            <div class="col-md-9">
                <p><?php echo get_field('email'); ?></p>
            </div><!-- /col -->


            <div class="col-md-3">
                <p>Sede: </p>
            </div><!-- /col -->
            <div class="col-md-9">
                <p><?php echo get_field('indirizzo_della_sede'); ?></p>
            </div><!-- /col -->

            <div class="col-md-3">
                <p>Offerta: </p>
            </div><!-- /col -->
            <div class="col-md-9">
                <p><?php echo get_field('tipo_di_ricerca')['label']; ?></p>
            </div><!-- /col -->

            <div class="col-md-3">
                <p>Durata: </p>
            </div><!-- /col -->
            <div class="col-md-9">
                <p><?php echo get_field('durata_del_rapporto'); ?></p>
            </div><!-- /col -->

            <div class="col-md-3">
                <p>Posizione ricercata: </p>
            </div><!-- /col -->
            <div class="col-md-9">
                <p><?php echo get_field('figura_ricercata'); ?></p>
            </div><!-- /col -->

            <div class="col-md-3">
                <p>descrizione: </p>
            </div><!-- /col -->
            <div class="col-md-9">
                <p><?php echo get_field('descrizione_del_lavoro'); ?></p>
            </div><!-- /col -->
            <div class="col-12">
                <a href="mailto:<?php echo get_field('email')?>" class="btn btn-primary">Invia candidatura</a>
            </div>
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
        }, 3000);
    
    })
})(jQuery);

 </script>

<?php get_footer();
