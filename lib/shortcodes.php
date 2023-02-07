<?php
class QRScanner_shortcodes
{

    function __construct()
    {
        add_shortcode('qrcs', array(&$this, 'show_qr_scanner'));
    }

    function show_qr_scanner($attrs, $content = null)
    {
        extract(shortcode_atts(array( //default array
            'action' => 'url',
            'button_class' => '',
            'button_text' => 'Start scanning',
            'input_id' => null,
            'input_class' => null
        ), $attrs));

        $cont = '<div class="reader_container">
            <input type="hidden" id="qr_action" value="' . $action . '">
            <input type="hidden" id="qr_input_id" value="' . $input_id . '">
            <input type="hidden" id="qr_input_class" value="' . $input_class . '">
            <div id="reader" ></div>
            <div id="reader_controls">
                <a class="reader_icons" id="permission_btn" title="grant camera permission" href="javascript:void(0);"><span>1</span><img src="' . plugin_dir_url(__DIR__) . 'assets/icons/permission.png" alt="permission" /></a>
                <a class="reader_icons" id="switch_camera_btn" title="switch camera" href="javascript:void(0);"><span>2</span><img src="' . plugin_dir_url(__DIR__) . 'assets/icons/camera.png" alt="cameras" /></a>
                <a class="reader_icons ' . $button_class . '" id="start_scanning_btn" title="' . $button_text . '" href="javascript:void(0);"><span>3</span><img src="' . plugin_dir_url(__DIR__) . 'assets/icons/start.png" alt="scan" /></a>
                <a class="reader_icons" id="stop_scanning_btn" title="stop scanning" href="javascript:void(0);"><img src="' . plugin_dir_url(__DIR__) . 'assets/icons/stop.png" alt="stop" /></a>
            </div>
            <!-- The Modal -->
            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="model-content-area">

                    </div>
                </div>

            </div>
        </div>';
        return $cont;
    }
}
$QRScanner_shortcodesObj = new QRScanner_shortcodes();
