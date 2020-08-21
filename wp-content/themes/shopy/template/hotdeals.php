<?php
/*
	Template Name:Hot-Deals
*/
	get_header();
?>
<?php //echo do_shortcode('[products id="all" columns="3" orderby="title" order="ASC"]');?>

<section class="Mainproduct">
	<div class="container">
		<div class="left-menu">
			<div class="left-menu-padding categories">
				<div class="left-menu-heading">
					<h3>Categories</h3>
				</div>
				<ul>
					<?php
                        $orderby = 'name';
                        $order = 'asc';
                        $hide_empty = false ;
                        $cat_args = array(
                            'orderby'    => $orderby,
                            'order'      => $order,
                            'hide_empty' => $hide_empty,
                        );
                        $product_categories = get_terms( 'product_cat', $cat_args );     
                        if( !empty($product_categories) ){
                            foreach ($product_categories as $key => $category) {
                                if($category->name == "uncategorized") { continue; }
                                echo '<li><a href="'.get_term_link($category).'" >';
                                echo $category->name;
                                echo '</a></li>';
                            }
                        }
                    ?>
				</ul>
			</div>
			<?php
                $attribute_nameibute_taxonomies = wc_get_attribute_taxonomies();
                $taxonomy_terms = array();
                if ( $attribute_taxonomies ) :
                    foreach ($attribute_taxonomies as $tax) :
                    if (taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))) :
                        $taxonomy_terms[$tax->attribute_name] = get_terms( wc_attribute_taxonomy_name($tax->attribute_name), 'orderby=name&hide_empty=0' );
                    endif;
                endforeach;
                endif;
            ?>
			<div class="left-menu-padding price-filter">
				<div class="left-menu-heading">
					<h3>Price Filter</h3>
					<?php echo do_shortcode('[woof_price_filter type="slider"]');?>
				</div>
				<!-- <div class="prize-range">
					<label>From</label>
					<input type="text" name="from">
					<label>To</label>
					<input type="text" name="to">
				</div> -->
			</div>
			<div class="left-menu-padding sizes">
				<div class="left-menu-heading">
					<h3>Sizes</h3>
				</div>
				<ul>
					<?php echo do_shortcode("[woof tax_only='pa_size' by_only='by_sku']");?>
				</ul>
			</div>
			<div class="left-menu-padding brands">
				<div class="left-menu-heading">
					<h3>Brands</h3>
				</div>
				<ul>
					<?php echo do_shortcode("[woof tax_only='pa_brand' by_only='by_sku']");?>
				</ul>
			</div>
		</div>

		<div class="right-product">
			<div class="card">
					<?php
                        $param =[];
                        $params['posts_per_page'] = 9;
                        $params['post_type'] = "product";
                        $params['product_cat'] = "hot-deals";
                    if(isset($_GET['min_price']) && isset($_GET['max_price'])):
                        $min = $_GET['min_price'];
                        $max = $_GET['max_price'];
                        $params['meta_query']['relation']  =  'AND';
                        $params['meta_query'][] =  array(
                                                        'key' => '_price',
                                                        'value' => array( $min, $max ),
                                                        'type' => 'numeric',
                                                        'compare' => 'BETWEEN'
                                                        );
                        //print_r($params);
                    endif;
                    if(isset($_GET['pa_size'])):
                        $pasiz = $_GET['pa_size'];
                        $pasize = explode(', ', $pasiz);
                        $params['tax_query']['relation']  =  'AND';
                        $params['tax_query'][] =  array(
                                                        'taxonomy' => 'pa_size',
                                                        'field'    => 'slug',
                                                        'terms'    => $pasize
                                                        );
                        //print_r($params);
                    endif;
                    if(isset($_GET['pa_brand'])):
                        $pabran = $_GET['pa_brand'];
                        $pabrand = explode(', ', $pabran);
                        $params['tax_query']['relation']  =  'AND';
                        $params['tax_query'][] =  array(
                                                        'taxonomy' => 'pa_brand',
                                                        'field'    => 'slug',
                                                        'terms'    => $pabrand
                                                        );
                        //print_r($params);
                    endif;
                        //$params = array('posts_per_page' => '6','post_type' => 'product','product_cat' => 'hot-deals');
                        $wc_query = new WP_Query($params);
                        if ($wc_query->have_posts()) : 
                            while ($wc_query->have_posts()) :
                                $wc_query->the_post();?>
									<div class="card-inner display-33">
										<div class="cloth-detail hot-deals-detail">
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
			<a href="#" title="Products">
				<div></div>
				<div></div>
				<div></div>
			</a>
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
	get_footer();
?>
