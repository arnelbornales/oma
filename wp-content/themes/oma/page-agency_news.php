<?php
/* Template Name: Agency News Archive Page */
get_header(); ?>
				
		<div id="content-blurb-wrapper" class="clear">
			 <div id="content-blurb-inner">
				 <?php //the_post(); ?>
				 <?php //get_template_part( 'content', 'blurb' ); ?>
			 </div>
		</div>
		
		<div id="content-page-wrapper" class="page-simple-page clear">
			 <div id="page-wrapper">
			   <div id="page-container">
						<div id="primary">
							<div id="content" role="main"><?php
							
							$args = array(
								'post_type' => 'agency_news',
								'post_status' => array('publish'),
								'order_by' => 'modified',
							);
							$query_right = new WP_Query( $args ); 
							$years = array();
				  		while ( $query_right->have_posts() ) : $query_right->the_post(); 
				  					$time = get_post_meta(get_the_ID(), 'field_story_date' , true); 
										$date = date_create($time);
										$year = date_format($date, 'Y'); 
										$years[] = $year;
				  		endwhile;
				  		$years = array_unique($years);
							wp_reset_postdata(); 
							
							foreach($years as $year): ?>		
									<div class="inner-tab-wrapper clear-after clear">
											<div class="press-room-archive-left left">
													<?php echo $year; ?>
											</div>
											<div class="press-room-archive-right right">
											<?php
											$year_operator = $year + 1;
											$args = array(
												//'meta_key' => 'field_story_date',
												//'meta_value' => $year.'%',
												//'meta_compare' => 'LIKE' ,
												'post_type' => 'agency_news',
												'post_status' => array('publish'),
												'meta_query' => array(
													array(
														'key' => 'field_story_date',
														'value' => $year.'-01-01' ,
														'compare' => '>='
														
													),
													array(
														'key' => 'field_story_date',
														'value' => $year.'-12-31' ,
														'compare' => '<='
														
													)
												)
												//'order_by' => 'modified',
											);
											$query_right = new WP_Query( $args ); 
											while ( $query_right->have_posts() ) : $query_right->the_post(); ?>													
											    <div class="press-room-entry">
															<h3 class="entry-title">
																<a href="<?php the_permalink(); ?>" class="latest-post-title"><?php the_title(); ?></a><br />
															</h3>												
															<span class="entry-meta">
															<?php $time = get_post_meta(get_the_ID(), 'field_story_date' , true); 
																	print_r($time);
																	$date = date_create($time);
																	echo 'Written on '.date_format($date, 'F y, Y'); 
															?>
															</span>
															<?php echo the_excerpt(); ?>
															<?php $pdf =  get_post_meta(get_the_ID(), 'field_pdf_upload' , true); ?>
													</div>								
							        <?php endwhile;
											wp_reset_postdata(); ?>				
											</div>
									 </div>
									<?php
							endforeach; ?>		
									
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