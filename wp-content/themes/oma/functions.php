<?php
/**
 * Off Madison Ave functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyeleven_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Off Madison Ave
 * @since Twenty Eleven 1.0
 */  
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 584;

/**
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'twentyeleven_setup' );

if ( ! function_exists( 'twentyeleven_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyeleven_setup() in a child theme, add your own twentyeleven_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_setup() {

	/* Make Twenty Eleven available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Eleven, use a find and replace
	 * to change 'twentyeleven' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyeleven', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Load up our theme options page and related code.
	require( dirname( __FILE__ ) . '/inc/theme-options.php' );

	// Grab Twenty Eleven's Ephemera widget.
	require( dirname( __FILE__ ) . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	// Add support for custom backgrounds
	add_custom_background();

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	// The next four constants set how Twenty Eleven supports custom headers.

	// The default header text color
	define( 'HEADER_TEXTCOLOR', '000' );

	// By leaving empty, we allow for random image rotation.
	define( 'HEADER_IMAGE', '' );

	// The height and width of your custom header.
	// Add a filter to twentyeleven_header_image_width and twentyeleven_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyeleven_header_image_width', 1000 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyeleven_header_image_height', 288 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Add Twenty Eleven's custom image sizes
	add_image_size( 'large-feature', HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true ); // Used for large feature (header) images
	add_image_size( 'small-feature', 500, 300 ); // Used for featured posts if a large-feature doesn't exist

	// Turn on random header image rotation by default.
	add_theme_support( 'custom-header', array( 'random-default' => true ) );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyeleven_admin_header_style(), below.
	add_custom_image_header( 'twentyeleven_header_style', 'twentyeleven_admin_header_style', 'twentyeleven_admin_header_image' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'wheel' => array(
			'url' => '%s/images/headers/wheel.jpg',
			'thumbnail_url' => '%s/images/headers/wheel-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Wheel', 'twentyeleven' )
		),
		'shore' => array(
			'url' => '%s/images/headers/shore.jpg',
			'thumbnail_url' => '%s/images/headers/shore-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Shore', 'twentyeleven' )
		),
		'trolley' => array(
			'url' => '%s/images/headers/trolley.jpg',
			'thumbnail_url' => '%s/images/headers/trolley-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Trolley', 'twentyeleven' )
		),
		'pine-cone' => array(
			'url' => '%s/images/headers/pine-cone.jpg',
			'thumbnail_url' => '%s/images/headers/pine-cone-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Pine Cone', 'twentyeleven' )
		),
		'chessboard' => array(
			'url' => '%s/images/headers/chessboard.jpg',
			'thumbnail_url' => '%s/images/headers/chessboard-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Chessboard', 'twentyeleven' )
		),
		'lanterns' => array(
			'url' => '%s/images/headers/lanterns.jpg',
			'thumbnail_url' => '%s/images/headers/lanterns-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Lanterns', 'twentyeleven' )
		),
		'willow' => array(
			'url' => '%s/images/headers/willow.jpg',
			'thumbnail_url' => '%s/images/headers/willow-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Willow', 'twentyeleven' )
		),
		'hanoi' => array(
			'url' => '%s/images/headers/hanoi.jpg',
			'thumbnail_url' => '%s/images/headers/hanoi-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Hanoi Plant', 'twentyeleven' )
		)
	) );
}
endif; // twentyeleven_setup

if ( ! function_exists( 'twentyeleven_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // twentyeleven_header_style

if ( ! function_exists( 'twentyeleven_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 32px;
		line-height: 36px;
		text-decoration: none;
	}
	#desc {
		font-size: 14px;
		line-height: 23px;
		padding: 0 0 3em;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 1000px;
		height: auto;
		width: 100%;
	}
	</style>
<?php
}
endif; // twentyeleven_admin_header_style

if ( ! function_exists( 'twentyeleven_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // twentyeleven_admin_header_image

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function twentyeleven_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function twentyeleven_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function twentyeleven_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyeleven_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function twentyeleven_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyeleven_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function twentyeleven_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyeleven_page_menu_args' );

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_widgets_init() {

	register_widget( 'Twenty_Eleven_Ephemera_Widget' );

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Showcase Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-2',
		'description' => __( 'The sidebar for the optional Showcase Template', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area One', 'twentyeleven' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'twentyeleven' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'twentyeleven' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentyeleven_widgets_init' );

register_taxonomy("services", array("projects"), array("hierarchical" => true, "label" => "Related Services", "singular_label" => "Related Services", "query_var" => true , "rewrite" => true));
	
/**
 * Display navigation to next/previous pages when applicable
 */
function twentyeleven_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function twentyeleven_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function twentyeleven_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for twentyeleven_comment()

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'twentyeleven' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_body_classes( $classes ) {

	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'twentyeleven_body_classes' );



/*****************************************************************
*   THEME OVERRIDES SHOULD START FROM HERE 
*   OMA functions.php override
*   arnelbornales@gmail.com
/*****************************************************************/

function oma_init() {
	/*remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	*/
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'init', 'oma_init' );


function oma_widgets_init() {
	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Search' );
	//unregister_widget( 'WP_Widget_Text' );
	//unregister_widget( 'WP_Widget_Categories' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_RSS' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	
	register_sidebar( array(
		'name' => 'Phone Number',
		'id' => 'phone',
		'description' => 'Place a single "Text" widget here with the phone number as the content.',
		'before_widget' => '<div class="phone">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => ''
	) );
	
	register_sidebar( array(
		'name' => 'Homepage Featured Project',
		'id' => 'homepage_featured_project',
		'description' => 'Display 3 Featured Projects',
		'before_widget' => '<div class="homepage-featured-projects-inner">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => ''
	) );
	
	register_sidebar( array(
		'name' => 'Homepage Contact Us Form',
		'id' => 'homepage_contact_us_form',
		'description' => 'Display Contact Us Form in Homepage',
		'before_widget' => '<div class="homepage-contact-us-form">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => ''
	) );
	
	register_sidebar( array(
		'name' => 'Latest Posts in Homepage',
		'id' => 'latest_posts',
		'description' => 'Display Latest Posts (Blog and Agency News)',
		'before_widget' => '<div class="homepage-latest-posts">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => ''
	) );
	
	register_sidebar( array(
		'name' => 'Footer Contact',
		'id' => 'footer_contact',
		'description' => 'Place a single "Text" widget here with contact info.',
		'before_widget' => '<div class="contact">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => ''
	) );
}
add_action( 'widgets_init', 'oma_widgets_init', 1 );


function oma_setup_theme() {
	add_image_size( 'featured-projects', 288, 145, false );
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
    add_image_size( 'featured-project-thumb', '288', '145', false );
    remove_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );
    remove_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );
}
add_action( 'after_setup_theme', 'oma_setup_theme' );

/**
 * START Returns a " more > " link for excerpts
 */
function oma_continue_reading_link() {
	return ' <div class="read-more"><a href="'. esc_url( get_permalink() ) . '">' . __( 'more >', 'twentyeleven' ) . '</a></div>';

}
function oma_auto_excerpt_more( $more ) {
	return ' &hellip;' . oma_continue_reading_link();
}
add_filter( 'excerpt_more', 'oma_auto_excerpt_more' );

function oma_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= oma_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'oma_custom_excerpt_more' );
/**
 * END Returns a " more > " link for excerpts
*/

function oma_page_excerpts(){
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'oma_page_excerpts');

function oma_page_quicktabs() { ?>
<script type="text/javascript" src="http://jqueryui.com/jquery-1.6.2.js"></script>
<script type="text/javascript" src="http://jqueryui.com/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="http://jqueryui.com/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="http://jqueryui.com/ui/jquery.ui.tabs.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$("#tabs").tabs();
	});
</script><?php
}     
add_action('wp_head', 'oma_page_quicktabs');

// add shortcode to display three featured projects in homepage
function get_homepage_featured_project( $atts, $content = NULL) {
	extract( shortcode_atts( array(
		'project_count' => 'project_count',
	), $atts ) );
	
	$args = array(
		'post_type' => 'projects',
		'post_status' => array('publish'),
		'meta_key' => 'field_project_featured',
		'meta_value' => '1',
		'order_by' => 'modified',
		'posts_per_page' => $project_count, 
		'offset' => 0,
	);
	$featProjects = new WP_Query( $args );
	
	if ( $featProjects->have_posts() ) :
		
		$i = 0;
		while ( $featProjects->have_posts() ) : $featProjects->the_post(); 
		// get_the_ID() is the POST ID 
		?>
		<div id = "project-featured-<?php echo $i ?>" class = "project-featured project-featured-wrapper">
				<?php the_post_thumbnail('featured-project-thumb'); ?>
				<div class="project-featured-inner">
					<div class="featured-project-details">
							<h2><a href="<?php the_permalink(); ?>" class="project-featured-title"> <?php the_title(); ?></a></h2>
							<?php the_excerpt(); ?>
					</div>
					<div class="featured-project-tags">
							<div class="related-services">RELATED SERVICES</div>
							<div class="related-services-tags"><?php the_terms( get_the_ID(), 'services' , '', '', '' ); ?></div>
					</div>
				</div>
	  </div><?php
	  $i++;
		endwhile;
	endif;?>
	<?php
	// Reset Post Data
	wp_reset_postdata();
	//return $content;
}
add_shortcode( 'get_homepage_featured_project', 'get_homepage_featured_project' );

function add_projects_header(){ ?>
		<!-- http://jquery.malsup.com/cycle/pager11.html -->
		<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function() {
			
			    jQuery('#projects').cycle({
			        fx:      'fade',
			        timeout:  0,
			        prev:    '#prev',
			        next:    '#next',
			    });
			    jQuery('#process').cycle({
			        fx:      'fade',
			        timeout:  0,
			        pager:   '#process-nav',
			    });
			    
			    /*,
				before: function(current, next, opts, forward) {
				  var $current = $('div[id^="projects-carousel"]', $(current)),
					  $next = $('div[id^="projects-carousel"]', $(next));
					  
				  $current.cycle('destroy');
				  $next.data('cycleStarted', true).cycle({
					pager: $('ul[id^="nav-"]', $next)
				  });
				}*/
			    <?php
					$args = array(
						'post_type' => 'projects',
						//'post_status' => array('publish'),
						//'order_by' => 'modified',
					);
					$featProjects = new WP_Query( $args );
					if ( $featProjects->have_posts() ) :
						while ( $featProjects->have_posts() ) : $featProjects->the_post();?>
					  
						jQuery('#projects-carousel-<?php echo get_the_ID(); ?>').cycle({
						              fx:      'scrollHorz',
									  timeout:  0,
						              pager:   '#nav-<?php echo get_the_ID(); ?>'
						});
						<?php
						endwhile;
					endif;
					// Reset Post Data
					wp_reset_postdata();
				?>
			});
		</script>
<?php
}
add_action('wp_head', 'add_projects_header');


function get_projects_tab_content( $atts, $content = null ){ 
	//add_action('wp_head', 'add_projects_header')
	ob_start(); ?>
	<div class="project-nav-wrapper">
		<div class="left">
			<div id="project-all-btn">
				<a href="#"><img src="/oma/wp-content/themes/oma/images/see_all_clients_project.jpg" /></a>
		  		<div class="project-modal">
					<ul id="all-projects">
						<?php  
<<<<<<< HEAD
						  $args = array( 'post_type' => 'projects');
              $loop = new WP_Query( $args );

              while ( $loop->have_posts() ) : $loop->the_post();
            ?>

            <li class="<?php 
              $terms = get_the_terms(get_the_ID(), "Services");
              $count = count($terms);
              if ( $count > 0 ){
                  foreach ( $terms as $term ) {
                    echo $term->slug;
                    echo " ";
                  }
              }
             ?>"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></li>
            <?php                
              endwhile;
						?>
						</ul>
						<div id="projects-all-right">
						  <h3>View by Service</h3>
						  
						  <?php

    				  $taxonomyName = "Services";
              //This gets top layer terms only.  This is done by setting parent to 0.  
              $parent_terms = get_terms($taxonomyName, array('parent' => 0, 'orderby' => 'slug', 'hide_empty' => false));   
              echo '<dl id="projects-filter">';
              foreach ($parent_terms as $pterm) {
                  //Get the Child terms
                  echo '<dt>' . $pterm->name . '</dt>';

                  $terms = get_terms($taxonomyName, array('parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false));
                  foreach ($terms as $term) {
                      echo '<dd><input type="checkbox" name="' . $term->slug . '" value="' . $term->slug . '" />' . $term->name . '</a></dd>';  
                  }
              }
              echo '</dl>';

    				  ?>
						  
  					  <!-- <dl id="projects-filter">
  					                 <dt>Marketing &amp; Advertising</dt>
  					                  <dd><input type="checkbox" name="lifecycle-marketing" value="lifecycle-marketing" />Lifecycle Marketing</dd>
  					                  <dd><input type="checkbox" name="social-media" value="social-media" />Social Media</dd>
  					                  <dd><input type="checkbox" name="media-buying-planning" value="media-buying-planning" />Media Buying/Planning</dd>
  					                  <dd><input type="checkbox" name="ppc" value="ppc" />PPC</dd>
  					                  <dd><input type="checkbox" name="seo" value="seo" />SEO</dd>
  					                  <dt>Web &amp; App Development</dt>
  					                  <dd><input type="checkbox" name="user-experience" value="user-experience" />User Experience</dd>
  					                  <dd><input type="checkbox" name="content-strategy" value="content-strategy" />Content Strategy</dd>
  					                  <dd><input type="checkbox" name="website" value="website" />Website</dd>
  					                  <dd><input type="checkbox" name="applications" value="applications" />Applications</dd>
  					                  <dt>Creative</dt>
  					                  <dd><input type="checkbox" name="branding" value="branding" />Branding</dd>
  					                  <dd><input type="checkbox" name="interactive" value="interactive" />Interactive</dd>
  					                  <dd><input type="checkbox" name="traditional" value="traditional" />Traditional</dd>
  					                  <dt>Public Relations</dt>
  					                  <dd><input type="checkbox" name="media-relations" value="media-relations" />Media Relations</dd>
  					                  <dd><input type="checkbox" name="strategic-communications" value="strategic-communications" />Strategic Communications</dd>
  					                  <dd><input type="checkbox" name="crisis-communications" value="crisis-communications" />Crisis Communications</dd>
  					               </dl> -->
						</div>
=======
						$args = array(
						  'post_type' => 'projects',
						  //'category_name' => 'services',
						  'post_status' => array('publish'),
						);
							
						$loop = new WP_Query( $args );

						while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<li class="<?php 
						  $terms = get_the_terms(get_the_ID(), "services");
						  $count = count($terms);
						  if ( $count > 0 ){
							  foreach ( $terms as $term ) {
								echo $term->slug;
								echo " ";
							  }
						  }
						?>"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></li>
						<?php                
						endwhile;
						wp_reset_postdata();?>
					</ul>
					<div id="projects-all-right">
						  <h3>View by Service</h3>
						  <dl id="projects-filter">
							  <dt>Marketing &amp; Advertising</dt>
								<dd><input type="checkbox" name="lifecycle-marketing" value="lifecycle-marketing" />Lifecycle Marketing</dd>
								<dd><input type="checkbox" name="social-media" value="social-media" />Social Media</dd>
								<dd><input type="checkbox" name="media-buying-planning" value="media-buying-planning" />Media Buying/Planning</dd>
								<dd><input type="checkbox" name="ppc" value="ppc" />PPC</dd>
								<dd><input type="checkbox" name="seo" value="seo" />SEO</dd>
							  <dt>Web &amp; App Development</dt>
								<dd><input type="checkbox" name="user-experience" value="user-experience" />User Experience</dd>
								<dd><input type="checkbox" name="content-strategy" value="content-strategy" />Content Strategy</dd>
								<dd><input type="checkbox" name="website" value="website" />Website</dd>
								<dd><input type="checkbox" name="applications" value="applications" />Applications</dd>
							  <dt>Creative</dt>
								<dd><input type="checkbox" name="branding" value="branding" />Branding</dd>
								<dd><input type="checkbox" name="interactive" value="interactive" />Interactive</dd>
								<dd><input type="checkbox" name="traditional" value="traditional" />Traditional</dd>
							  <dt>Public Relations</dt>
								<dd><input type="checkbox" name="media-relations" value="media-relations" />Media Relations</dd>
								<dd><input type="checkbox" name="strategic-communications" value="strategic-communications" />Strategic Communications</dd>
								<dd><input type="checkbox" name="crisis-communications" value="crisis-communications" />Crisis Communications</dd>
						  </dl>
>>>>>>> cbec90b8c8ac98b91835a617fe72e102f98adc00
					</div>
				
				</div>
		  </div>
		  </div>
		  	<div class="left">
		  		<a href="#"><span id="prev">&lt;</span></a><span class="next-project">NEXT PROJECT</span><a href="#"><span id="next">&gt;</span></a>
		  	</div>
		</div>
	  <div id="projects">
      <?php						
		  
		  $args = array(
			'post_type' => 'projects',
			//'category_name' => 'Services',
			'post_status' => array('publish'),
			'order_by' => 'modified',
		  );
		  $featProjects = new WP_Query( $args );
				$i = 1;
				if ( $featProjects->have_posts() ) :
					while ( $featProjects->have_posts() ) : $featProjects->the_post(); 
					// get_the_ID() is the POST ID  ?>		
					<div class="inner-tab-wrapper">	
						<div class="projects-wrapper-left left">
							<?php $carousel_images = get_post_meta(get_the_ID(), 'field_images_carousel', true); ?>
							<h2 class="inner-tab-title">
							<a href="<?php echo the_permalink(); ?>" class="inner-tab-title"><?php echo the_title(); ?><?php echo $i; ?></a>
							</h2>
							<span class="inner-tab-sub-headline"><?php echo get_post_meta(get_the_ID(), 'field_sub_headline' , true); ?></span>					
							<?php echo the_content(); ?>
						</div>
						
						<div class="projects-wrapper-right right" style="">									
							<div id = "project-<?php echo get_the_ID(); ?>" class = "project-wrapper" style="clear:both;">
								<div id="projects-carousel-<?php echo get_the_ID(); ?>" class="projects-carousel">
								<?php
									foreach($carousel_images as $key){ ?>
										<img src="<?php echo $key['image']; ?>" /><?php 
									}
								?>
								</div>
						    							    	
						    	<ul id="nav-<?php echo get_the_ID(); ?>" class="projects-pagi"></ul>
						    	<dl class="project-launched services-cat">
						    		<dt>Launched:</dt> 
									<dd><?php echo get_post_meta(get_the_ID(), 'field_project_launched' , true); ?></dd>
						    	</dl>
								<dl class="services-cat">
									<dt>Services:</dt>
									<?php the_terms( get_the_ID(), 'services' , '<dd>', '</dd><dd>', '</dd>' ); ?>
								</dl>
						    		<a href="<?php echo get_post_meta(get_the_ID(), 'field_project_view_site' , true); ?>" class="projects-view-site">VIEW SITE</a>
								</div>
							</div>
						</div>
				  <?php
				  $i++;
				  endwhile;
			  endif;
			  wp_reset_postdata();?>
	  </div><?php
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
}
add_shortcode( 'get_projects_tab_content', 'get_projects_tab_content' );



function get_process_tab_content( $atts, $content = null ){
		$args = array(
			'post_type' => 'process',
			'post_status' => array('publish'),
			'order_by' => 'modified',
		);
		$process = new WP_Query( $args );
		ob_start();
		if ( $process->have_posts() ) :
			while ( $process->have_posts() ) : $process->the_post(); ?>
			  <div class="inner-tab-wrapper">	
					<div class="process-wrapper-left left">  	
					<?php $carousel_images = get_post_meta(get_the_ID(), 'field_images_carousel', true); ?>
						<h2 class="inner-tab-title"><a href="<?php echo the_permalink(); ?>" class="inner-tab-title"><?php echo the_title(); ?></a></h2>
						<span class="inner-tab-sub-headline"><?php echo get_post_meta(get_the_ID(), 'field_sub_headline' , true); ?></span>
						<?php echo the_content(); ?>
					</div>
					<div class="process-wrapper-right right" style="">									
						<div id="process" class="process-carousel">
							<?php
							foreach($carousel_images as $key){ ?>
								<img src="<?php echo $key['image']; ?>" /><?php 
							}?>
						</div>
						<ul id="process-nav" class="process-pagi"></ul>
					</div>
				</div><?php
			endwhile;
		endif;		
		wp_reset_postdata();
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
}
add_shortcode( 'get_process_tab_content', 'get_process_tab_content' );



function get_services_tab_content( $atts, $content = null ){
		extract( shortcode_atts( array(
			'page_id' => 'page_id',
			'page_id_b' => 'page_id_b',
		), $atts ) );
		$args = array('post_type' => 'pages',
					  'post_status' => array('publish'),
					  'page_id' => $page_id,
				);
		$query_left = new WP_Query( $args );
		ob_start();
		?>
	    <div class="inner-tab-wrapper clear-after clear"><?php
		if ( $query_left->have_posts() ) :?>
			  <div class="marketing-wrapper"><?php	
				  
					//$terms = get_term_by('id', 4, 'services');
					//print '<h1>';
					//print_r($terms->description);
					//print '</h1>';
					
					while ( $query_left->have_posts() ) : $query_left->the_post(); ?>
					<div class="marketing-wrapper-left left">  	
				    	<h2 class="inner-tab-title"><a href="<?php echo the_permalink(); ?>" class="inner-tab-title"><?php echo get_post_meta(get_the_ID(), 'field_inner_title_quicktab' , true); ?></a></h2>
							<span class="inner-tab-sub-headline"><?php echo get_post_meta(get_the_ID(), 'field_inner_sub_title_quicktab' , true); ?></span>
							<?php echo the_content(); ?>
					</div><?php
					endwhile; 
					
					wp_reset_postdata();
					/**
					 $args = array('post_type' => 'services',
									  'post_status' => array('publish'),
									  'page_id' => $page_id_b,
									  );
					$query_right = new WP_Query( $args );
					*/	
					$query_right = new WP_Query( 'page_id='.$page_id_b.'' ); 
					while ( $query_right->have_posts() ) : $query_right->the_post(); ?>
					<div class="marketing-wrapper-right right" style="">									
							<?php echo the_content(); ?>
					</div><?php
					endwhile; 
					wp_reset_postdata();?>
					
				</div><?php
		endif;		
		?>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
}
add_shortcode( 'get_services_tab_content', 'get_services_tab_content' );


//http://codex.wordpress.org/Template_Tags/get_posts
function get_latest_post( $atts, $content = NULL){
  global $post;
	/** use this with shortcodes params 
	extract( shortcode_atts( array(
		'post_type' => 'post_type',
		'show_author_thumb' => 'show_author_thumb',
	), $atts ) );
	$args = array( 'numberposts' => 1, 'post_type'=> $post_type );
	*/
	$args = array( 'numberposts' => 1 );
	$myposts = get_posts( $args );
	?>
	<div class="our-latest-wrapper"><h1>OUR LATEST</h1></div>
	<?php
	foreach( $myposts as $post ) :	
		setup_postdata($post);?>
		<div class="left">
			<?php echo userphoto_the_author_thumbnail(); ?>
		</div>
		<div class="latest-post-entry right">
			<h3><a href="<?php the_permalink(); ?>" class="latest-post-title"><?php the_title(); ?></a><br /></h3>
			<div class="latest-post-info">
				Written on <?php the_time('F jS, Y') ?> Posted by <?php the_author_posts_link() ?> in <?php the_category(','); ?>
			</div>
			<?php the_excerpt(); ?>
		</div><?php 
	endforeach; 
}
add_shortcode( 'get_latest_post', 'get_latest_post' );


function get_latest_agency_news( $atts, $content = NULL){
  global $post;
	$args = array( 'numberposts' => 1 , 'post_type' => 'agency_news');
	$myposts = get_posts( $args );?>
	<div class="agency-news-wrapper"><h4>AGENCY NEWS</h4></div>
	<?php
	foreach( $myposts as $post ) :	
		setup_postdata($post); ?>
		<div class="agency-news-entry">
			<small><?php the_time('F jS, Y') ?></small><br />
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="read-more"><a href="<?php the_permalink(); ?>"><?php echo __( 'more >' );?></a></div>
			
		</div><?php 
	endforeach; 
}
add_shortcode( 'get_latest_agency_news', 'get_latest_agency_news' );


//http://codex.wordpress.org/Template_Tags/get_posts
function get_current_year( $atts, $content = NULL){
	return date('Y');
}
add_shortcode( 'get_current_year', 'get_current_year' );


function add_category_class_single($body_class){
	global $post;
	if(isset($post->post_type) && isset($post->post_name)) {
		$body_class[] = $post->post_type .'-' . $post->post_name;
	}
	else{
		return 0;
	}
 	return $body_class;
}
add_filter('body_class', 'add_category_class_single');


function input_text_clear(){ ?>
<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery.fn.cleardefault = function() {
		return this.focus(function() {
			if( this.value == this.defaultValue ) {
				this.value = "";
			}
		}).blur(function() {
			if( !this.value.length ) {
				this.value = this.defaultValue;
			}
		});
	};
	jQuery(".text-clear input, .text-clear textarea, text-clear").cleardefault();
	jQuery(".subscribed-link").click(
		function () {
			jQuery("#gform_wrapper_2").slideToggle("fast");
			this.blur();
			return false;
		}
	);
	jQuery("#menu-item-133").click(
		function () {
			jQuery("#gform_wrapper_3").slideToggle("fast");
			this.blur();
			return false;
		}
	); 
});
</script>
<?php
}
add_action('wp_head', 'input_text_clear');


add_filter( 'widget_text', 'do_shortcode');

// Add Social Media Fields to WP User

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
 
function extra_user_profile_fields( $user ) { ?>
<h3><?php _e("Social profile information", "blank"); ?></h3>
 
<table class="form-table">
<tr>
<th><label for="twitter"><?php _e("Twitter"); ?></label></th>
<td>
<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your Twitter."); ?></span>
</td>
</tr>
<tr>
<th><label for="linkedin"><?php _e("LinkedIn"); ?></label></th>
<td>
<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your LinkedIn."); ?></span>
</td>
</tr>
</table>
<?php }
 
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
 
function save_extra_user_profile_fields( $user_id ) {
 
if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
update_usermeta( $user_id, 'linkedin', $_POST['linkedin'] );
}


function remove_add_processs() {
	global $submenu;
	unset($submenu['edit.php?post_type=process'][10]); // Removes 'Add New'.
}
add_action('admin_menu', 'remove_add_processs');
?>