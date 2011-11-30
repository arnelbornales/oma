<?php
/* Template Name: Page with Quicktabs Template */
get_header(); ?>
			
	<div id="content-blurb-wrapper" class="clear">
		<div id="content-blurb-inner">
			<?php the_post(); ?>
			<?php get_template_part( 'content', 'blurb' ); ?>
		</div>
	</div>
	
	<div id="content-page-wrapper" class="clear">
		<div id="page-wrapper" class="clear">
			<div id="page-container">
				<div id="primary">
					<div id="content" role="main">
						<?php the_content(); ?>
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