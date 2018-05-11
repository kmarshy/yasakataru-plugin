<?php
/**
 * Add a standard  delivery fee value to all transactions in cart / checkout
 */


function FM_yasakaturu_add_checkout_fee_for_gateway( ) {

	 global $woocommerce;
 
	if ( ( is_admin() && ! defined( 'DOING_AJAX' ) ) || ! is_checkout() )
		return;
 
    $chosen_gateway = $woocommerce->session->chosen_payment_method;
    
 
	
    if ( $chosen_gateway == 'cod' ) { //Testing payment method
        
        $subtotal = $woocommerce->cart->cart_contents_total;

        switch( true ){
            case($subtotal <= 10000):  $fee = 324; break;
            case($subtotal <= 30000) : $fee = 432; break;
            case($subtotal <= 100000) : $fee = 648; break;
            case($subtotal <= 300000) : $fee = 1080; break; 
            default: $fee = 0;

        }
            



		$woocommerce->cart->add_fee( '代金引換', $fee, false, '' ); //you might need to change the label to japanese
	}
}
add_action( 'woocommerce_cart_calculate_fees','FM_yasakaturu_add_checkout_fee_for_gateway' );

function cart_update_script() {
    if (is_checkout()) :
    ?>
    <script>
		jQuery( function( $ ) {
 
			// woocommerce_params is required to continue, ensure the object exists
			if ( typeof woocommerce_params === 'undefined' ) {
				return false;
			}
 
			$checkout_form = $( 'form.checkout' );
 
			$checkout_form.on( 'change', 'input[name="payment_method"]', function() {
					$checkout_form.trigger( 'update' );
			});
 
 
		});
    </script>
    <?php
    endif;
}
add_action( 'wp_footer', 'cart_update_script', 999 );