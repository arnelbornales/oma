<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<article id="post-blogs" <?php post_class(); ?>>
	<header class="blurb-title blurb-title-blurb-blogs">
		<h1 class="entry-title">Blog</h1>
	</header>

	<div class="blurb-body">
		<?php 
			$args = array('post_type' => 'page',
						  //'post_status' => array('publish'),
						  //'pagename' => 'Blog',
						  'p' => 104,
					);
			$query = new WP_Query( $args );
			//print_r($query_left);
			//if($query_left->have_posts() ) : $query_left->the_post(); 
			while ( $query->have_posts() ) : $query->the_post(); 
				the_excerpt(); 
			endwhile;
			//endif;
			wp_reset_postdata(); 
		?>
	</div><!-- .blurb-body -->
	
</article>