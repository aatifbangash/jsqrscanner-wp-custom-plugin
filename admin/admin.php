<?php
class jaQuizAdminPanel
{
    public function __construct()
    {
        add_action('admin_menu', array(&$this, 'add_menu'));
    }
    // integrate the menu
    public function add_menu()
    {
        add_menu_page("QR Scanner", "QR Scanner", "administrator", "qr-scanner", array(&$this, 'show_menu'), 'dashicons-camera-alt');
    }

    public function show_menu()
    {
        switch ($_GET['page']) {
            case "qr-scanner":
                include_once dirname(__FILE__) . '/qr-scanner-home-controller.php';
                $qrObj = new QRScannerHomeController();
                $qrObj->index();
                break;
            default:
                # code...
                break;
        }
    }
}
