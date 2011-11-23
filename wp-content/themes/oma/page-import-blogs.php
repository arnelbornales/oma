<?php
/* Template Name: Import Blogs Page */
get_header(); ?>
		<div id="primary">
			<div id="content" role="main" class="wrapper-primary clear">
				
				<div id="content-blurb-wrapper" class="clear">
					<div id="content-blurb-inner">
						<?php //the_post(); ?>
						<?php //get_template_part( 'content', 'blurb' ); ?>
					</div>
				</div>
				
				<div id="content-page-wrapper" class="clear">
					<div id="content-page-inner" class="page-quicktabs">
							
							<div class="content-page-content clear">
							<?php
							
								//for users
								//$result = mysql_query("SELECT handle,email_address,full_name FROM ror_users;");
								
								//for articles
								//$result = mysql_query("SELECT title,post,user_id,created_at,slug FROM ror_articles");
								
								//for comments
								//UPDATE ror_comments rc,ror_articles ra SET rc.article_id = (SELECT ap.ID FROM amo_posts ap,ror_articles ra WHERE ap.post_title = ra.title AND rc.article_id = ra.id LIMIT 1) WHERE rc.article_id = ra.id
								$result = mysql_query("SELECT article_id,name,email,website,comment,ip_address,created_at FROM ror_comments WHERE approved = 1");
								if (!$result) {
								    echo 'Could not run query: ' . mysql_error();exit;
								}
								print '<pre>';
								
								while($row = mysql_fetch_array($result)) {
									
									/*
									print '<br />';
									print_r($row['title']);	// post_title		
									*/
									/*
									Create USERS
									$user_login = esc_sql( $row['handle'] );
									$user_email = esc_sql( $row['email_address'] );
									$user_pass = 'password';
									$display_name = esc_sql( $row['full_name'] );
									$userdata = compact('user_login', 'user_email', 'user_pass','display_name');
								  wp_insert_user($userdata);					
									*/
									/*
									Create POSTS
									$post = array(
									  'comment_status' => 'open',
									  'post_author' => $row['user_id']+2,
									  'post_content' => $row['post'],
									  'post_date' => $row['created_at'],
									  'post_date_gmt' => $row['created_at'],
									  'post_excerpt' => $row['post'],
									  'post_name' => $row['slug'],
									  'post_status' => 'publish',
									  'post_title' => $row['title'],
									  'post_type' => 'post',
									);  
									wp_insert_post($post, $wp_error);
									*/
									$data = array(
									    'comment_post_ID' => $row['article_id'],
									    'comment_author' => $row['name'],
									    'comment_author_email' => $row['email'], 
									    'comment_author_url' => $row['website'],
									    'comment_content' => $row['comment'],
									    //'user_id' => 1,
									    'comment_author_IP' => $row['ip_address'],
									    //'comment_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
									    'comment_date' =>  $row['created_at'],
									    'comment_approved' => 1,
									);
									
									//print_r($data);
									//wp_insert_comment($data);
								}
								
								
								print '</pre>';
								
							?>							
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