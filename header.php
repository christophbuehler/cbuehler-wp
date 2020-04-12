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
            <div class="logo">
                <img src="<?php echo $image[0]; ?>" alt="cbuehler">
            </div>
            <span class="flex"></span>
            <div class="menu-btn" onclick="document.body.classList.toggle('show-menu')">
                Close
                <i class="material-icons">close</i>
            </div>
        </header>
        <nav>
            <div class="article">
                Create Reactive Structure With Flutter Blueprint
            </div>
        </nav>
    </div>
    <header class="top white fx-row fx-center">
        <div class="logo">
            <img src="<?php echo $image[0]; ?>" alt="cbuehler">
        </div>
        <span class="flex"></span>
        <div class="menu-btn nav-btn" onclick="document.body.classList.toggle('show-menu')">
            Articles
        </div>
        <a href="/about-me" class="nav-btn">
            About Me
        </a>
    </header>
    <!-- <header class="left">
        <div>
            <div class="logo">
                <img src="<?php echo $image[0]; ?>" alt="cbuehler">
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li>Articles
                    <ul>
                        <li><a href="#">Frontend</a></li>
                        <li><a href="#">Product Design</a></li>
                        <li><a href="#">Algorithms</a></li>
                    </ul>
                </li>
                <li><a href="#">About Me</a></li>
            </ul>
        </nav>
        <span class="flex"></span>
        <div>
            <?php echo get_bloginfo('name')?>
        </div>
    </header> -->