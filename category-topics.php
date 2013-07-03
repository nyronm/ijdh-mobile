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
				<h1 class="topics"><?php
						printf( __( '%s', 'boilerplate' ), '' . single_cat_title( '', false ) . '' );
					?></h1>		
				</div>
			<ul id="most_recent" class="recent_filtered">	
<!-- 			 <?php query_posts($query_string . '&cat=1836, 1854, 1830, 1829, 1832, 1834,343, 1833, 1831'); ?> -->
			<?php if ( have_posts( ) ) : while (have_posts() ) : the_post(); ?>
			
			<li <?php post_class();?>>
			<?php ijdh_getCategory(); ?>
			<?php ijdh_show_thumb(); ?>
			
			<div class="entry-content">
			<h2>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
				<?php the_title(); ?>
				</a>
				</h2>
				<?php ijdh_show_excerpt($postID); ?>
			</div>
			</li>
			<?php
			endwhile; endif; ?>
			</ul>
			
			<div class="clearfix"><!-- #nav-below -->
			<?php if (  $wp_query->max_num_pages > 1 ) : ?>
			<nav id="nav-below" class="navigation clearfix">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'boilerplate' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'boilerplate' ) ); ?></div>
			</nav><!-- #nav-below -->
			<?php endif; ?>
			</div><!-- #nav-below -->

			
				</div> <!-- blog roll -->
	
				</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>