<?php get_header(); ?>

<main id="main" class="site-main">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            // Display post content
            the_content();
        endwhile;
    else :
        // If no content, display a message
        echo 'No content found.';
    endif;
    ?>
</main><!-- #main -->

<?php get_footer(); ?>
