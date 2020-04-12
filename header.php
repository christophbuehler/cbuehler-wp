<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;400;500&display=swap|Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php wp_enqueue_script('script', get_template_directory_uri() . '/assets/cbuehler.min.js', [], '1.0.7'); ?>
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
                <i class="material-icons">close</i>
            </div>
        </header>
        <nav>
            <?php
            $args = array(
                'post_type' => 'post'
            );

            $post_query = new WP_Query($args);

            if ($post_query->have_posts()) {
                while ($post_query->have_posts()) {
                    $post_query->the_post();
            ?>
                    <div class="article">
                        <?php the_title(); ?>
                        <div class="tagline">
                            <?php
                            echo get_the_date('F Y');
                            ?>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
            <!-- <div class="article">
                Create Reactive Structure With Flutter Blueprint
                <div class="tagline">
                    June 2020
                </div>
            </div> -->
        </nav>
    </div>
    <header class="top white fx-row fx-center">
        <div class="logo">
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