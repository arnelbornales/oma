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
			<span class="user-photo">
			<?php 
				ob_start(); 
				$photo = userphoto_the_author_thumbnail();
				$photo = ob_get_contents();
				ob_end_clean();
				if(($photo) == ""):
					echo '<img width="68" height="68" class="photo" alt="No Photo" src="http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=68">'; 
				else: 
					echo $photo;
				endif;?>
			</span>
			
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
					<!--
					<?php if ( comments_open() && ! post_password_required() ) : ?>
					<div class="comments-link">
						<?php comments_popup_link( '<span class="leave-reply">' . __( 'Reply', 'twentyeleven' ) . '</span>', _x( '1', 'comments number', 'twentyeleven' ), _x( '%', 'comments number', 'twentyeleven' ) ); ?>
					</div>
					<?php endif; ?>
					-->
				</header><!-- .entry-header -->
			
			
				<section class="entry-meta">
					<?php $show_sep = false; ?>
					<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
					<?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );
						if ( $categories_list ):
					?>
					<div class="entry-meta">
						<?php oma_posted_on(); ?>
						<?php printf( __( '<span class="%1$s">in</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
						$show_sep = true; ?>
					</div><!-- .entry-meta -->
					<?php endif; // End if categories ?>
					<?php
						/* translators: used between list items, there is a space after the comma */
						$tags_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
						if ( $tags_list ):
						if ( $show_sep ) : ?>
					<span class="sep"> | </span>
						<?php endif; // End if $show_sep ?>
					<span class="tag-links">
						<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
						$show_sep = true; ?>
					</span>
					<?php endif; // End if $tags_list ?>
					<?php endif; // End if 'post' == get_post_type() ?>
					<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</section><!-- #entry-meta -->
				
			
				<?php if(is_single($post)): ?> 
					<?php the_content(); ?>
				<?php else: ?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			
			
			<?php comments_template( '', true ); ?>
      </div>
</article>
