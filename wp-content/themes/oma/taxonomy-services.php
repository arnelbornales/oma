<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
print '<pre>';
//$myterms = hey_top_parents($term);
//print_r($myterms); 
//print_r($wp_query->query_vars); 



$terms = get_term_by( 'name',$term, $taxonomy );
//$terms = get_the_terms( $post->id, 'services' );
if ( $terms && ! is_wp_error( $terms ) ) { 
    foreach ( $terms as $term ) {
        $tree = '<a href="'.get_term_link($term->slug, 'services').'">'.$term->name.'</a>';
        $parents = get_ancestors( $term->term_id, 'services' );
        foreach ($parents as $parent) {
            $term = get_term($parent, 'services');
            $tree = '<a href="'.get_term_link($term->slug, 'services').'">'.$term->name.'</a> -> '.$tree;
       }
    }
    echo $tree;
} 
print '</pre>';	
get_header(); ?>
<div id="content" role="main" class="wrapper-primary clear">

		<div id="content-blurb-wrapper" class="clear">
			<div id="content-blurb-inner">taxonomy-services.php
			<?php the_post(); ?>
			<?php get_template_part( 'content', 'blurb-services' ); ?>
			</div>
		</div>
		
		
		<div id="content-page-wrapper" class="clear">
			<div id="content-page-inner" class="page-quicktabs">

				<div class="content-page-content clear">

					
						<?php services_breadcrumb(); ?>
						<header class="page-header">
							<h1 class="page-title"><?php
								printf( __( '%s', 'twentyeleven' ), '<span>' . single_cat_title( '', false ) . '</span>' );
							?>
							<?php //echo get_category_parents('', TRUE, ' &raquo; '); ?>
							</h1>
		
							<?php
								$category_description = category_description();
								if ( ! empty( $category_description ) )
									echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
							?>
						</header>
		
						<?php twentyeleven_content_nav( 'nav-above' ); ?>
						
						
						<?php if ( have_posts() ) : ?>
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
						<?php endif; ?>	
						<?php twentyeleven_content_nav( 'nav-below' ); ?>
		
					
			
				</div>
			</div>
		</div>
		
		
		<div id="content-closure" class="clear">
			<div id="content-closure-wrapper">
			</div>
		</div>

		</div><!-- #content -->

<?php get_footer(); ?>


