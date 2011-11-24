<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
get_header(); ?>
		<div id="" role="main" class="wrapper-primary clear">

		<div id="content-blurb-wrapper" class="clear">
			<div id="content-blurb-inner">single-post.php
			<?php //the_post(); ?>
			<?php get_template_part( 'content', 'blurb-blog' ); ?>
			</div>
		</div>

		<div id="content-page-wrapper" class="clear">
			<div id="content-page-inner" class="page-quicktabs">

				<div class="content-page-content clear">
				<?php if ( have_posts() ) : ?>
				<?php get_template_part( 'content', 'blog' ); ?>
				<?php else : ?>

						<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyeleven' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
						</article><!-- #post-0 -->

				<?php endif; ?>
				</div>
			</div>
		</div>

		<div id="content-closure" class="clear">
			<div id="content-closure-wrapper">
			</div>
		</div>

		</div><!-- #content -->

<?php get_footer(); ?>


