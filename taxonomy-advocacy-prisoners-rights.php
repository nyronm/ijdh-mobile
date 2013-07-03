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
					/* //CHOLERA */
					if(is_tax('advocacy', 'prisoners-rights')&& $paged < 1){
								$prisoners = new WP_Query( 'page_id=1230' );
						    while ( $prisoners->have_posts() ) : $prisoners->the_post(); 
							 the_content(); 
						    endwhile;
						    wp_reset_postdata();
							}
					get_template_part( 'loop', 'category' );
					?>
				</div>	
			
				</div> <!-- blog roll -->
	
				</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>