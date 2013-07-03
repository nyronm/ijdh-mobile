<?php
/**
 * Template Name: Contact
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

				<?php
                    $page_id = 66; // Page ID for desired page

                    $page_data = get_page( $page_id ); // You must pass in a variable to the get_page function. If you pass in a value (e.g. get_page ( 123 ); ), WordPress will generate an error. By default, this will return an object.

                    echo '<h1>'. $page_data->post_title .'</h1>';// echo the title

                    echo apply_filters('the_content', $page_data->post_content); // echo the content and retain Wordpress filters such as paragraph tags. Origin from: http://wordpress.org/support/topic/get_pagepost-and-no-paragraphs-problem
                ?>

			<form id="contact_form" action="" method="post">

				<fieldset>

					<label for="name">Name<em>&#42;</em></label>
					<span id="name_info"></span>
					<input type="text" id="name" name="name" tabindex="1"/>

					<label for="email">Email<em>&#42;</em></label>
					<span id="email_info"></span>
					<input type="text" id="email" name="email" tabindex="2"/>

					<label for="message">Comments/Questions?<em>&#42;</em></label>
					<span id="message_info"></span>
					<textarea id="message" name="message" wrap="wrap" rows="5" cols="30" tabindex="3"></textarea>

				</fieldset>

				<button type="submit" id="submit" name="submit" value="submit" tabindex="4">Send</button>
				<span id="msg_sts"></span>

			</form><!-- END FORM -->

        </div><!-- primary -->

        <?php get_sidebar(); ?>

<?php get_footer(); ?>