<?php
add_action('wp_ajax_add_double_flavor_to_cart', 'add_double_flavor_to_cart');
add_action('wp_ajax_nopriv_add_double_flavor_to_cart', 'add_double_flavor_to_cart');
function add_double_flavor_to_cart() {
    $product_id = intval($_POST['product_id']);
    $attributes = isset($_POST['attributes']) ? $_POST['attributes'] : [];

    $product = wc_get_product($product_id);
    if (!$product || !$product->is_type('variable')) {
        wp_send_json_error('Invalid product.');
    }

    foreach ($product->get_available_variations() as $variation) {
        $match = true;
        foreach ($attributes as $key => $value) {
            if (!isset($variation['attributes'][$key]) || $variation['attributes'][$key] != $value) {
                $match = false;
                break;
            }
        }
        if ($match) {
            $added = WC()->cart->add_to_cart($product_id, 1, $variation['variation_id'], $attributes);
            if ($added) {
                wp_send_json_success('Added to cart');
            }
        }
    }

    wp_send_json_error('Could not add to cart. Flavor mismatch.');
}