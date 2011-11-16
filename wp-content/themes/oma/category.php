<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="content-blurb-wrapper" class="clear">
      <div id="content-blurb-inner">
        <article>
    	    <header class="blurb-title">
    		    <h1 class="entry-title">BLOG</h1>
    	    </header><!-- .entry-header -->
    	    <div class="blurb-body">
            <p>Gain insight into the fast-paced world of Off Madison Ave, where a thoughtful approach, industry expertise and an unwavering dedication to our craft combine to make your brand more successful.</p>
        </div>
        </article>
      </div>
    </div>
    <div id="content-page-wrapper" class="clear">
    
    <div id="blog-wrap">
      <div id="blog-container">
		<div id="primary">
			<div id="content" role="main">
			  <h2 class="blog-title">Recent Posts</h2>

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php
						printf( __( 'Category Archives: %s', 'twentyeleven' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>

					
				</header>

				<?php twentyeleven_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

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
		</section><!-- #primary -->
		
		</div>
		<?php get_sidebar(); ?>
		</div>
	</div>
		<div id="content-closure" class="clear">
      <div id="content-closure-wrapper"></div>
    </div>


<?php get_footer(); ?>
