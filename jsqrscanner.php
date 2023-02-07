<?php
session_start();
/*
Plugin Name: BR scanner
Plugin URI: http://www.techfords.com
Description: Following is the QR code scanner.
Author: Atif
Text Domain: jsqrscanner
Version: 1.0
Author URI: http://www.techfords.com
 */

// Stop direct call
defined('ABSPATH') or die('No script kiddies please!');

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

if (!class_exists('qRscanner')) {
    class jsQRscanner
    {
        public $jaQuizAdminPanel = '';

        public function __construct()
        {
            add_action('init', array(&$this, 'myplugin_load_textdomain'));
            $this->load_dependencies();
        }

        public function load_dependencies()
        {
            require_once dirname(__FILE__) . '/lib/shortcodes.php';
            $this->load_assets();


            if (is_admin()) {
                require_once dirname(__FILE__) . '/admin/admin.php';
                $this->jaQuizAdminPanel = new jaQuizAdminPanel();
            }
        }

        function myplugin_load_textdomain()
        {
            load_plugin_textdomain('jsqrscanner', false, basename(dirname(__FILE__)) . '/languages');
        }
        public function load_assets()
        {
            wp_enqueue_script('qrscanner-script-lib', plugins_url('assets/js/html5-qrcode.min.js', __FILE__));
            wp_enqueue_script('qrscanner-script-custom', plugins_url('assets/js/main.js', __FILE__));
            wp_enqueue_style('jsquiz-style', plugins_url('assets/css/default.css', __FILE__));
        }
    }
    // Let's start the holy plugin
    global $jsQRscanner;
    $jsQRscanner = new jsQRscanner();
}
