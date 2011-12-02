<?php
/* Template Name: Simple Page */
get_header(); ?>
				
		<div id="content-blurb-wrapper" class="clear">
			 <div id="content-blurb-inner">
				 <?php //the_post(); ?>
				 <?php //get_template_part( 'content', 'blurb' ); ?>
			 </div>
		</div>
		
		<div id="content-page-wrapper" class="page-simple-page clear">
			 <div id="page-wrapper">
			   <div id="page-container">
						<div id="primary">
							<div id="content" role="main">
							<?php if ( have_posts() ) : ?>
										<?php /* Start the Loop */ ?>
										<?php while ( have_posts() ) : the_post(); ?>
										<?php 		get_template_part( 'content', get_post_format() ); ?>
										<?php endwhile; ?>
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