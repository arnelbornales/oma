<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>
    
    <div id="content-blurb-wrapper" class="clear">
			<div id="content-blurb-inner">page-blog.php
			<?php //the_post(); ?>
			<?php get_template_part( 'content', 'blurb' ); ?>
			</div>
		</div>
		
		<div id="content-page-wrapper" class="clear">
    
    <div id="blog-wrap">
      <div id="blog-container">
		<div id="primary">
			<div id="content" role="main">
			  
			<?php if ( have_posts() ) : ?>
			  

				<?php twentyeleven_content_nav( 'nav-above' ); ?>
				<?php query_posts( 'posts_per_page=5' ); ?>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : //the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
		</div>
		</div>
	</div>
	<div id="content-closure" class="clear">
    <div id="content-closure-wrapper"></div>
  </div>

<?php get_footer(); ?>