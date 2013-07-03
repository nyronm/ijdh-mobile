<?php
/*
Plugin Name: Events Post Widget
Plugin URI: http://ijdh.org/
Description: Post widget for the Events category
Author:  City Tech Team fall 2012 [Dan, Sebastian, Norali, Natasha, Kevin and Juan]
Version: 1.0 
Author URI: http://citytech.cuny.edu/
*/

 
class EventsPostWidget extends WP_Widget
{
  function EventsPostWidget()
  
  {
    $widget_ops = array('classname' => 'EventsPostWidget', 'description' => 'Displays 5 post from the events category' );
    $this->WP_Widget('EventsPostWidget', 'IJDH Events Post', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
  function widget($args, $instance)
  {
    extract( $args, EXTR_SKIP );
    echo $before_widget;
    
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
    	?> <h3><a href="index.php?cat=1849">Events</a></h3><?php
      	//echo $before_title . $title . $after_title;
      	echo ('<ul>');

    // WIDGET CODE GOES HERE That gets the post
    //echo "<h3>Events</h3>";
    // Get the ID of a given category
   

    	query_posts('category_name=events-category&showposts=4&post_status=future, publish');
    	// The Loop
    	 while ( have_posts() ) : the_post();
    	?>
    	    	
    	<li>

	    <div>
	    <div id="date">
	    	    		<span class="day">
	    					<?php 
	    				the_time('j');
	    					?>
	    	    		</span>
	    	    		<span class="month">
	    	    		<?php the_time('M'); ?>
	    	    		</span>
	    	    	</div>
	    			
	    	    	<?php 
	    	the_excerpt_events(75);
	    	    	?>
	    </div>
    	</li>
    	
    	<?php
	    	endwhile;

// Reset Query
	wp_reset_query();
	echo ('</ul>');
	

    echo $after_widget;

  }
 
}
add_action( 'widgets_init', create_function( '', 'return register_widget("EventsPostWidget");' ) );
	///----
	// the excerpt for the widget EVENTS
	the_excerpt_events(40);
function the_excerpt_events( $charlength ) {
	$excerpt = get_the_excerpt();
	$charlength++;
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		echo '<p>';
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '</p>';
		?>
		<strong class="more-events">
		<a href="<?php the_permalink(); ?>">
		find out more
		</a>
		</strong>
		<?php
	} else {
		echo $excerpt;
	}
}
/* FUNCTION THAT SHOWS FUTURE POST IN THE EVENTS */
/*
function custom_event_query($query) {
	if ( $query->is_category('events-category') )
	{
	$query->set( 'post_status', array('future', 'publish') );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'custom_event_query' );
*/

///////
add_filter('the_posts', 'show_future_posts');

function show_future_posts($posts)
{
   global $wp_query, $wpdb;

   if(is_single() && $wp_query->post_count == 0)
   {
      $posts = $wpdb->get_results($wp_query->request);
   }

   return $posts;
}
?>
