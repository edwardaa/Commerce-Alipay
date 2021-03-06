<?php

/**
 * @file
 * Hook documentation for the Alipay Direct module.
 */


/**
 * Allows modules to alter the data array used to create a Alipay Direct redirect
 * form prior to its form elements being created.
 *
 * @param &$data
 *   The data array used to create redirect form elements.
 * @param $order
 *   The full order object the redirect form is being generated for.
 *
 * @see commerce_alipay_direct_order_form()
 */
function hook_commerce_alipay_direct_order_form_data_alter(&$data, $order) {
  // No example.
}
