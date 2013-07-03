<?php
/**
 * Template Name: About
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>
    <div id="primary" class="content">
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php if ( is_front_page() ) { ?>
                            <h2 class="entry-title"><?php the_title(); ?></h2>
                        <?php } else { ?>
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        <?php } ?>
                            <div class="entry-content">
                                <?php the_content(); ?>
                                <?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
                                <?php edit_post_link( __( 'Edit', 'boilerplate' ), '', '' ); ?>
                            </div><!-- .entry-content -->
                        </article><!-- #post-## -->
        <?php endwhile; ?>
    </div> <!-- primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>