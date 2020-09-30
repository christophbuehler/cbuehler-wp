<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="theme-color" content="#1e0014">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <?php wp_enqueue_script('script', get_template_directory_uri() . '/assets/cbuehler.min.js', [], '1.0.20'); ?>
    <?php wp_head(); ?>
</head>

<?php
$custom_logo_id = get_theme_mod('custom_logo');
$image = wp_get_attachment_image_src($custom_logo_id, 'full');
?>

<body <?php body_class(is_front_page() ? 'fixed-header' : 'fixed-header'); ?>>
    <canvas class="bg"></canvas>
    <div class="menu">
        <header class="top fx-row fx-center">
            <a href="/" class="logo">
                <img src="<?php echo $image[0]; ?>" alt="cbuehler">
            </a>
            <span class="flex"></span>
            <div class="nav-btn" onclick="document.body.classList.toggle('show-menu')">
                Close
            </div>
        </header>
        <nav>
            <div class="sub-title">Articles</div>

            <?php
            $args = array(
                'post_type' => 'post'
            );

            $post_query = new WP_Query($args);

            if ($post_query->have_posts()) {
                while ($post_query->have_posts()) {
                    $post_query->the_post();
            ?>
                    <a href="<?php the_permalink(); ?>" class="article-link">
                        <?php the_title(); ?>
                        <div class="tagline">
                            <?php
                            echo get_the_date('F Y');
                            ?>
                        </div>
                    </a>
            <?php
                }
            }
            ?>
        </nav>
    </div>
    <div class="backdrop" onclick="document.body.classList.toggle('show-menu')"></div>
    <header class="top main white fx-row fx-center">
        <div class="logo main">
            <img src="<?php echo $image[0]; ?>" alt="cbuehler">
        </div>
        <span class="flex"></span>
        <div class="nav-btn" onclick="document.body.classList.toggle('show-menu')">
            Articles
        </div>
        <a href="/about-me" class="nav-btn">
            About Me
        </a>
    </header>