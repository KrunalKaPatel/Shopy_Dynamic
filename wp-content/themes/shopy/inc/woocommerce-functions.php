<?php

/*
    Add to cart home page new arrivals
*/
add_action("wp_ajax_custom_add_to_cart", "custom_add_to_cart");
add_action("wp_ajax_nopriv_custom_add_to_cart", "custom_add_to_cart");

function custom_add_to_cart() {
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        WC_AJAX :: get_refreshed_fragments();
    }
    wp_die();
}

/*
    Add to cart home page best sales
*/
add_action("wp_ajax_product_add_to_cart", "product_add_to_cart");
add_action("wp_ajax_nopriv_product_add_to_cart", "product_add_to_cart");

function product_add_to_cart() {
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        WC_AJAX :: get_refreshed_fragments();
    }
    wp_die();
}


/* 
    remove product from mini cart
*/
add_action('wp_ajax_custom_remove_from_cart', 'custom_remove_from_cart');
add_action('wp_ajax_nopriv_custom_remove_from_cart', 'custom_remove_from_cart');

function custom_remove_from_cart() {
    $product_id = $_POST['product_id'];
    $product_cart_id = WC()->cart->generate_cart_id( $product_id );
    $cart_item_key = WC()->cart->find_product_in_cart( $product_cart_id );
    if ( $cart_item_key ) WC()->cart->remove_cart_item( $cart_item_key );
    wp_die();
}

/*
    Add to cart home page adv section
*/
add_action("wp_ajax_prod_add_to_cart", "prod_add_to_cart");
add_action("wp_ajax_nopriv_prod_add_to_cart", "prod_add_to_cart");

function prod_add_to_cart() {
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        WC_AJAX :: get_refreshed_fragments();
    }
    wp_die();
}

/*
    Add to cart new arrivals page
*/
add_action("wp_ajax_cust_add_to_cart", "cust_add_to_cart");
add_action("wp_ajax_nopriv_cust_add_to_cart", "cust_add_to_cart");

function cust_add_to_cart() {
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        WC_AJAX :: get_refreshed_fragments();
    }
    wp_die();
}



?>