<?php get_header();
 $author_id = get_post_field ('post_author');
 $display_name = get_the_author_meta( 'nickname' , $author_id ); 
?>
<main class="container hero-archive">
    <section class="my-5">
        <h1><?php the_category(  ); ?></h1>
        <?php echo category_description(); ?>
    </section>
    <div class="row">
        <?php if(have_posts()): while(have_posts()): the_post();
        $avatar_url = (get_field('avatr', 'user_'. get_the_author_meta('ID') )['url'] ? get_field('avatr', 'user_'. get_the_author_meta('ID') )['url'] : "http://infouma-journal.local/wp-content/uploads/2021/09/download.png" );
        $avatar_title = (get_field('avatr', 'user_'. get_the_author_meta('ID') )['title'] ? get_field('avatr', 'user_'. get_the_author_meta('ID') )['title'] : "Avatar" );
        ?>
            <div class="card-post card-post--loop col-md-4 mb-4">
                <div class="card-post--inner px-2 shadow">
                    <div class="card-post-image mb-4">
                        <img src="<?php echo (get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_stylesheet_directory_uri(  ).'/img/rete.jpg') ?>" alt="IMMAGINE ARCHIVIO">
                    </div>
                    <div class="card-post-body">
                        <h3 class="h4"><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
                        <p class="text-grey"><?php echo get_field('riassunto', get_the_ID() ); ?></p>
                        <div class="post-info row">
                            <div class="col-md-4">
                                <img class="avatar" src="<?php echo $avatar_url ?>" alt="<?php echo $avatar_title; ?>">
                            </div>
                            <div class="col-md-8 m-auto">
                                <p><?php echo get_the_author_posts_link(); ?></p>
                                <p><span><?php echo get_the_date() ?></span> <span class="mx-1">-</span> <span class="post-reading-time"><i class="far fa-eye me-2"></i><?php echo get_number_of_readings(get_the_ID()); ?></span></p>
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
            endif; ?>
</main>


<?php get_footer() ?>