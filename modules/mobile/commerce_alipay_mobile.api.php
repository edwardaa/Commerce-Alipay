<?php

/**
 * @file
 * Hook documentation for the Alipay Mobile module.
 */


/**
 * Allows modules to alter the data array used to create a Alipay Mobile request.
 *
 * @param &$data
 *   The data array used to create mobile request.
 * @param $order
 *   The full order object the request is being generated for.
 *
 * @see commerce_alipay_mobile_order_data()
 */
function hook_commerce_alipay_mobile_order_data_alter(&$data, $order) {
  // No example.
}
