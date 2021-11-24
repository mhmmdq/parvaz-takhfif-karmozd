<?php
/*
Plugin Name: پرواز - افزونه تخفیف از روی کارمزد
Plugin URI: https://github.com/mhmmdq/parvaz-takhfif-karmozd
Description: افزونه ای برای کسر کد تخفیف از کمیسیون مدیر به جای مبلغ کل
Author: Mhmmdq
Version: 0.1.1
Author URI: https://github.com/mhmmdq
*/
if (!defined('ABSPATH'))
  exit;


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 

if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) 
{

  if(is_plugin_active( 'dokan-lite/dokan.php' )) 
  { 

      include 'inc/class-coupon-code-dokan.php';
      new PARVAZ_CCD();
  }
  else
  {
    add_action('admin_notices' , function() {
      $message = 'افزونه تخفیف از روی کارمزد برای کارکرد نیاز مند نصب و فعال سازی دکان را دارد';
      $html_message = sprintf( '<div class="notice notice-error" style="padding:10px;"> %s </div>', $message);
      echo $html_message; 
    });
  }

}
else
{
  add_action('admin_notices' , function() {
    $message = 'افزونه تخفیف از روی کارمزد برای کارکرد نیاز مند نصب و فعال سازی ووکامرس را دارد';
    $html_message = sprintf( '<div class="notice notice-error" style="padding:10px;"> %s </div>', $message);
    echo $html_message; 
  });
}