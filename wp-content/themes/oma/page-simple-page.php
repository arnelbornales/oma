<?php
/* Template Name: Simple Page Template */
get_header(); ?>

		<div id="primary">
			<div id="content" role="main" class="wrapper-primary clear">
				
				<div id="content-blurb-wrapper" class="clear">
					<div id="content-blurb-inner">
						<?php the_post(); ?>
						<?php get_template_part( 'content', 'blurb' ); ?>
					</div>
				</div>
				
				<!--
				<div id="content-page-wrapper" class="clear">
					<div id="content-page-inner" class="page-quicktabs">
							<?php if(is_front_page()): ?>
							<div class="homepage-featured-projects-wrapper clear"><?php dynamic_sidebar( 'homepage_featured_project' ); ?></div>
							<div class="homepage-latest-posts-wrapper clear">
									<?php dynamic_sidebar( 'latest_posts' ); ?>
									<?php dynamic_sidebar( 'homepage_contact_us_form' ); ?>
							</div>
							<?php endif; ?>
							
					</div>
				</div>
				-->
				<div id="content-closure" class="clear">
					<div id="content-closure-wrapper">
					</div>
				</div>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>