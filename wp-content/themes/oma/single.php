<?php
/**
 * The Template for displaying all single posts.
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

				<?php while ( have_posts() ) : the_post(); ?>

					<nav id="nav-single">
						<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
						<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ) ); ?></span>
						<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
					</nav><!-- #nav-single -->

					<?php get_template_part( 'content', 'single' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>
				

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