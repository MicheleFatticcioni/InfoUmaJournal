<?php get_header() ?>
<main class="container hero-archive">
    <section class="my-5">
        <h1><?php the_taxonomies(); ?></h1>
        <?php echo category_description(); ?>
    </section>
    <div class="row">
        <?php if(have_posts()): while(have_posts()): the_post();?>
            <div class="card-post card-post--loop col-md-4 mb-4">
                <div class="card-post--inner px-2 shadow">
                    <div class="card-post-image mb-4">
                        <img src="<?php echo (get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_stylesheet_directory_uri(  ).'/img/rete.jpg') ?>" alt="IMMAGINE ARCHIVIO">
                    </div>
                    <div class="card-post-body">
                        <h3 class="h4"><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
                        <p class="text-grey"><?php echo get_field('riassunto', get_the_ID() ); ?></p>
                        <div class="post-info row">
                            <div class="col-md-12 m-auto">
                                <p>Data di pubblicazione: <span><?php the_date(); ?></span></p>
                                <p>Stanno cercando: <span><?php echo get_field('figura_ricercata') ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile;
        global $wp_query;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        echo '</div>';//chiude row
        echo '<div class="my-paginations">';
        previous_posts_link();
        echo '<span>'. $paged . ' di ' . $wp_query->max_num_pages.'</span>';
            next_posts_link();
            echo '</div>';
else:?> 
<h1>Offerte di lavoro: Tirocinio</h1>
<p class="mt-4">Nessuna offerta di tirocinio è stata pubblicata</p>
<? endif; ?>
</main>


<?php get_footer() ?>