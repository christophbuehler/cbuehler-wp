<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cbuehlerli
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="block">
		<?php
			if (is_singular()) :
				the_title('<h1>', '</h1>');
			else :
				the_title('<h1>', '</h1>');
			endif;
		?>
	</div>
	<div class="block">
		<?php
		if ('post' === get_post_type()) :
		?>

			<div class="meta">
				<?php
				echo get_the_author_meta('display_name');
				?>,
				<?php
				echo get_the_date('F Y');
				?>
			</div>
		<?php endif; ?>

		<!-- <div class="hero">
			<?php // the_post_thumbnail(); ?>
		</div> -->

		<div class="content">
			<?php
			the_content(sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'cbuehlerli'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			));

			wp_link_pages(array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'cbuehlerli'),
				'after'  => '</div>',
			));
			?>
		</div>
	</div>
	<div class="block more-articles">
			<h2>Continue reading</h2>
			<div class="articles">
				<?php
				$args = array(
					'post_type' => 'post'
				);

				$post_query = new WP_Query($args);

				if ($post_query->have_posts()) {
						while ($post_query->have_posts()) {
								$post_query->the_post();
				?>
								<a href="<?php the_permalink(); ?>" class="article">
										<div class="preview-img">
											<?php the_post_thumbnail();?>
										</div>
										<div class="title">
										<?php
										the_title();
										?>
										</div>
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
			<div>
		<div>
		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		// if (comments_open() || get_comments_number()) {
		// 	comments_template();
		// }
		?>
		</div>
	</div>
</article>
