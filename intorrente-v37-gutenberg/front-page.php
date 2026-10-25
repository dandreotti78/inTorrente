<?php get_header(); ?>
<main id="primary" class="site-main intorrente-block-home">
<?php
while ( have_posts() ) :
    the_post();
    if ( has_block( 'intorrente/home', get_the_content() ) ) {
        the_content();
    } else {
        echo do_blocks( '<!-- wp:intorrente/home /-->' );
    }
endwhile;
?>
</main>
<?php get_footer(); ?>
