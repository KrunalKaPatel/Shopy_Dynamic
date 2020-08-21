<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shopy
 */

?>

	<!-- Footer -->
	<footer class="pageFooter">
		<div class="container">
			<div class="footer-logo">
				<figure>
					<a href="<?php echo site_url(); ?>"><img src="<?php the_field('logo','options'); ?>" alt="logo images"></a>
				</figure>
				<p><a href="#"><?php the_field('footer_copyright','options'); ?></a></p>
			</div>
			<div class="footer-links">
				<div class="link display-25">
					<ul>
						<?php
						if( have_rows('footer_list_one','options') ):
						    while( have_rows('footer_list_one','options') ) : the_row(); ?>
						    	<?php $link = get_sub_field('footer_list_item_one','options');?>
								<li><a href="<?php echo esc_url($link['url']);?>"><?php echo esc_html($link['title']);?></a></li>
						    <?php 
						    endwhile;
						endif;
						?>
					</ul>
				</div>
				<div class="link display-25">
					<ul>
						<?php
						if( have_rows('footer_list_two','options') ):
						    while( have_rows('footer_list_two','options') ) : the_row(); ?>
						    	<?php $link = get_sub_field('footer_list_item_two','options');?>
								<li><a href="<?php echo esc_url($link['url']);?>"><?php echo esc_html($link['title']);?></a></li>
						    <?php 
						    endwhile;
						endif;
						?>
					</ul>
				</div>
				<div class="link display-25">
					<ul>
						<?php
						if( have_rows('footer_list_three','options') ):
						    while( have_rows('footer_list_three','options') ) : the_row(); ?>
						    	<?php $link = get_sub_field('footer_list_item_three','options');?>
								<li><a href="<?php echo esc_url($link['url']);?>"><?php echo esc_html($link['title']);?></a></li>
						    <?php 
						    endwhile;
						endif;
						?>
					</ul>
				</div>
				<div class="payment display-25">
					<p><?php the_field('footer_payment_text','options');?></p>
					<figure>
						<img src="<?php the_field('footer_payment','options');?>" alt="Payment">
					</figure>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
