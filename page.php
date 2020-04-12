<?php

/**
 * Any page.
 */

get_header();

// if (is_front_page()) :
//     get_template_part('template-parts/content', 'front-page');
// else :
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', get_post_type());

        endwhile;
    else :
        echo 'Here should be a page.';
    endif;
// endif;

get_footer();


?>

<script>
    cbuehler();
</script>
</body>

</html>