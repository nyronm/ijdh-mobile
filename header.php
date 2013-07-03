<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="container">
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		
    <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
    
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true); 
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>" />
		<title><?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 * We filter the output of wp_title() a bit -- see
			 * boilerplate_filter_wp_title() in functions.php.
			 */
	   		if(is_home()){
		   		bloginfo('name');
	   		} elseif (is_category()){
		   		single_cat_title(); echo ' - ' ; bloginfo('name');
	   		} elseif (is_single()){
		   		$customField =get_post_custom_values("title");
		   		if(isset($customField[0])){
			   		echo $customField[0];
		   		} else{
			   		single_post_title();
		   		}
	   		} elseif(is_page()){
		   		bloginfo('name'); echo ': '; single_post_title();
	   		} else {
		   		wp_title('', true);
	   		}			
		?>
		</title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="profile" href="http://microformats.org/profile/hcard">
<?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
?>
	</head>
	<body <?php body_class(); ?>>
    <!--Google Analytics Tracking -->
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-13170107-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
    
    
	 <!-- =========== SOCIAL MEDIA TESTING BEGIN =========== -->
  <div id="fb-root"></div>
	<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <!-- =========== SOCIAL MEDIA TESTING END =========== -->
		<header role="banner">
			<h1>
				<a href="<?php  bloginfo( 'url' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="Institute for Justice and Democracy in Haiti"> </a>
			</h1><!--  IJDH LOGO  -->
						<ul class="utility">
                <li>
                    
                       <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51596b567b94924c"></script>
<!-- AddThis Button END -->
                   </li>
                   <li style="margin-top:6px;">
                    <?php get_search_form( $echo ); ?>
                </li>
             </ul> <!-- SOCIAL MEDIA --> 
             <div style="clear:right;"></div>
             <ul id="donate">
                <li>
                    <h3>
                    <a href="https://app.etapestry.com/hosted/InstituteforJusticeandDemo/OnlineDonation.html?p=d">DONATE TO IJDH</a>
                    </h3>
                    <p>Help us fight for justice in Haiti&#33;</p>
                </li>
             </ul>     <!-- TAKE ACTION  -->
             <div class="clearfix"></div>
			<nav id="access" class="clearfix" role="navigation">
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #access -->
		</header>

		<div id="container" class="clearfix">
			<div id="wrapper" class="clearfix">
				<div id="content" role="main">
