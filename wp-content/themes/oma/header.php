<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.hoverIntent.minified.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/scripts.js" type="text/javascript"></script>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed">
	
	<header id="branding" role="banner" class="clear">
			<div id="wrapper-header" class="wrapper clear">
				<!-- phone number and subscribe,search -->
			  <div class="header-top clear-block clear">
						<div class="tel-num left" style="color:#C5CB50;"><?php dynamic_sidebar( 'phone' ); ?></div>
						<div class="subscribe-search right">
								<div id="subscribed" class="left"><a href="#" class="subscribed-link"><img src="<?php echo dirname( get_bloginfo('stylesheet_url') ); ?>/images/subscribe.png" alt="subsribed" /></a>
								</div>
								<div id="search-form" class="right">
									<?php get_search_form(); ?>
								</div>
								<?php echo do_shortcode('[gravityform id=2]'); ?>	
						</div>
				</div><!-- #header-top -->
				<div class="header-bottom clear-block clear">
					<div id="main-nav-wrapper" class="clear">
						<hgroup>
							<h1 id="site-title">
								<span>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
										<img src="<?php echo dirname( get_bloginfo('stylesheet_url') ); ?>/images/logo-oma.png" alt="<?php bloginfo('name'); ?>" />
									</a>
								</span>
							</h1>
						</hgroup>
						<nav id="access" role="navigation">
							<div id="access-inner">
								<h3 class="assistive-text"><?php _e( 'Main menu', 'twentyeleven' ); ?></h3>
								<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
								<?php echo do_shortcode('[gravityform id=3]'); ?>
							</div>
						</nav><!-- #access -->
					</div>
					<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div><!-- #header-bottom -->	
			</div>
			
	</header><!-- #branding -->	
	
	<section id="social-icons">
	  <ul class="social-nav">
	    <li class="twitter"><a href="http://twitter.com/#!/offmadisonave">Twitter</a></li>
	    <li class="facebook"><a href="http://www.facebook.com/offmadisonave">Facebook</a></li>
	    <li class="linkedin"><a href="http://www.linkedin.com/in/offmadisonave">LinkedIn</a></li>
	    <li class="youtube"><a href="http://www.youtube.com/user/offmadisonave">Youtube</a></li>
	  </ul>
	</section>
	
	<div id="main" class="clear">