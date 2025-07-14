<?php
defined('ABSPATH') || exit;

global $product;

$attribute_keys = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);
$gallery_ids = $product->get_gallery_image_ids();
$flavor_labels = ['Chocolate', 'Vanilla', 'Orange'];

do_action('woocommerce_before_add_to_cart_form');
?>

<div class="custom-variable-product-ui">

  <!-- Product Description & Review Stars -->
  <div class="product-header-card">
    <h2><?php echo esc_html($product->get_title()); ?></h2>
    <div class="product-description"><?php echo wpautop($product->get_short_description()); ?></div>
    <div class="product-rating">
      <?php
      $average = $product->get_average_rating();
      for ($i = 1; $i <= 5; $i++) {
        echo '<span class="star' . ($i <= $average ? ' filled' : '') . '">&#9733;</span>';
      }
      ?>
      <span class="rating-value"><?php echo number_format($average, 1); ?>/5</span>
    </div>
  </div>

  <form class="variations_form cart"
        id="custom-variable-form"
        action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
        method="post" enctype='multipart/form-data'
        data-product_id="<?php echo absint($product->get_id()); ?>"
        data-product_variations="<?php echo $variations_attr; ?>">

    <!-- Hidden WooCommerce select for Single Subscription -->
    <table class="variations" id="single-variation-select" cellspacing="0" style="position:absolute;left:-9999px;opacity:0;height:0;overflow:hidden;">
      <tbody>
        <?php foreach ($attributes as $attribute_name => $options): ?>
        <tr>
          <td class="value">
            <?php
            wc_dropdown_variation_attribute_options([
              'options'   => $options,
              'attribute' => $attribute_name,
              'product'   => $product,
            ]);
            ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Hidden WooCommerce select for Double Subscription Flavor 1 -->
    <table class="variations" id="double-variation-select-1" cellspacing="0" style="position:absolute;left:-9999px;opacity:0;height:0;overflow:hidden;">
      <tbody>
        <?php foreach ($attributes as $attribute_name => $options): ?>
        <tr>
          <td class="value">
            <?php
            wc_dropdown_variation_attribute_options([
              'options'   => $options,
              'attribute' => $attribute_name,
              'product'   => $product,
            ]);
            ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Hidden WooCommerce select for Double Subscription Flavor 2 -->
    <table class="variations" id="double-variation-select-2" cellspacing="0" style="position:absolute;left:-9999px;opacity:0;height:0;overflow:hidden;">
      <tbody>
        <?php foreach ($attributes as $attribute_name => $options): ?>
        <tr>
          <td class="value">
            <?php
            wc_dropdown_variation_attribute_options([
              'options'   => $options,
              'attribute' => $attribute_name,
              'product'   => $product,
            ]);
            ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Recommended Badge -->
    <div class="recommended-badge">
      <span>Recommended</span>
    </div>

    <!-- Single Subscription Card -->
    <div id="single-subscription-card" class="subscription-card active">
      <div class="card-header">
        <label class="toggle-radio">
        <input type="radio" name="purchase_mode" value="single" checked>
        <span>Single Drink Subscription</span>
        </label>
        <div class="price-container">
          <span class="discounted-price">$6</span>
          <span class="original-price">$10</span>
        </div>
      </div>
      
      <div class="card-body">
        <div class="flavor-section">
            <h3>Choose Flavor</h3>
            <div class="flavor-toggle-row">
                <?php foreach ($gallery_ids as $idx => $img_id): ?>
                <?php 
                $img_url = wp_get_attachment_image_url($img_id, 'large');
                $is_best_seller = ($flavor_labels[$idx] === 'Chocolate'); // Check if current flavor is Chocolate
                ?>
                <div class="flavor-toggle-container <?php echo $is_best_seller ? 'best-seller-container' : ''; ?>">
                    <label class="flavor-toggle">
                    <input type="radio" class="single-flavor" name="attribute_flavor" value="<?php echo esc_attr($flavor_labels[$idx]); ?>" <?php echo $idx === 0 ? 'checked' : ''; ?>>
                    <img src="<?php echo esc_url($img_url); ?>" class="flavor-img" />
                    <div class="flavor-label"><?php echo esc_html($flavor_labels[$idx]); ?></div>
                    </label>
                    <?php if ($is_best_seller): ?>
                    <div class="best-seller-badge">BEST-SELLER</div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
         </div>

        <div class="delivery-section">
            <h3>What's Included</h3>
            
            <!-- Delivery Options Container -->
            <div class="delivery-options-grid">
                
                <!-- Every 30 Days Card -->
                <div class="delivery-card">
                    <p class="delivery-frequency">Every 30 Days</p>
                    <div class="card-content">
                        <div class="flavor-image-container">
                        <img src="<?php echo esc_url(wp_get_attachment_image_url($gallery_ids[0], 'medium')); ?>" alt="Monthly Flavor" class="flavor-image" />
                        </div>
                    </div>
                    </div>

                    <div class="delivery-card">
                    <p class="delivery-frequency">One Time (Free)</p>
                    <div class="card-content">
                        <div class="flavor-images-group">
                        <?php foreach (array_slice($gallery_ids, 0, 3) as $img_id): ?>
                            <img src="<?php echo esc_url(wp_get_attachment_image_url($img_id, 'medium')); ?>" alt="Flavor" class="flavor-image" />
                        <?php endforeach; ?>
                        </div>
                    </div>
                    </div>
                
            </div>
            </div>

        <div class="benefits-list">
          <ul>
            <li>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit.</li>
            <li>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit.</li>
            <li>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit.</li>
            <li>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit.</li>
            <li>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit.</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Divider -->
    <div class="card-divider"></div>

    <!-- Double Subscription Card -->
    <div id="double-subscription-card" class="subscription-card">
      <div class="card-header">
        <label class="toggle-radio">
        <input type="radio" name="purchase_mode" value="double">
        <span>Double Drink Subscription</span>
        </label>
        <div class="price-container">
          <span class="discounted-price">$12</span>
          <span class="original-price">$20</span>
        </div>
      </div>
      <div class="card-body">
        <p class="card-desc">Select two flavors for your double pack.</p>
        <div>
          <strong>Flavor 1:</strong>
          <div class="flavor-toggle-row">
            <?php foreach ($gallery_ids as $idx => $img_id): ?>
              <?php 
              $img_url = wp_get_attachment_image_url($img_id, 'large'); 
              $is_best_seller = ($flavor_labels[$idx] === 'Chocolate');
              ?>
                <div class="flavor-toggle-container <?php echo $is_best_seller ? 'best-seller-container' : ''; ?>">
                    <label class="flavor-toggle">
                    <input type="radio" class="flavor1" name="flavor1" value="<?php echo esc_attr($flavor_labels[$idx]); ?>" <?php echo $idx === 0 ? 'checked' : ''; ?>>
                    <img src="<?php echo esc_url($img_url); ?>" class="flavor-img" />
                    <div class="flavor-label"><?php echo esc_html($flavor_labels[$idx]); ?></div>
                    </label>
                    <?php if ($is_best_seller): ?>
                    <div class="best-seller-badge">BEST-SELLER</div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div style="margin-top:1em;">
          <strong>Flavor 2:</strong>
          <div class="flavor-toggle-row">
            <?php foreach ($gallery_ids as $idx => $img_id): ?>
              <?php 
              $img_url = wp_get_attachment_image_url($img_id, 'large'); 
              $is_best_seller = ($flavor_labels[$idx] === 'Chocolate');
              ?>
                <div class="flavor-toggle-container <?php echo $is_best_seller ? 'best-seller-container' : ''; ?>">
                    <label class="flavor-toggle">
                    <input type="radio" class="flavor2" name="flavor2" value="<?php echo esc_attr($flavor_labels[$idx]); ?>" <?php echo $idx === 1 ? 'checked' : ''; ?>>
                    <img src="<?php echo esc_url($img_url); ?>" class="flavor-img" />
                    <div class="flavor-label"><?php echo esc_html($flavor_labels[$idx]); ?></div>
                    </label>
                    <?php if ($is_best_seller): ?>
                    <div class="best-seller-badge">BEST-SELLER</div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
          </div>
        </div>        <div class="delivery-section">
          <h3>What's Included</h3>
            <!-- Delivery Options Container -->
            <div class="delivery-options-grid">
                
                <!-- Every 30 Days Card -->
                <div class="delivery-card">
                    <p class="delivery-frequency">Every 30 Days</p>
                    <div class="card-content">
                        <div class="flavor-image-container">
                        <img src="<?php echo esc_url(wp_get_attachment_image_url($gallery_ids[0], 'medium')); ?>" alt="Monthly Flavor" class="flavor-image" />
                        </div>
                    </div>
                    </div>

                    <div class="delivery-card">
                    <p class="delivery-frequency">One Time (Free)</p>
                    <div class="card-content">
                        <div class="flavor-images-group">
                        <?php foreach (array_slice($gallery_ids, 0, 3) as $img_id): ?>
                            <img src="<?php echo esc_url(wp_get_attachment_image_url($img_id, 'medium')); ?>" alt="Flavor" class="flavor-image" />
                        <?php endforeach; ?>
                        </div>
                    </div>
                    </div>
                
            </div>
        </div>

        <div class="benefits-list">
          <ul>
            <li>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit.</li>
            <li>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit.</li>
            <li>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit.</li>
            <li>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit.</li>
            <li>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit.</li>
          </ul>
        </div>

      </div>
    </div>

    <!-- Add to Cart Buttons Container -->
    <div class="single_variation_wrap">
    <button type="button" id="single_add_to_cart" class="button alt">Add to Cart</button>
    <button type="button" id="double_add_to_cart" class="button alt" style="display: none; margin-top: 1em;">Add Both Flavors to Cart</button>
    </div>
  </form>
</div>

<style>
.custom-variable-product-ui {
  max-width: 600px;
  margin: 0 auto;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  color: #333;
}

.product-header {
  margin-bottom: 2rem;
  text-align: center;
}
.product-header h1 {
  font-size: 2rem;
  margin-bottom: 1rem;
  color: #222;
}
.product-description {
  color: #666;
  line-height: 1.6;
}
.product-rating { 
    margin-top: 0.5em; 
    font-size: 1.2em; 
    display: flex;
    align-items: center;
    }
    .product-rating .star { 
    color: #ccc; 
    margin-right: 3px;
    }
    .product-rating .star.filled { 
    color: #FFD700; 
    }
    .product-rating .rating-value { 
    margin-left: 8px; 
    color: #555; 
 }

.recommended-badge {
  background: #007cba;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  display: inline-block;
  font-weight: bold;
  margin-bottom: 1.5rem;
  font-size: 0.9rem;
}

.subscription-card {
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  margin-bottom: 1.5rem;
  padding: 0;
  border: 1px solid #e0e0e0;
}
.card-header {
  padding: 1.5rem 1.5rem 0;
  height: 60px;
}
.card-header h2 {
  font-size: 1.5rem;
  margin: 0;
  color: #222;
}
.card-body {
  padding: 0 1.5rem 1.5rem;
}

.flavor-section h3,
.delivery-section h3 {
  font-size: 1.1rem;
  margin: 1.5rem 0 1rem;
  color: #444;
}
.flavor-toggle-row {
  display: flex;
  gap: 1rem;
  margin-bottom: 1rem;
}
.flavor-toggle {
  text-align: center;
  cursor: pointer;
}
.flavor-img {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 8px;
  border: 2px solid #ddd;
  transition: border-color 0.2s;
}
.flavor-label {
  margin-top: 0.5rem;
  font-size: 0.9rem;
}

.delivery-option {
  display: flex;
  justify-content: space-between;
  padding: 0.8rem 0;
  border-bottom: 1px solid #eee;
}

.benefits-list ul {
  list-style: none;
  padding: 0;
  margin: 1.5rem 0 0;
}
.benefits-list li {
  position: relative;
  padding-left: 1.8rem;
  margin-bottom: 0.8rem;
  line-height: 1.5;
}
.benefits-list li:before {
  content: "✓";
  position: absolute;
  left: 0;
  color: #007cba;
  font-weight: bold;
}

.card-divider {
  height: 1px;
  background: #eee;
  margin: 1.5rem 0;
}

.double-subscription-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.double-subscription-actions .button {
  background: #007cba;
  color: white;
  border: none;
  padding: 0.8rem 1.5rem;
  border-radius: 4px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.2s;
}
.double-subscription-actions .button:hover {
  background: #006ba1;
}
.price-wrapper {
  text-align: right;
}
.price {
  font-size: 1.5rem;
  font-weight: bold;
  color: #007cba;
  display: block;
}
.original-price {
  font-size: 1rem;
  color: #999;
  text-decoration: line-through;
}

.single_variation_wrap {
  display: none;
}
.subscription-card .card-body {
  display: none;
}
.subscription-card.active .card-body {
  display: block;
}
.price-container {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-left: 150px;
}

.original-price {
  color: #999;
  text-decoration: line-through;
  font-size: 1.1em;
}

.discounted-price {
  color: #4CAF50; /* Green color */
  font-weight: bold;
  font-size: 1.1em;
}
.flavor-toggle-row {
  display: flex;
  gap: 1rem;
  margin-bottom: 1rem;
}

.flavor-toggle-container {
  position: relative;
  text-align: center;
}

.flavor-toggle {
  display: block;
  cursor: pointer;
  padding-top: 25px; /* Space for badge */
}

.best-seller-badge {
  position: absolute;
  top: 0;
  left: 62%;
  transform: translateX(-50%);
  background: #FFD700; /* Gold color */
  color: #000;
  font-size: 10px;
  font-weight: bold;
  padding: 3px 10px;
  border-radius: 12px;
  text-transform: uppercase;
  white-space: nowrap;
  z-index: 1;
}

.flavor-img {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 8px;
  border: 2px solid #ddd;
  transition: border-color 0.2s;
}

.flavor-toggle input[type="radio"]:checked + img {
  border-color: #007cba;
}

.flavor-label {
  margin-top: 0.5rem;
  font-size: 0.9rem;
  font-weight: bold;
}
.delivery-section {
  margin-top: 2rem;
}

.delivery-options-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
  margin-top: 1rem;
}

.delivery-card {
  border: 1px solid #e0e0e0;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.delivery-frequency {
  padding: 6px 0;
  font-size: 0.8rem;
  text-align: center;
  color: #555;
}

.card-content {
  padding: 15px;
  text-align: center;
}

/* Container for both single and multiple images */
.flavor-image-container,
.flavor-images-group {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  width: 100%;
}

/* Unified image styling for both single and multiple */
.flavor-image {
  width: 100%;
  height: 100%;
  max-width: 130px; /* Control maximum size */
  max-height: 130px;
  object-fit: contain; /* Show full image without cropping */
  display: block;
}

/* Specific container for single image */
.flavor-image-container {
  height: 80px;
}

/* Specific container for multiple images */
.flavor-images-group {
  height: 80px;
}

/* Remove all borders and rounding */
.flavor-image {
  border: none !important;
  border-radius: 0 !important;
}
/* Active state styling */
.delivery-card.active {
  border-color: #007cba;
  box-shadow: 0 2px 12px rgba(0,124,186,0.15);
}

.delivery-card.active .card-header {
  background-color: #007cba;
  color: white;
}

.delivery-card.active .card-header h4 {
  color: white;
}
.single_variation_wrap {
  margin-top: 1.5rem;
}

.button.alt {
  background-color: #000000;
  color: #ffffff;
  border: none;
  padding: 12px 20px;
  font-size: 16px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  border-radius: 25px;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  display: block;
  width: 100%;
  text-align: center;
}

.button.alt:hover {
  background-color: #333333;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

/* Responsive adjustments */
@media (max-width: 480px) {
  .flavor-toggle-row {
    flex-wrap: wrap;
    justify-content: center;
  }
  .double-subscription-actions {
    flex-direction: column;
    gap: 1rem;
  }
  .price-wrapper {
    text-align: center;
  }
  .button.alt {
    padding: 10px 15px !important;
    font-size: 14px !important;
  }
}
</style>

<script>
jQuery(document).ready(function($) {
  // Show WooCommerce-style success message
  function showWcSuccess(msg) {
    var $notices = $('.woocommerce-notices-wrapper');
    if ($notices.length === 0) {
      $notices = $('<div class="woocommerce-notices-wrapper"></div>');
      $('.custom-variable-product-ui').prepend($notices);
    }
    $notices.html('<div style="height:40px;"></div><div class="woocommerce-message" role="alert">' + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + msg + '</div>');
    if (typeof wc_cart_fragments_params !== 'undefined') {
      $(document.body).trigger('added_to_cart');
    }
  }

  // Sync single flavor radio to WooCommerce select
  function syncSingleFlavor() {
    const selectedFlavor = $('input[name="attribute_flavor"]:checked').val();
    const $select = $('#single-variation-select select[name^="attribute_flavor"]');
    if ($select.length && selectedFlavor) {
      $select.val(selectedFlavor).trigger('change').trigger('blur');
    }
  }

  // Sync double flavor radios to hidden selects
  function syncDoubleFlavors() {
    const flavor1 = $('input[name="flavor1"]:checked').val();
    $('#double-variation-select-1 select[name^="attribute_flavor"]').val(flavor1).trigger('change').trigger('blur');
    const flavor2 = $('input[name="flavor2"]:checked').val();
    $('#double-variation-select-2 select[name^="attribute_flavor"]').val(flavor2).trigger('change').trigger('blur');
  }

  // Initial sync
  syncSingleFlavor();
  syncDoubleFlavors();

  // Events
  $('input[name="attribute_flavor"]').on('change', syncSingleFlavor);
  $('input[name="flavor1"]').on('change', syncDoubleFlavors);
  $('input[name="flavor2"]').on('change', syncDoubleFlavors);
  if ($('input[name="purchase_mode"]:checked').val() === 'double') {
    $('#single_add_to_cart').hide();
    $('#double_add_to_cart').show();
  } else {
    $('#double_add_to_cart').hide();
    $('#single_add_to_cart').show();
  }

  // Toggle between buttons when purchase mode changes
  $('input[name="purchase_mode"]').change(function() {
    if ($(this).val() === 'double') {
      $('#single_add_to_cart').hide();
      $('#double_add_to_cart').show();
    } else {
      $('#double_add_to_cart').hide();
      $('#single_add_to_cart').show();
    }
  });
  // Toggle cards
  $('input[name="purchase_mode"]').change(function() {
    if ($(this).val() === 'double') {
      $('#single-subscription-card').removeClass('active');
      $('#double-subscription-card').addClass('active');
      $('#single_add_to_cart').hide();
      $('#double_add_to_cart').show();
      $('#single-variation-select select[name^="attribute_flavor"]').val('').trigger('change');
    } else {
      $('#double-subscription-card').removeClass('active');
      $('#single-subscription-card').addClass('active');
      $('#single_add_to_cart').show();
      $('#double_add_to_cart').hide();
      syncSingleFlavor();
    }
  });

  // Single add to cart AJAX
  $('#single_add_to_cart').on('click', function() {
    syncSingleFlavor();

    var attrs = {};
    $('#single-variation-select select').each(function() {
      attrs[$(this).attr('name')] = $(this).val();
    });
    var product_id = <?php echo $product->get_id(); ?>;

    $.post('<?php echo admin_url('admin-ajax.php'); ?>', {
      action: 'add_double_flavor_to_cart',
      product_id: product_id,
      attributes: attrs
    }, function(response) {
      if (response.success) {
        showWcSuccess('"Drink Pack" has been added to your cart.');
      } else {
        showWcSuccess(response.data);
      }
    });
  });

  // Double add to cart AJAX
  $('#double_add_to_cart').on('click', function() {
    syncDoubleFlavors();

    var attrs1 = {};
    $('#double-variation-select-1 select').each(function() {
      attrs1[$(this).attr('name')] = $(this).val();
    });

    var attrs2 = {};
    $('#double-variation-select-2 select').each(function() {
      attrs2[$(this).attr('name')] = $(this).val();
    });

    var product_id = <?php echo $product->get_id(); ?>;

    $.post('<?php echo admin_url('admin-ajax.php'); ?>', {
      action: 'add_double_flavor_to_cart',
      product_id: product_id,
      attributes: attrs1
    }, function(response) {
      if (response.success) {
        $.post('<?php echo admin_url('admin-ajax.php'); ?>', {
          action: 'add_double_flavor_to_cart',
          product_id: product_id,
          attributes: attrs2
        }, function(response2) {
          if (response2.success) {
            showWcSuccess('Both flavors have been added to your cart!');
          } else {
            showWcSuccess(response2.data);
          }
        });
      } else {
        showWcSuccess(response.data);
      }
    });
  });
});
</script>