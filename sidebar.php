<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 */
?>
            <div id="sidebar">
                
        
        <!-- =========== EVENTS SECTION =========== -->
                <?php
                // A second sidebar for widgets, just because.
                if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>

                    <ul class="xoxo">
                    <?php dynamic_sidebar( 'secondary-widget-area' ); ?>
                    </ul>

                <?php endif; ?>
            
                
                <!-- =========== SOCIAL MEDIA SECTION =========== -->

                <div id="twitter" class="social_chnls">
          <h3><a href="http://twitter.com/ijdh" target="_blank">Twitter @ijdh</a></h3>
          <!-- <ul id="twitter_update_list"></ul><!-- Tweets will be loaded here --> 
          <ul id="twitter_update_list">
          <a class="twitter-timeline" href="https://twitter.com/ijdh/favorites" data-widget-id="347910040058994689" data-tweet-limit="4">Favorite Tweets by @ijdh</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

          </ul>
                </div>
                <!-- end #twitter -->

                <div id="facebook-widget" class="social_chnls">
                    <h3><a href="http://www.facebook.com/IJDH1" target="_blank">Facebook</a></h3>
                    <div class="fb-like" data-href="http://www.facebook.com/IJDH1" data-send="false" data-layout="button_count" data-width="250" data-show-faces="false"></div>
                    <iframe frameborder="0" scrolling="no" style="border-color:#FFF; overflow:hidden; width:300px; height:295px;" src="http://www.facebook.com/plugins/activity.php?site=ijdh.org&width=300&height=323&header=false&colorscheme=light&font&border_color=%23F5F5F5&font=arial&recommendations=false"></iframe>
                </div><!-- end #facebook-widget -->
        
        <div id="flickr" class="social_chnls">
                    <h3><a href="http://www.flickr.com/photos/haitijustice/" target="_blank">Flickr</a></h3>
                    <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?display=latest&count=8&source=user&user=51059788@N06&size=s"></script><!-- count=a number 1-10 Number of images to show -->
                </div><!-- end #flickr -->
                

            </div> <!-- END OF SIDEBAR -->
        </div> <!-- END OF CONTENT DIV -->