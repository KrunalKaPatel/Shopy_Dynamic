<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shopy
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<script>
        var adminurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        var tempurl = '<?php echo get_template_directory_uri(); ?>';
    </script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'shopy' ); ?></a>

<!-- Header Section -->
<header class="pageHeader">
	<!-- Upper Header Section -->
	<div class="upperHeader">
		<div class="container">
			<div class="small-header">

				<!-- Contact -->
				<div class="contact">
					<div class="mail">
						<a href="mailto:info@shopy.com" title="Mail Us">
							<i class="fa <?php the_field('mail_icon','options');?>"></i><?php the_field('mail_text','options');?>
						</a>
					</div>
					<div class="phone">
						<a href="tel:9965553453" title="Contact Us">
							<i class="fa <?php the_field('telephone_icon','options');?>"></i><?php the_field('telephone_text','options');?>
						</a>
					</div>
				</div>

				<!-- Social Links -->
				<div class="social-links">
					<ul>
						<?php
						if( have_rows('social_repeater','options') ):
						    while( have_rows('social_repeater','options') ) : the_row(); ?>
						        <li>
						        	<?php $link = get_sub_field('social_link','options');?>
									<a href="<?php echo esc_url($link['url']);?>">
										<i class="fa <?php the_sub_field('social_icon');?>"></i>
									</a>
								</li>
						<?php
						    endwhile;
						endif;
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- Lower Header Section -->
	<div class="lowerHeader">
		<div class="container">
			<div class="big-header">
				<!-- Site Logo -->
				<div class="logo">
					<figure>
						<a title="Shopy" href="<?php echo site_url(); ?>"><img src="<?php the_field('logo','options'); ?>" alt="logo images"></a>
					</figure>
				</div>

                <div class="big-menu">
					<!-- Menu -->
					<div class="menu">
						<ul>
							<?php  wp_nav_menu(array( 'menu' =>  'sprimary' )); ?>
						</ul>
					</div>
					<!-- Search, User & Cart -->
					<div class="s-u-c">
						<div class="header__right">
                            <div class="header__search search search__open">
                                <a href="#"><i class="fa <?php the_field('search_icon','options'); ?>"></i></a>
                            </div>
                            <div class="header__account">
                                <?php $link = get_field('user_link','options'); ?>
                                <a href="<?php echo esc_url($link['url']);?>">
                                    <i class="fa <?php the_field('user_icon','options'); ?>"></i>
                                </a>
                            </div>
                            <div class="htc__shopping__cart">
                                <?php $link = get_field('cart_link','options'); ?>
                                <a class="cart__menu" href="<?php echo esc_url($link['url']);?>">
                                    <i class="fa <?php the_field('cart_icon','options'); ?>"></i>
                                </a>
                                <a href="#"><span class="htc__qua"><?php echo WC()->cart->get_cart_contents_count(); ?></span></a>
                            </div>
                        </div>
					</div>
                </div>
			</div>
		</div>
	</div>
</header>
<!-- header end -->

<div class="body__overlay"></div>
<!-- Start Offset Wrapper -->
<div class="offset__wrapper">
    <!-- Start Search Popap -->
    <div class="search__area">
        <div class="container" >
            <div class="row" >
                <div class="search__inner">
                    <form action="#" method="get">
                        <input placeholder="Search here... " type="text">
                        <button type="submit"></button>
                    </form>
                    <div class="search__close__btn">
                        <span class="search__close__btn_icon"><i class="fa fa-close"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search Popap -->
    <!-- Start Cart Panel -->
    <div class="shopping__cart">
        <div class="shopping__cart__inner">
            <div class="offsetmenu__close__btn">
                <a href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="shp__cart__wrap">
                <?php 
                    global $woocommerce;
                    $items = $woocommerce->cart->get_cart();
                    foreach($items as $item => $values) { 
                        $_product =  wc_get_product( $values['data']->get_id() );
                ?>
                <div class="shp__single__product">
                    <div class="shp__pro__thumb">
                        <a href="#">
                            <?php
                                $getProductDetail = wc_get_product( $values['product_id'] );
                                echo $getProductDetail->get_image();
                            ?>
                        </a>
                    </div>
                    <div class="shp__pro__details">
                        <h2><a href="<?php the_permalink();?>"><?php echo $_product->get_title(); ?></a></h2>
                        <span class="quantity">QTY: <?php echo $values['quantity']; ?></span>
                        <span class="shp__price">
                            <?php 
                                $price = get_post_meta($values['product_id'] , '_price', true);
                                echo "<i class='fa fa-inr'></i> ".$price."<br>";
                            ?>
                        </span>
                    </div>
                    <div class="remove__btn">
                        <a class="remove_cart_item" href="<?php echo site_url(); ?>" data-product_id = "<?php echo $values['product_id']; ?>"><i class="fa fa-close"></i>
                        </a>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <ul class="shoping__total">
                <li class="subtotal">Subtotal:</li>
                <li class="total__price"><?php echo $woocommerce->cart->get_cart_total(); ?></li>
            </ul>
            <ul class="shopping__btn">
                <li>
                    <?php $link = get_field('header_cart_link','options'); ?>
                    <a href="<?php echo esc_url($link['url']);?>"><?php echo esc_html($link['title']);?></a></li>
                <li class="shp__checkout">
                    <?php $link = get_field('header_checkout_link','options'); ?>
                    <a href="<?php echo esc_url($link['url']);?>"><?php echo esc_html($link['title']);?></a></li>
            </ul>
        </div>
    </div>
    <!-- End Cart Panel -->
</div>
