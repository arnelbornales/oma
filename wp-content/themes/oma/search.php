<?php
get_header(); ?>

		
			<div id="content" role="main" class="wrapper-primary clear">
				
				<div id="content-blurb-wrapper" class="clear">
					<div id="content-blurb-inner">
						<?php //the_post(); ?>
						<?php //get_template_part( 'content', 'blurb' ); ?>
					</div>
				</div>
				
				<div id="content-page-wrapper" class="clear">
					<div id="content-page-inner" class="page-quicktabs">
							
							<div class="content-page-content clear">
							<?php if ( have_posts() ) : ?>

							<header class="page-header">
								<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
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