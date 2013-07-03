<?php
include('advocacy.php');
include('event-widget.php');

// registers footer-menu to create custom navigation for footer
function register_my_menus()
{
    register_nav_menus(
        array('footer-menu' => __('Footer Menu'))
    );
}


// turns menu options on
add_action('init', 'register_my_menus');


remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
// stop setPostViews() from inserting post elsewhere in the loop


// add_theme_support to resize thumbnails
add_theme_support( 'post-thumbnails' );


if ( function_exists( 'add_image_size' ) )
{
    add_image_size('sliding-images', 620, 350, true );
    add_image_size( 'homepage-thumb', 300, 200, true ); //(cropped)
}


////////////////////////////////////////////////////////////////////////////////////////////////

// Custom excerpt for Nivo slider
function slider_excerpt($num)
{
    $limit = $num+1;
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt)."... <a href='" .get_permalink($post->ID) ." '>Read more</a>";
    return $excerpt;
}


// Variable & intelligent excerpt length. (if post has image)
function ijdh_dynamic_excerpt($title)
    { // Max excerpt length. Length is set in characters
    global $post;

    $rem_len = ""; //clear variable
    $title_len = strlen($post->post_title); //get length of title
    $excerpt_line=29;
    if
    ($title_len <= 21)
    {
        $rem_len=$excerpt_line*8; //calc space remaining for excerpt
    }elseif
    ($title_len <= 42)
    {
        $rem_len=$excerpt_line*6;
    }elseif
    ($title_len <= 63)
    {
        $rem_len=$excerpt_line*4;
    }elseif
    ($title_len <= 84)
    {
        $rem_len=$excerpt_line*3;
    }elseif
    ($title_len <= 189)
    {
        $rem_len=$excerpt_line*2; // limits excerpt for long long titles
    }elseif
    ($title_len <= 252)
    {
        $rem_len=$excerpt_line*0; // if title is longer than 189, do not show excerpt because there's no more space.
    }

    $text = $post->post_excerpt;
    if ( '' == $text )
    {
        $text = get_the_content('');
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
    }
    $text = strip_shortcodes($text); // optional, recommended
    $text = strip_tags($text,'<p>'); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

    $text = substr($text,0,$rem_len);
    $excerpt = ijdh_reverse_strrchr($text, '', 1);

    if
    ( $excerpt )
    {
        echo apply_filters('the_excerpt',$excerpt);
    } else
    {
        echo apply_filters('the_excerpt',$text);
    }

}


// Variable & intelligent excerpt length. (if post has no image)
function ijdh_dynamic_excerpt_noImage($title)
    { // Max excerpt length. Length is set in characters
    global $post;

    $rem_len = ""; //clear variable
    $title_len = strlen($post->post_title); //get length of title
    $excerpt_line=75;
    if
    ($title_len <= 21)
    {
        $rem_len=$excerpt_line*8; //calc space remaining for excerpt
    }elseif
    ($title_len <= 42)
    {
        $rem_len=$excerpt_line*7;
    }elseif
    ($title_len <= 63)
    {
        $rem_len=$excerpt_line*6;
    }elseif
    ($title_len <= 84)
    {
        $rem_len=$excerpt_line*4;
    }elseif
    ($title_len <= 126)
    {
        $rem_len=$excerpt_line*3;
    }elseif
    ($title_len <= 210) // limits excerpt for long long titles
    {
        $rem_len=$excerpt_line*2;
    }


    $text = $post->post_excerpt;
    if ( '' == $text )
    {
        $text = get_the_content('');
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
    }
    $text = strip_shortcodes($text); // optional, recommended
    $text = strip_tags($text,'<p>'); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

    $text = substr($text,0,$rem_len);
    $excerpt = ijdh_reverse_strrchr($text, '', 1);

    if
    ( $excerpt )
    {
        echo apply_filters('the_excerpt',$excerpt);
    } else
    {
        echo apply_filters('the_excerpt',$text);
    }

}


/*  If post has image, then shorter ijdh_dynamic_excerpt is executed. If it has no image, then we run longer ijdh_dynamic_excerpt_noImage  */
function ijdh_show_excerpt( $post_id )
{

    //get post image
    global $post;
    $images = get_children( array(
            'post_parent' => $post->ID,
            'post_status' => 'published',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'numberposts' => 999
        ) );

    if ( !$images )
    {
        ijdh_dynamic_excerpt_noImage($title);
    }

    else
    {
        ijdh_dynamic_excerpt($title);

    }


}


// Returns the portion of haystack which goes until the last occurrence of needle
function ijdh_reverse_strrchr($haystack, $needle, $trail)
{
    return strrpos($haystack, $needle) ? substr($haystack, 0, strrpos($haystack,     $needle) + $trail) : false;
}


////////////////////////////////////////////////////////////////////////////////////////////////

// get post views to filter popular posts, by date range. It also excludes admin data.
function ijdh_getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if
    ($count=='')
    {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}// END OF FUNCTION ijdh_getPostViews


function ijdh_setPostViews($postID)
{

    /// if statement to discount post views from Editors or above

    if (!current_user_can('level_7') ) :
        $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if
    ($count=='')
    {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else
    {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
    endif;
}// END OF FUNCTION setPostViews

////////////////////////////////////////////////////////////////////////////////////////////////

// Date range filters for the homepage's blog roll.
function filter_year($where = '')
{
    //posts in the last 30 days
    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-365 days')) . "'";
    return $where;
}


function filter_month($where = '')
{
    //posts in the last 30 days
    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
    return $where;
}


function filter_week($where = '')
{
    //posts in the last 30 days
    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-7 days')) . "'";
    return $where;
}


//END of date range filter functions


////////////////////////////////////////////////////////////////////////////////////////////////

function ijdh_pagination($pages = '', $range = 2)
{
    $showitems = ($range)+1;

    global $paged;
    if
    (empty($paged)) $paged = 1;

    if
    ($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if
        (!$pages)
        {
            $pages = 1;
        }
    }

    if
    (1 != $pages)
    {
        echo "<div class='pagination'>";
        if
        ($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>First &laquo;</a>";
        if
        ($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>Previous &lsaquo;</a>";

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
            }
        }

        if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>Next &rsaquo;</a>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
        echo "</div>\n";
    }
}


////////////////////////////////////////////////////////////////////////////////////////////////


function ijdhNoPosts()
{


    /// If there are no posts to display, such as an empty archive page

    if ( ! have_posts() ) : ?>
		    <article id="post-0" class="post error404 not-found">
		        <h1 class="entry-title"><?php _e( 'Not Found', 'boilerplate' ); ?></h1>
		        <div class="entry-content">
		            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'boilerplate' ); ?></p>
		            <?php get_search_form(); ?>
		        </div><!-- .entry-content -->
		    </article><!-- #post-0 -->
		<?php endif;

}


////////////////////////////////////////////////////////////////////////////////////////////////

function ijdh_getCategory()
{

    //get post category
    $category = get_the_category();
    if
    ($category[0])
    {
        echo '<div class="category_link"><a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a></div>';
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////
 // get taxonomies terms links
function custom_taxonomies_terms_links() {
	global $post, $post_id;
	// get post by post id
	$post = &get_post($post->ID);
	// get post type by post
	$post_type = $post->post_type;
	// get post type taxonomies
	$taxonomies = get_object_taxonomies($post_type);
	foreach ($taxonomies as $taxonomy) {
		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy );
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term )
				$out[0] = '<a href="' .get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a>';
			$return = join( ', ', $out );
		}
	}
	return $return;
} 
////////////////////////////////////////////////////////////////////////////////////////////////

function ijdh_show_feat()
{



    $my_query = new WP_Query('posts_per_page=6 & tag=featured, feature');

    $count = 0;

    while ($my_query->have_posts()) : $my_query->the_post();?>

     <?php
    // Iterate slide_content class name 1, 2, 3,...
    $count ++;

    //get post image
    global $post;
    $images = get_children( array(
            'post_parent' => $post->ID,
            'post_status' => 'published',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'numberposts' => 999
        ) );

    if ( $images ) :
        $total_images = count( $images );
    $image = array_shift( $images );

    $image_img_tag = wp_get_attachment_image( $image->ID, 'sliding-images' );


?>
<?php endif;?>

          <div id="slide_content_<?php echo $count; ?>">
               <a class="slide_image_<?php echo $count; ?>" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>

               <div class="post-info">
                    <h2 class="entry-title">
                         <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'boilerplate' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h2>
                    <!-- <?php ijdh_show_excerpt($postID); ?> -->
               </div><!-- .post-info -->
          </div><!-- .slide_content -->


     <?php endwhile;

}


function ijdh_show_thumb()
{


    //get post image
    global $post;
    $images = get_children( array(
            'post_parent' => $post->ID,
            'post_status' => 'published',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'numberposts' => 999
        ) );

    if ( $images ) :
        $total_images = count( $images );
    $image = array_shift( $images );

    $image_img_tag = wp_get_attachment_image( $image->ID, 'homepage-thumb' );


?>
<?php endif;?>

          <div class="gallery-thumb">
             <a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
          </div><!-- .gallery-thumb -->
          <?php
}


////////////////////////////////////////////////////////////////////////////////////////////////

function ijdh_MostRecent()
{

    ijdhNoPosts();

    /// Start the Loop
    while ( have_posts() ) : the_post(); ?>

		<!-- Displays most recent posts with thumbnail and excerpt. -->

               <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	      <?php
    ijdh_getCategory ();
    ijdh_show_thumb();
?>
                    <div class="entry-content">

                         <h2 class="entry-title">
                              <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'boilerplate' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                         </h2>

                         <?php ijdh_show_excerpt($postID); ?>

                    </div><!-- .entry-content -->

                    <div class="entry-utility">
                         <?php edit_post_link( __( 'Edit', 'boilerplate' ), '' ); ?>
                    </div><!-- .entry-utility -->

               </li><!-- #post-## -->

          <?php endwhile; wp_reset_query(); ?>

		 <!-- Display navigation to next/previous pages when applicable -->

<?php ijdh_pagination();

}// END OF FUNCTION home_loop

///////////////////////////////////////////////////////////////////////////////////////////////////


// PopularAlltime loop gets all posts ordered by # views. Displays the category, thumbnail image, title and excerpt for each post.
function ijdh_PopularAlltime()
{

    ijdhNoPosts();

    /// Start the Loop
    query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&post_type=any');

    while ( have_posts() ) : the_post(); ?>

		<!-- Displays most recent posts with thumbnail and excerpt. -->

               <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	      <?php
    ijdh_getCategory ();
    ijdh_show_thumb();
?>
                    <div class="entry-content">

                         <h2 class="entry-title">
                              <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'boilerplate' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                         </h2>

                         <?php ijdh_show_excerpt($postID); ?>

                    </div><!-- .entry-content -->

                    <div class="entry-utility">
                         <?php edit_post_link( __( 'Edit', 'boilerplate' ), '' ); ?>
                    </div><!-- .entry-utility -->

               </li><!-- #post-## -->

          <?php endwhile; wp_reset_query(); ?>

		 <?php ijdh_pagination();

} /// END PopularAlltime

///////////////////////////////////////////////////////////////////////////////////////////////////

// PopularbyWeek loop gets all posts in the last 7 days, ordered by # views. Displays the category, thumbnail image, title and excerpt for each post.
function ijdh_PopularbyWeek()
{

    ijdhNoPosts();

    /// Start the Loop

    add_filter('posts_where', 'filter_week');
    query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&post_type=any');

    while ( have_posts() ) : the_post(); ?>

		<!-- Displays most recent posts with thumbnail and excerpt. -->

               <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	      <?php
    ijdh_getCategory ();
    ijdh_show_thumb();
?>
                    <div class="entry-content">

                         <h2 class="entry-title">
                              <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'boilerplate' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                         </h2>

                         <?php ijdh_show_excerpt($postID); ?>

                    </div><!-- .entry-content -->

                    <div class="entry-utility">
                         <?php edit_post_link( __( 'Edit', 'boilerplate' ), '' ); ?>
                    </div><!-- .entry-utility -->

               </li><!-- #post-## -->

          <?php endwhile; wp_reset_query(); ?>

    <?php remove_filter( 'posts_where', 'filter_week' ); ?>

    <?php ijdh_pagination();

}/// END ijdh_PopularbyWeek


// ijdh_PopularbyMonth loop gets all posts in the last 30 days, ordered by # views. Displays the category, thumbnail image, title and excerpt for each post.
function ijdh_PopularbyMonth()
{

    ijdhNoPosts();

    /// Start the Loop

    add_filter('posts_where', 'filter_month');
    query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC');

    while ( have_posts() ) : the_post(); ?>

		<!-- Displays most recent posts with thumbnail and excerpt. -->

               <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	      <?php
    ijdh_getCategory ();
    ijdh_show_thumb();
?>
                    <div class="entry-content">

                         <h2 class="entry-title">
                              <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'boilerplate' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                         </h2>

                         <?php ijdh_show_excerpt($postID); ?>

                    </div><!-- .entry-content -->

                    <div class="entry-utility">
                         <?php edit_post_link( __( 'Edit', 'boilerplate' ), '' ); ?>
                    </div><!-- .entry-utility -->

               </li><!-- #post-## -->

          <?php endwhile; wp_reset_query(); ?>


        <?php remove_filter( 'posts_where', 'filter_month' ); ?>

		<?php ijdh_pagination();

}/// END ijdh_PopularbyMonth


// ijdh_PopularbyYear loop gets all posts in the last year, ordered by # views. Displays the category, thumbnail image, title and excerpt for each post.
function ijdh_PopularbyYear()
{

    ijdhNoPosts();

    /// Start the Loop

    add_filter('posts_where', 'filter_year');
    query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC');

    while ( have_posts() ) : the_post(); ?>

		<!-- Displays most recent posts with thumbnail and excerpt. -->

               <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

         		      <?php
    //get post category
    $category = get_the_category();
    if
    ($category[0])
    {
        echo '<div class="category_link"><a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a></div>';
    }


    //get post image
    global $post;
    $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );

    $total_images = count( $images );
    $image = array_shift( $images );
    $image_img_tag = wp_get_attachment_image( $image->ID, 'homepage-thumb' );
?>

                    <!-- display post image -->
                    <div class="gallery-thumb">
                       <a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
                    </div><!-- .gallery-thumb -->

                    <!-- <?php echo get_the_ID( ); ?>  -->

                    <div class="entry-content">

                         <h2 class="entry-title">
                              <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'boilerplate' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                         </h2>

                         <?php ijdh_show_excerpt($postID);?>

                    </div><!-- .entry-content -->

                    <div class="entry-utility">
                         <?php edit_post_link( __( 'Edit', 'boilerplate' ), '' ); ?>
                    </div><!-- .entry-utility -->

               </li><!-- #post-## -->

          <?php endwhile; wp_reset_query(); ?>


        <?php remove_filter( 'posts_where', 'filter_year' ); ?>

		<?php ijdh_pagination();
}/// END ijdh_PopularbyYear

////////////////////////////////////////////////////////////////////////////////////////////////



function include_nivo_scripts()
{
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js');
    wp_register_script( 'custom-scripts', get_bloginfo('stylesheet_directory')."/js/scripts.js");
    wp_register_script( 'plugin', get_bloginfo('stylesheet_directory')."/js/plugins.js");
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-scripts');
    wp_enqueue_script('plugin');
}


add_action('wp_enqueue_scripts', 'include_nivo_scripts');

// advocacy excerpt function
function the_advocacy_excerpt( $length ) {
	return 140;
}
add_filter( 'excerpt_length', 'the_advocacy_excerpt', 999 );
////////////////////////////////////////////////////////

?>