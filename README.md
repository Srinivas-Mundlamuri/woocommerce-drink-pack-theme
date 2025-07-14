# WooCommerce Custom Drink Subscription UI

Live Product Page: [Drink Pack Subscription](https://wordpress-assignment-6178.rf.gd/?product=drink-pack)

> **Note:** The product page is restricted. Please log in to view:
>
> - **Username:** kotimundlamuri6718@gmail.com
> - **Password:** ******\*\*\*\*******

![Main Product Interface](woocommerce/single-product/images/web-page1.png)
![Main Product Interface](woocommerce/single-product/images/web-page2.png)

_Custom drink subscription interface with single and double flavor options_

---

![Cart Preview](woocommerce/single-product/images/web-cart.png)
Cart items and flavor selections in action

---

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [How It Works](#how-it-works)
- [Customization](#customization)
- [Troubleshooting](#troubleshooting)
- [Screenshots](#screenshots)

---

## Features

### ✅ Dual Subscription Options

- **Single Flavor Subscription** (⭐ Recommended)

  - Visual flavor selection using image-based radio buttons
  - Weekly delivery display with feature breakdown
  - Styled price and badge UI
  - Native variation support (fully compatible with WooCommerce)

- **Double Flavor Subscription**
  - Select two flavors visually
  - Adds two variation items to the cart via AJAX
  - Fully compatible with WooCommerce cart system
  - Works without reloading the page

![Flavor Selection](woocommerce/single-product/images/flavor-selection-ui.jpg)

---

## Requirements

| Component   | Version |
| ----------- | ------- |
| WordPress   | 5.0+    |
| WooCommerce | 4.0+    |
| PHP         | 7.4+    |
| jQuery      | 3.0+    |

---

## Installation

1. **Add Template Override**

   Copy the custom product template file to your theme:

   ```bash
   wp-content/
   └── themes/
       └── twentytwentyfive-child/
           └── woocommerce/
               └── single-product/
                   └── add-to-cart/
                       └── variable.php
   ```
