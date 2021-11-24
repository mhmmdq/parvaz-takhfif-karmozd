<?php

if( !class_exists( 'PARVAZ_CCD' ) )
{
    class PARVAZ_CCD {
        
        public function __construct()
        {
                add_action( 'woocommerce_before_calculate_totals', [$this , 'adjust_cart_coupon'], 10, 1);
        }

        public function adjust_cart_coupon( $cart_object ) 
        {
            global $woocommerce;

            if ( is_admin() && ! defined( 'DOING_AJAX' ) ){
            return;
            }

            if ($coupons = WC()->cart->get_applied_coupons()  == False ) {
                $coupon = False;
            } else {
                foreach ( WC()->cart->get_applied_coupons() as $code ) {
                    $coupon = new WC_Coupon( $code );
                    $discount_type = $coupon->get_discount_type(); // Get coupon discount type
                    $coupon_amount = $coupon->get_amount(); // Get coupon amount
                }
            }

            if($coupon !== false) {
            foreach ( $cart_object->get_cart() as $cart_item )
            {
                $commission =  dokan()->commission->get_earning_by_product( $cart_item['product_id'], 'admin' );
                $price = $cart_item['data']->regular_price;
                if($discount_type == 'percent') {
                $price = $price - (($commission * $coupon_amount)/100);
                }else {
                $price = $price - ($commission - $coupon_amount);
                }
                $cart_item['data']->set_price( $price );
            }

            }

        }
        
    }

}