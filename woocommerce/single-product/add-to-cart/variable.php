<?php
defined('ABSPATH') || exit;

global $product;

$attribute_keys  = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);

do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="variations_form cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>" data-product_variations="<?php echo $variations_attr; ?>">
    
    <?php do_action('woocommerce_before_variations_form'); ?>

    <?php if (empty($available_variations) && false !== $available_variations) : ?>
        <p class="stock out-of-stock"><?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))); ?></p>
    <?php else : ?>

        <!-- 🔽 ADDITION: Purchase Mode Selection -->
        <div class="purchase-mode">
            <strong>Choose Purchase Mode:</strong><br>
            <label><input type="radio" name="purchase_mode" value="single" checked> Single Drink Subscription</label>
            <label style="margin-left:20px;"><input type="radio" name="purchase_mode" value="double"> Double Drink Subscription</label>
        </div>

        <!-- 🔽 ADDITION: What’s Included Box -->
        <div class="whats-included-box" style="margin-top: 1em; background:#f7f7f7; padding:1em; border:1px solid #ddd;">
            <strong>What’s Included:</strong>
            <ul id="inclusion-list">
                <li>1x Protein Sachet</li>
                <li>1x Free Shaker</li>
                <li>One Time Delivery</li>
            </ul>
        </div>

        <!-- 🔽 WooCommerce Default Flavor Selectors -->
        <table class="variations" cellspacing="0" role="presentation">
            <tbody>
                <?php foreach ($attributes as $attribute_name => $options) : ?>
                    <tr>
                        <th class="label"><label for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>"><?php echo wc_attribute_label($attribute_name); ?></label></th>
                        <td class="value">
                            <?php
                            wc_dropdown_variation_attribute_options([
                                'options'   => $options,
                                'attribute' => $attribute_name,
                                'product'   => $product,
                            ]);
                            echo end($attribute_keys) === $attribute_name
                                ? wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<a class="reset_variations" href="#">Clear</a>'))
                                : '';
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- 🔽 Custom price logic -->
        <div class="custom-pricing-box" style="margin-top:1em;">
            <p>
                <span class="regular-price" style="text-decoration:line-through;"></span>
                <span class="discounted-price" style="font-weight:bold; color:green;"></span>
            </p>
        </div>

        <?php do_action('woocommerce_after_variations_table'); ?>

        <div class="single_variation_wrap">
            <?php
            do_action('woocommerce_before_single_variation');
            do_action('woocommerce_single_variation');
            do_action('woocommerce_after_single_variation');
            ?>
        </div>
    <?php endif; ?>

    <?php do_action('woocommerce_after_variations_form'); ?>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>
