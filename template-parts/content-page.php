<?php

/**
 * Template part for displaying page content in page.php
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

		<?php cbuehlerli_post_thumbnail(); ?>

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
	<div class="block">
		<div class="fx-row fx-end">
			<!-- <div class="btn">
				Convert cyber space into neutral
				<i class="material-icons">arrow_forward</i>
			</div> -->
		</div>
		<div>
		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) {
			comments_template();
		}
		?>
		</div>
	</div>
</article>