jQuery(document).ready(function ($) {
  function updateInclusion(mode) {
    const list = $("#inclusion-list");
    list.empty();
    if (mode === "single") {
      list.append(
        "<li>1x Protein Sachet</li><li>1x Free Shaker</li><li>One Time Delivery</li>"
      );
    } else {
      list.append(
        "<li>2x Protein Sachets</li><li>1x Free Shaker</li><li>Delivery Every 30 Days</li>"
      );
    }
  }

  function updatePrice(mode) {
    const $wooPrice = $(".woocommerce-variation-price .price bdi").first();
    const basePriceText = $wooPrice.text();
    if (!basePriceText) return;

    const price = parseFloat(basePriceText.replace(/[^0-9.]/g, ""));
    if (!price) return;

    let subPrice = price * 0.75;
    let finalPrice = subPrice * 0.8;

    $(".regular-price").text(`$${price.toFixed(2)}`);
    $(".discounted-price").text(`$${finalPrice.toFixed(2)}`);
  }

  $('input[name="purchase_mode"]').on("change", function () {
    const mode = $(this).val();
    updateInclusion(mode);
    updatePrice(mode);
  });

  $("select").on("change", function () {
    const mode = $('input[name="purchase_mode"]:checked').val();
    setTimeout(() => updatePrice(mode), 300); // small delay after variation loads
  });

  // Init
  updateInclusion($('input[name="purchase_mode"]:checked').val());
});
