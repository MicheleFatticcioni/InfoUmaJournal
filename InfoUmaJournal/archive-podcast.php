<?php get_header() ?>
<main class="container hero-archive">
    <section class="my-5">
        <h1>I Podcast</h1>
    </section>
    <div class="row">
        <?php if(have_posts()): while(have_posts()): the_post();
        $avatar_url = (get_field('avatr', 'user_'. get_the_author_meta('ID') )['url'] ? get_field('avatr', 'user_'. get_the_author_meta('ID') )['url'] : "http://infouma-journal.local/wp-content/uploads/2021/09/download.png" );
        $avatar_title = (get_field('avatr', 'user_'. get_the_author_meta('ID') )['title'] ? get_field('avatr', 'user_'. get_the_author_meta('ID') )['title'] : "Avatar" );
        ?>
            <div class="card-post card-post--loop col-md-4 mb-4">
                <div class="card-post--inner px-2 shadow">
                    <div class="card-post-image mb-4">
                        <?php echo get_field('embed');?>
                    </div>
                    <div class="card-post-body">
                        <h3 class="h4"><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
                        <p class="text-grey"><?php echo get_field('riassunto'); ?></p>
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