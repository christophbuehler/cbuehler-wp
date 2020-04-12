<?php

/**
 * Front page.
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="block">
		<?php the_title('<h1>', '</h1>'); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		the_content();
		endwhile; else: ?>
		<p>Sorry, no posts matched your criteria.</p>
		<?php endif; ?>
	</div>
</article>