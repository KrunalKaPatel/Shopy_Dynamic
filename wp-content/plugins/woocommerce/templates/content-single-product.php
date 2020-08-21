<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div class="product-details">
	<div class="container">
		<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>

			<div class="summary entry-summary">
				<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				//do_action( 'woocommerce_single_product_summary' );
				?>
				<div class="card-inn">
					<div class="title">
						<?php the_title( '<h1 class="product_title entry-title">', '</h1>' );?>
					</div>
					<div class="desc">
						<?php the_excerpt();?>
					</div>
					<hr>
					<?php
	                    $attribute_taxonomies = wc_get_attribute_taxonomies();
	                    $taxonomy_terms = array();
	                    if ( $attribute_taxonomies ) :
	                        foreach ($attribute_taxonomies as $tax) :
	                        if (taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))) :
	                            $taxonomy_terms[$tax->attribute_name] = get_terms( wc_attribute_taxonomy_name($tax->attribute_name), 'orderby=name&hide_empty=0' );
	                        endif;
	                    endforeach;
	                    endif;
	                ?>
					<div class="row">
						<div class="size">
							<h3><?php the_field('size_title','options');?>:</h3>
							<div class="cloth-hover">
								<ul>
									<?php
		                            $size_taxonomy = $taxonomy_terms["size"];
		                            foreach ($size_taxonomy as $key => $value) {
		                                foreach ($value as $k => $v) {
		                                    if($k == "name") {
		                                        $color_name = strtolower($v);
		                                        echo '<li><a href="javascript:void(0)">-';
		                                        echo $v;
		                                        echo '</a></li>';
		                                    }
		                                }
		                            }
		                            ?>
								</ul>
							</div>
						</div>
						<div class="qty">
							<h3><?php the_field('quantity_title','options');?></h3>
							<div class="qtys">
								<?php wc_get_template('single-product/add-to-cart/simple.php');?>
							</div>
						</div>
					</div>
					<hr>

					<div class="row">
						<div class="price">
							<h2>Price:</h2> <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_sale_price(); ?><i class="fa <?php the_field('dollar_icon','options');?>"></i></p>
						</div>
						<div class="icon-list">
							<div class="cloth-list">
								<ul class="product__action">
									<li>
										<a href="#" title="Share">
											<i class="fa <?php the_field('share_icon','options'); ?>"></i>
										</a>
									</li>
									<?php $link = get_field('cart_link','options'); ?>
									<li>	
										<a class="cart" href="<?php echo esc_url($link['url']);?>" data-product_id="<?php echo $product->get_id();?>">
											<i class="fa <?php the_field('cart_icon','options'); ?>"></i>
										</a>
									</li>
									<li><a>
										<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]');?></a> 
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php
			/**
			 * Hook: woocommerce_after_single_product_summary.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			//do_action( 'woocommerce_after_single_product_summary' );
			?>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>

<!-- New Arrival Section -->
<section class="arrival-bg">
	<div class="container">
		<div class="main-header">
			<h3><?php the_field('section_title','options');?></h3>
			<p><?php the_field('section_subtitle','options');?></p>
		</div>
		<div class="cloth-collection">
			<div class="card">
				<?php
                    $params = array('posts_per_page' => '4','post_type' => 'product','product_cat' => 'new-arrivals','order' => 'ASC','orderby' => 'name');
                    $wc_query = new WP_Query($params);
                        if ($wc_query->have_posts()) : 
                            while ($wc_query->have_posts()) :
                                $wc_query->the_post();
                                global $product;
                                ?>
								<div class="card-inner display-25">
									<div class="cloth-detail">
										<div class="cloth-img">
											<figure>
												<a href="<?php the_permalink(); ?>">
                                                    <?php
                                                    $attachment_ids = $product->get_gallery_image_ids(); 
                                                    foreach( $attachment_ids as $attachment_id ): ?>
                                                    	<img src="<?php echo wp_get_attachment_image_url($attachment_id,'full'); ?>" alt="product images">
                                                    <?php endforeach; ?>
                                                </a>
											</figure>
										</div>
										<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
										<div class="prize">
											<p><?php echo $product->get_sale_price(); ?><i class="fa <?php the_field('dollar_icon','options');?>"></i></p>
										</div>
										<?php
					                        $attribute_taxonomies = wc_get_attribute_taxonomies();
					                        $taxonomy_terms = array();
					                        if ( $attribute_taxonomies ) :
					                            foreach ($attribute_taxonomies as $tax) :
					                            if (taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))) :
					                                $taxonomy_terms[$tax->attribute_name] = get_terms( wc_attribute_taxonomy_name($tax->attribute_name), 'orderby=name&hide_empty=0' );
					                            endif;
					                        endforeach;
					                        endif;
					                    ?>
										<div class="cloth-hover">
											<div class="size-color">
												<div class="cloth-size">
													sizes&nbsp;&nbsp;: 
													<ul>
														<?php
								                            $size_taxonomy = $taxonomy_terms["size"];
								                            foreach ($size_taxonomy as $key => $value) {
								                                foreach ($value as $k => $v) {
								                                    if($k == "name") {
								                                        $color_name = strtolower($v);
								                                        echo '<li><a href="javascript:void(0)">-';
								                                        echo $v;
								                                        echo '</a></li>';
								                                    }
								                                }
								                            }
							                            ?>
													</ul>
												</div>
												<div class="cloth-color">
													<ul>
														<li><a href="#" title="Red"></a></li>
														<li><a href="#" title="Vilote"></a></li>
														<li><a href="#" title="Light Blue"></a></li>
														<li><a href="#" title="Light Green"></a></li>
													</ul>
												</div>
											</div>
											<div class="cloth-list">
												<ul class="product__action">
													<li>
														<a href="#" title="Share">
															<i class="fa <?php the_field('share_icon','options'); ?>"></i>
														</a>
													</li>
													<?php $link = get_field('cart_link','options'); ?>
													<li>	
														<a class="cart" href="<?php echo esc_url($link['url']);?>" data-product_id="<?php echo $product->get_id();?>">
															<i class="fa <?php the_field('cart_icon','options'); ?>"></i>
														</a>
													</li>
													<li><a>
														<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]');?></a> 
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							<?php
                            endwhile;
                                wp_reset_postdata();
                        endif; 
                    ?>
			</div>
		</div>
	</div>
</section>


<!-- Join-us Section -->
<section class="join-bg">
	<div class="container">
		<div class="news-mail">
			<div class="news">
				<h3><?php the_field('news_letter','options');?></h3>
				<p><?php the_field('news_letter_desc','options');?></p>
			</div>
			<div class="mail">
				<a href="mailto:info@shopy.com">
					<i class="fa <?php the_field('mail_icon','options');?>" title="Mail Us"></i>
				</a>
				<form>
					<input type="email" name="email" placeholder="type your email here" required>
					<input type="submit" name="submit" value="join us">
				</form>
			</div>
		</div>
	</div>
</section>