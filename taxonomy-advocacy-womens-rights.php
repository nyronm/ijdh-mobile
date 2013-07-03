<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
get_header(); ?>
				<div id="primary">

				<div id="blog_roll" class="clearfix">
				<div class="page-content">
				<h1 class="topics">
					<?php
							printf( __( '%s', 'boilerplate' ), '' . single_cat_title( '', false ) . '' );
						?>
					</h1>	
						<?php
							if(is_tax( 'advocacy','womens-rights') && $paged < 1){
							$womens = new WP_Query( 'page_id=11170' );
						    while ( $womens->have_posts() ) : $womens->the_post();
						    the_content(); 
						    endwhile;
						    wp_reset_postdata();

							} 
				
					
					/* Run the loop for the category page to output the posts.
					 * If you want to overload this in a child theme then include a file
					 * called loop-category.php and that will be used instead.
					 */
					get_template_part( 'loop', 'category' );
					?>
				</div>	
			
				</div> <!-- blog roll -->
	
				</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>