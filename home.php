<?php
/**
 * Template Name: Home page
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>

        <div id="primary">
            <div id="slider_container">

                <div id="slider">
                     <?php ijdh_show_feat(); ?>
                </div>

               <ul id="slider_pagination"></ul>

            </div><!-- slider_home -->

			<div class="content_banner">

				<span id="swtch_recent" class="swtch">
    				<a class="recent_filter" href="#" title="Most Recent Posts">Recent</a>
				</span>

				<span id="swtch_pop" class="swtch">
				        Popular&nbsp;
    					<select class="popular_filter">
						<option value="pop_alltime">All Time</option>
						<option value="pop_week">Last Week</option>
						<option value="pop_month">Last Month</option>
						<option value="pop_year">Last Year</option>
					</select>
				</span>

			</div><!-- content_banner -->

			<div id="blog_roll" class="clearfix">

	    		<ul id="most_recent" class="recent_filtered">
	                    <?php
				//get lastest post in each of categories excluding -> slug (events)
				$taxonomy = 'category';//  post_tag, category
				$param_type = 'category__in'; //  tag__in, category__in
				$term_args=array(
				'order' => 'ASC',
				'include' => '1829, 1830, 1832, 1854, 1834, 343, 1833, 1831'
				//'exclude' => '23'
				);
				
				$terms = get_terms($taxonomy,$term_args);
				if ($terms) {
				
				foreach( $terms as $term ) {
					//////////-------------/////////////
					if( $term->slug == "events" || $term->slug == "events-category" ){
								continue;
							} // thanks to Prof. JONATHAN M. T.
					//////////-------------/////////////
				$args=array(
				"$param_type" => array($term->term_id),
				'post_type'   => 'post',
				'post_status' => 'publish',
				'orderby' => 'post_date',
				'order' => 'DESC',
				'posts_per_page'  => 1,
				'caller_get_posts'=> 1
				);
				?>
				
				<?php
				
				$my_query = null;
				$my_query = new WP_Query($args);
				
				if( $my_query->have_posts() ) { 
				while ($my_query->have_posts()) : $my_query->the_post(); ?>
				
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
				endwhile; wp_reset_query();
				}
				}
				}
				?>
	            </ul>
	             <ul id="pop_alltime" class="popular_filtered">
	                    <?php ijdh_PopularAlltime(); ?>
                </ul>

        		<ul id="pop_week" class="popular_filtered">
                    <?php ijdh_PopularbyWeek(); ?>
                </ul>

    			<ul id="pop_month" class="popular_filtered">
                    <?php ijdh_PopularbyMonth(); ?>
                </ul>

                <ul id="pop_year" class="popular_filtered">
                    <?php ijdh_PopularAlltime(); ?>
                </ul>
			</div><!-- blog_roll -->

        </div><!-- primary -->

        <?php get_sidebar(); ?>

<?php get_footer(); ?>