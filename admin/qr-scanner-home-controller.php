<?php
defined('ABSPATH') or die('No script kiddies please!');

class QRScannerHomeController
{
    public function index()
    {
        include_once dirname(__FILE__) . '/qr-scanner-home-view.php';
    }
}
