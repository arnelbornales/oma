<?php
/* Template Name: Page with Quicktabs Template */
get_header(); ?>

		<div id="primary">
			<div id="content" role="main" class="wrapper-primary clear">
				
				<div id="content-blurb-wrapper" class="clear">
					<div id="content-blurb-inner">
						<?php the_post(); ?>
						<?php get_template_part( 'content', 'blurb' ); ?>
					</div>
				</div>
				
				<div id="content-page-wrapper" class="clear">
					<div id="content-page-inner" class="page-quicktabs">
							<?php if(is_front_page()): ?>
							<div class="homepage-featured-projects-wrapper clear"><?php dynamic_sidebar( 'homepage_featured_project' ); ?></div>
							<div class="homepage-latest-posts-wrapper clear">
									<?php dynamic_sidebar( 'latest_posts' ); ?>
									<?php dynamic_sidebar( 'homepage_contact_us_form' ); ?>
							</div>
							<?php else: ?>
							<div class="homepage-featured-projects-wrapper clear"><?php //the_content(); ?></div>
							<?php endif; ?>
							<style>
							
							
							table { margin: auto; border-collapse: separate; border-spacing: 20px }
							td { vertical-align: top; text-align:center; width: 235px }
							
							pre { text-align: left; overflow: visible }
							
							.projects { height: 232px; width: 232px; padding:0; margin:0; overflow: hidden }
							.projects img { height: 200px; width: 200px; padding: 15px; border: 1px solid #ccc; background-color: #eee; top:0; left:0 }
							.projects img {
								-moz-border-radius: 10px; -webkit-border-radius: 10px;
							}

							
							</style>
							<!-- http://jquery.malsup.com/cycle/pager11.html -->
							<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
							<script type="text/javascript" src="http://malsup.github.com/chili-1.7.pack.js"></script>
							<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>
							<style type="text/css">
							
							.nav { margin: 10px;  }
							.nav li { float: left; list-style: none}
							.nav a { margin: 5px; padding: 3px 5px; border: 1px solid #ccc; background: #fc0; text-decoration: none }
							.nav li.activeSlide a { background: #faa; color: black }
							.nav a:focus { outline: none; }
							</style>
							
							<script type="text/javascript">
							jQuery(function() {
							
							    jQuery('#projects').cycle({
							        fx:      'scrollHorz',
							        timeout:  0,
							        prev:    '#prev',
							        next:    '#next',
							    });
									
									<?php
									$args = array(
										'post_type' => 'projects',
										'post_status' => array('publish'),
										'meta_key' => 'field_featured_project',
										'meta_value' => '1',
										'order_by' => 'modified',
									);
									$featProjects = new WP_Query( $args );
									if ( $featProjects->have_posts() ) :
										while ( $featProjects->have_posts() ) : $featProjects->the_post(); 
										?>
										
										jQuery('#projects-carousel-<?php echo get_the_ID(); ?>').cycle({
							        fx:      'fade',
							        timeout:  0,
							        pager:   '#nav-<?php echo get_the_ID(); ?>',
							    	});
										
										<?php
										endwhile;
									endif;
									// Reset Post Data
									wp_reset_postdata();?>
									
									
									
							});
							</script>
							<div id="demos">
						    <div style="text-align:center;margin:auto;width:600px">
						        <a href="#"><span id="prev">Prev</span></a> 
						        <a href="#"><span id="next">Next</span></a>
						    </div>
						    <div id="projects" class="pics" style="margin:auto;clear:left;margin-top:40px; background: #fff">
						    <!--		<div>
						    			<p>Project 1</p>
						    			<div class="projects-carousel">
						    				<img src="http://cloud.github.com/downloads/malsup/cycle/beach1.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach2.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach3.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach4.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach5.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach6.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach7.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach8.jpg" />
						    			</div>
						    			<ul class="nav"></ul>
						    		</div>
						    		<div>
						    			<p>Project 2</p>
						    			<div class="projects-carousel">
						    				<img src="http://cloud.github.com/downloads/malsup/cycle/beach1.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach2.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach3.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach4.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach5.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach6.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach7.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach8.jpg" />
						    			</div>
						    			<ul class="nav"></ul>
						    		</div>
						    </div>
						    -->
						
						
						
						<?php
						$featProjects = new WP_Query( $args );
						if ( $featProjects->have_posts() ) :
							while ( $featProjects->have_posts() ) : $featProjects->the_post(); 
								// get_the_ID() is the POST ID ?>
								<div id = "project-<?php echo get_the_ID(); ?>" class = "project-wrapper" style="clear:both;">
									<h2><a href="<?php the_permalink(); ?>" class="project-featured-title"> <?php the_title(); ?></a></h2>
									<?php the_content(); ?>
									<div id="projects-carousel-<?php echo get_the_ID(); ?>">
						    				<img src="http://cloud.github.com/downloads/malsup/cycle/beach1.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach2.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach3.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach4.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach5.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach6.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach7.jpg" />
								        <img src="http://cloud.github.com/downloads/malsup/cycle/beach8.jpg" />
						    	</div>
						    	<ul id="nav-<?php echo get_the_ID(); ?>"></ul>
					  		</div><?php
							endwhile;
						endif;?>
						<?php
						// Reset Post Data
						wp_reset_postdata();?>
						</div>
						
							
					</div>
				</div>
				
				<div id="content-closure" class="clear">
					<div id="content-closure-wrapper">
					</div>
				</div>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>