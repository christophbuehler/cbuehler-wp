<?php
get_header();
if (have_posts()) :
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/content', get_post_type());

    endwhile;
endif;
?>
<?php wp_footer(); ?>

<script>
    cbuehler();
</script>

</body>

</html>