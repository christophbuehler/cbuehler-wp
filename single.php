<?php

/**
 * Single post page.
 */

get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/content', get_post_type());

    endwhile;
else :
    echo 'Here should be a post.';
endif;

get_footer();

?>

<script>
    cbuehler();
</script>
</body>

</html>