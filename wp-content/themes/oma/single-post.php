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
			<?php //the_post(); ?>
			<?php get_template_part( 'content', 'blurb-blog' ); ?>
			</div>
		</div>



<div id="content-page-wrapper" class="clear">
    	<div id="blog-wrapper">
      	<div id="blog-container">
					<div id="primary">
						<div id="content" role="main">
						<?php if ( have_posts() ) : ?>
								<?php get_template_part( 'content', 'blog' ); ?>
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
				
			</div>
		</div>
	</div>
	
	<div id="content-closure" class="clear">
    <div id="content-closure-wrapper"></div>
  </div>

<?php get_footer(); ?>