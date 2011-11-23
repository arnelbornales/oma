<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<article id="post-Services" <?php post_class(); ?>>
	<header class="blurb-title blurb-title-blurb-services">
		<h1 class="entry-title">Services</h1>
	</header>

	<div class="blurb-body">
		<?php 
			$args = array('post_type' => 'page',
						  'post_status' => array('publish'),
						  'pagename' => 'Services',
					);
			$query_left = new WP_Query( $args );
			while ( $query_left->have_posts() ) : $query_left->the_post(); 
				the_excerpt(); 
			endwhile; 
		?>
	</div><!-- .blurb-body -->
	
</article>