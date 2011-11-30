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
		<div id="content-blurb-inner">
			<?php the_post(); ?>
			<?php get_template_part( 'content', 'blurb' ); ?>
		</div>
	</div>
	
	<div id="content-page-wrapper" class="clear">
		<div id="home-wrapper" class="clear">
			<div id="blog-container">
				<div id="primary">
					<div id="content" role="main">
						<div class="homepage-featured-projects-wrapper clear"><?php dynamic_sidebar( 'homepage_featured_project' ); ?></div>
						<div class="homepage-latest-posts-wrapper clear">
						<?php dynamic_sidebar( 'latest_posts' ); ?>
						<?php dynamic_sidebar( 'homepage_contact_us_form' ); ?>
					</div><!-- #content -->
				</div><!-- #primary -->
			</div>				
		</div>
	</div>
	
	<div id="content-closure" class="clear">
		<div id="content-closure-wrapper">
		</div>
	</div>

<?php get_footer(); ?>