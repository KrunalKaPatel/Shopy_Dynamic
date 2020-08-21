<?php
/*
	Template Name:Home
*/
	get_header();
?>

<!-- Banner Section -->
<section class="banner-bg">
	<div class="banner-slider-section">
		<div class="banner-slider">
			<?php
				if( have_rows('banner_slider') ):
				    while( have_rows('banner_slider') ) : the_row(); ?>
				    	<?php
                            $params = array('post_type' => 'product','product_cat' => 'hot-deals');
                            $wc_query = new WP_Query($params);
                            if ($wc_query->have_posts()) : 
                                while ($wc_query->have_posts()) :
                                    $wc_query->the_post();?>
								       	<div class="item">
											<div class="banner-img">
												<figure>
                                                    <?php
                                                        $attachment_ids = $product->get_gallery_image_ids(); 
                                                        foreach( $attachment_ids as $attachment_id ): ?>
                                                        	<img src="<?php echo wp_get_attachment_image_url($attachment_id,'full'); ?>" alt="banner images">
                                                    <?php endforeach; ?>
												</figure>
												<div class="container">
													<div class="detail">
														<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
														<p> <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry</span> </p>
														<div class="Price-tag">
															<h6>Price: <?php echo $product->get_sale_price(); ?><i class="fa <?php the_field('dollar_icon','options');?>"></i></h6>
															<a href="#" title="Add To Cart">
															<i class="fa <?php the_field('cart_icon','options'); ?> active"></i>
															</a>
															<?php $link = get_sub_field('slider_order_btn');?>
															<a href="<?php echo esc_url($link['url']);?>"><?php echo esc_html($link['title']);?></a>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php
                                endwhile;
                                    wp_reset_postdata();
                            endif; 
                        ?>
						<?php
				    endwhile;
				endif;
			?>
		</div>
	</div>
</section>
<!-- End Banner Section -->

<?php
if( have_rows('manage_content') ):
    while ( have_rows('manage_content') ) : the_row();
        if( get_row_layout() == 'arrivals_section' ): ?>
        	<!-- New Arrival Section -->
			<section class="arrival-bg">
				<div class="container">
					<div class="main-header">
						<h3><?php the_sub_field('section_title');?></h3>
						<p><?php the_sub_field('section_subtitle');?></p>
					</div>
					<div class="cloth-collection">
						<div class="card">
							<?php
                                $params = array('posts_per_page' => '4','post_type' => 'product','product_cat' => 'new-arrivals');
                                $wc_query = new WP_Query($params);
                                if ($wc_query->have_posts()) : 
                                    while ($wc_query->have_posts()) :
                                        $wc_query->the_post();?>
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
																<!--<ul>
																	<?php
										                            $size_taxonomy = $taxonomy_terms["color"];
										                            foreach ($size_taxonomy as $key => $value) {
										                                foreach ($value as $k => $v) {
										                                    if($k == "name") {
										                                        $color_name = strtolower($v);
										                                        echo '<li><a href="#">';
										                                        echo $v;
										                                        echo '</a></li>';
										                                    }
										                                }
										                            }
										                            ?>
																</ul> -->
															</div>
														</div>
														<?php
															if ( is_user_logged_in() ) { ?>
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
														<?php 
															} 
														?>

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

			<!-- Three dots Section -->
			<section class="three-dots-bg">
				<div class="container">
					<div class="three-dots">
						<?php $link = get_field('load_more_link','options'); ?>
						<a href="<?php echo esc_url($link['url']);?>" title="Products">
							<div></div>
							<div></div>
							<div></div>
						</a>
					</div>
				</div>
			</section>

			<!-- Sales Section -->
			<section class="sales-bg">
				<div class="container">
					<?php
                        $params = array('posts_per_page' => '1','post_type' => 'product','product_cat' => 'hot-deals');
                        $wc_query = new WP_Query($params);
                        if ($wc_query->have_posts()) : 
                            while ($wc_query->have_posts()) :
                                $wc_query->the_post();?>
									<div class="sales-section">
										<div class="combo">
											<figure>
												<?php $link = get_field('sales_percent','options'); ?>
												<a href="<?php echo esc_url($link['url']);?>">
												<img src="<?php the_sub_field('discount_image');?>" alt="Hot Deals"></a>
											</figure>
											<div class="combo-detail">
												<?php $link = get_field('sales_percent','options'); ?>
												<h3><a href="<?php echo esc_url($link['url']);?>"><?php the_title();?></a></h3>
												<p>Half Jacket + Skiny Trousers + Boot leather</p>
											</div>
										</div>
										<div class="price">
											<?php $link = get_field('cart_link','options'); ?>
											<a class="cart" href="<?php echo esc_url($link['url']);?>" data-product_id="<?php echo $product->get_id();?>">
												<i class="fa <?php the_field('cart_icon','options'); ?>"></i>
											</a>
											<h2><?php echo $product->get_sale_price(); ?><i class="fa <?php the_field('dollar_icon','options');?>"></i></h2>
										</div>
									</div>
								<?php
                                endwhile;
                                    wp_reset_postdata();
                            endif; 
                        ?>

					<div class="adv">
						<img src="<?php the_sub_field('adv_image');?>" alt="Adv Image">
					</div>
				</div>
			</section>

        <?php
        elseif( get_row_layout() == 'sales_section' ):?>

        	<!-- Best Sales Section -->
			<section class="best-sales-bg">

				<div class="container">

					<div class="main-header">

						<h3><?php the_sub_field('section_title');?></h3>

						<p><?php the_sub_field('section_subtitle');?></p>

					</div>

					<div class="best-sales-card">

						<?php

                            $params = array('posts_per_page' => '8','post_type' => 'product','product_cat' => 'best-sales');

                            $wc_query = new WP_Query($params);

                            if ($wc_query->have_posts()) : 

                                while ($wc_query->have_posts()) :

                                    $wc_query->the_post();?>

										<div class="display-33">

											<div class="sale-card">

												<div class="best-sales-img">

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

												<div class="best-sales-detail">

													<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>

													<div class="rating-price">

														<div class="rating">

															<img src="<?php the_sub_field('rating_image');?>" alt="Rating">

														</div>

														<p><?php echo $product->get_regular_price();?><i class="fa <?php the_field('dollar_icon','options');?>"></i></p>

													</div>

													<div class="add-to-cart">
														<?php $link = get_field('cart_link','options'); ?>
														<a class="cart" href="<?php echo esc_url($link['url']);?>" data-product_id="<?php echo $product->get_id();?>">
															<i class="fa <?php the_field('cart_icon','options'); ?>"></i>
															add to cart
														</a>
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
        <?php
        endif;
    endwhile;
endif;
?>

<?php
	get_footer();
?>