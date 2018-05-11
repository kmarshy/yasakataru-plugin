<?php
    /*
    Plugin Name: Yasakaturu Futuremedia
    Plugin URI: http://www.futuremedia.jp
    Description: Adding functionality to yasakaturu shop
    Author: Future Media House
    Version: 1.4.3
    Author URI: https://yasakaturu.co.jp
    Domain: futureMedia_lang
    */


//if(!defined(ABSPATH)) exit;

define('YF_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once(YF_PLUGIN_PATH .'inc/add_woocommerce_support.php');