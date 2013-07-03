<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?>				
				</div><!-- #content -->
					<div class="thankyou">
					<h4>
						A SPECIAL THANKS TO OUR DONORS
					</h4>
					<p>
						We appreciate all of our supporters who choose to improve the lives of women, men, and families in Haiti. Mesi anpil. 
					</p>
				</div> <!-- THANK YOU -->
			</div> <!-- wrapper -->

		</div><!-- #container -->
		<footer id="main_footer" role="contentinfo">
				
				<?php
					/* A sidebar in the footer? Yep. You can can customize
					* your footer with four columns of widgets.
					*/
					get_sidebar( 'footer' );
				?>
				<nav role="navigation">
					<?php
						/* Custom Footer Menu */
						wp_nav_menu(array('theme_location' => 'footer-menu'));
					?>
				</nav>

				<div id="ijdh_info" >
					<div itemscope itemtype="http://schema.org/Organization" class="vcard">

					<p>&copy; <strong><span itemprop="name" class="nickname">IJDH.ORG</span></strong> &#47; ALL RIGHTS RESERVED</p>

					<p><strong class="fn">Institute for Justice and Democracy in Haiti</strong> <br /><div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="adr"> <span itemprop="streetAddress" class="street-address" >Dorchester Avenue</span> <br /> <span itemprop="addressLocality" class="locality">Boston, MA</span>   <span itemprop="postalCode" class="postal-code">02127</span></div></p>
					</div>
				</div>

		</footer><!-- footer -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>

	</body>
</html>