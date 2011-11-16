<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	  <div class="left blog-left">
	    <span class="user-photo"><?php echo userphoto_the_author_thumbnail(); ?></span>
	    <ul class="blog-utility">
	     <li class="comment"><a href="<?php the_permalink(); ?>">Comment</a></li>
	     <li class="twitter"><a href="http://twitter.com/<?php echo get_the_author_meta('twitter'); ?>">Twitter</a></li>
	     <li class="linkedin"><a href="http://linkedin.com/<?php echo get_the_author_meta('linkedin'); ?>">Linked In</a></li>
	    </ul>
	  </div>
	  <div class="right blog-right">
		<header class="entry-header">
			<?php if ( is_sticky() ) : ?>
				<hgroup>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<h3 class="entry-format"><?php _e( 'Featured', 'twentyeleven' ); ?></h3>
				</hgroup>
			<?php else : ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<?php endif; ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				Written on <?php the_time('F jS, Y') ?> Posted by <? the_author_meta('display_name'); ?> in <?php
        $category = get_the_category(); 
        echo $category[0]->cat_name;
        ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
		  <?php the_excerpt(); ?>
			<!-- <?php the_content( __( 'More&gt;', 'twentyeleven' ) ); ?> -->
			
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
		</div>
	</article>
