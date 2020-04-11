<?php
get_header();

if ( is_front_page() ) :
    get_template_part('template-parts/content', 'home');
else :
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', get_post_type());
    
        endwhile;
    endif;
endif;
?>asdasdadas

<?php wp_footer(); ?>

<script>
    cbuehler();
</script>

</body>

</html>