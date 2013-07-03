<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="primary" class="content">
				<?php ijdh_setPostViews(get_the_ID());?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<div class="entry-meta">
						<?php /* boilerplate_posted_on(); */ ?>
					</div><!-- .entry-meta -->
					<div class="entry-content">
						<?php 
						the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-utility">
						<?php boilerplate_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'boilerplate' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-utility -->
				</article><!-- #post-## -->
				<nav id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link('%link', ' &#60; Previous Article'); ?></div>
					<div class="nav-next"><?php next_post_link('%link', 'Next Article &#62;'); ?></div>
				</nav><!-- #nav-below -->
			</div> <!-- primary -->
<?php endwhile; // end of the loop. ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
