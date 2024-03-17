<?php
/*
 * Plugin Name:       SmilePay Module for WooCommerce
 * Plugin URI:        https://smilepay.net
 * Description:       SmilePay 金/物/簡訊/電子發票模組
 * Version:           1.1.23
 * Requires at least: 6
 * Requires PHP: 7.4
 * Author:            SmilePay
 * Author URI:        https://smilepay.net
*/

// error_reporting(0);

defined('ABSPATH') || exit;

define('SP_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
define('SP_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
define('SP_PLUGIN_DIR_BASENAME', plugin_basename(__FILE__));

require_once SP_PLUGIN_DIR_PATH . 'admin/class-smilepay-setting-main.php';
$setting_main_class = new SmilePay_Setting_Main;

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (!is_plugin_active('woocommerce/woocommerce.php')) {
    add_action('admin_notices', [$setting_main_class,'check_woocommerce']);    
    return;
}

if (get_option('smilepay_payment_enabled') === 'yes') {
    include_once SP_PLUGIN_DIR_PATH . 'admin/class-smilepay-payment.php';
    new SmilePay_Payment;
}

if (get_option('smilepay_logistic_enabled') === 'yes') {
    include_once SP_PLUGIN_DIR_PATH . 'admin/class-smilepay-logistic.php';
    new SmilePay_Logistic;
}

if (get_option('smilepay_sms_enabled') === 'yes') {
    include_once SP_PLUGIN_DIR_PATH . 'admin/class-smilepay-sms.php';
    new SmilePay_SMS;
}

if (get_option('smilepay_einvoice_enabled') === 'yes') {
    include_once SP_PLUGIN_DIR_PATH . 'admin/class-smilepay-einvoice.php';
    new SmilePay_EInvoice;
}

if(!defined('SMILEPAY_CART_INFO')){
    require_once SP_PLUGIN_DIR_PATH . 'admin/class-smilepay-cart-info.php';
    new SmilePay_CartInfo;
}
