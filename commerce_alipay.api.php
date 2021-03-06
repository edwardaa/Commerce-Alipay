<?php

/**
 * @file
 * Documents hooks provided by the Alipay modules.
 */

/**
 * Defines trade statuses for use in grouping trade statuses together.
 *
 * An tarde status is a single step in the life-cycle of an trade that
 * administrators can use to know at a glance what has occurred to the trade
 * already and/or what the next step in processing the trade will be.
 *
 * @return
 *   An array of trade statuses arrays keyed by name.
 */
function hook_commerce_alipay_trade_status_info() {
  $trade_statuses = array();

  $trade_statuses['TRADE_SUCCESS'] = array(
    'name' => 'TRADE_SUCCESS',
    'title' => t('Successful'),
    'weight' => 10,
  );

  return $trade_statuses;
}

/**
 * Allows modules to alter the trade status definitions of other modules.
 *
 * @param $trade_statuses
 *   An array of trade statuses defined by enabled modules.
 *
 * @see hook_commerce_alipay_trade_status_info()
 */
function hook_commerce_alipay_trade_status_alter(&$trade_statuses) {
  $trade_statuses['TRADE_CLOSED']['weight'] = 10;
}

/**
 * Lets modules perform additional processing on validated IPNs.
 *
 * When the Alipay module receives an Instant Payment Notification (IPN) from
 * Alipay, it performs some basic validation, allows the payment method detected
 * in the IPN URL to perform additional validation and processing, and finally
 * invokes this hook to allow other modules to react to the IPN. If the IPN
 * fails either the basic or payment method specific validation, it will not be
 * processed and therefore will not result in this hook's invocation.
 *
 * When a module implements this hook, it is important to take the values of the
 * arguments into consideration before acting. For example, it is possible that
 * the Order and/or the Transaction parameters are FALSE, meaning the IPN was
 * sent for a transaction that Commerce knows nothing about. It is also possible
 * for an IPN to not have a txn_id, such as with subscription notifications. In
 * these cases, you should use additional parameters in the IPN to ensure before
 * taking any action that an action is called for and has not already been done,
 * such as the subscr_id for subscription notifications.
 *
 * Additionally, the IPN array may not have the ipn_id set, meaning that the IPN
 * passed validation but could not be processed by the payment method module. In
 * this case, you would not want to take any permanent, non-repeatable action,
 * as it is possible the store owner will need to resubmit the IPN until it
 * actually processes properly.
 *
 * Finally, the IPN array may not have the transaction_id set, meaning the IPN
 * either did not result in the creation of a payment transaction intentionally
 * or failed to process properly. In this case, you may not want to take action
 * that would normally result in the update of an existing payment transaction,
 * though it still might be ok to take action that would have resulted in the
 * creation of an additional transaction.
 *
 * While IPNs generally have a unique txn_id, in the case of voided
 * authorizations, the void notification will have the same txn_id as the
 * authorization notification. Some IPNs are related to others through the
 * parent_txn_id and auth_id values. See the Alipay Direct IPN process callback for
 * an example of how to interact with these values for prior authorization
 * captures and refunds.
 *
 * @param $order
 *   The order that initiated the payment associated with the IPN.
 * @param $payment_method
 *   The payment method instance used to create the payment and perform initial
 *   processing on the IPN.
 * @param $ipn
 *   The IPN array received from Alipay after it has been saved, including the
 *   additional ipn_id, order_id, and transaction_id values.
 *
 * @see commerce_alipay_direct_alipay_ipn_process()
 */
function hook_commerce_alipay_ipn_process($order, $payment_method, $ipn) {
  // No example.
}

/**
 * Allows modules to alter the name-value pair array for a Alipay API request
 * before it is submitted.
 *
 * Currently invoked for PayPal Payments Pro and Express Checkout. Modules
 * implementing this hook may determine which payment method the API request is
 * for by examining the $payment_method array passed as the last parameter.
 *
 * @param &$nvp
 *   The name-value pair array for the API request.
 * @param $order
 *   If available, the full order object the payment request is being submitted
 *   for; otherwise NULL.
 * @param $payment_method
 *   The payment method instance array associated with this API request.
 */
function hook_commerce_alipay_api_request_alter(&$nvp, $order, $payment_method) {
  // No example.
}
