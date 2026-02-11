<?php
if (!defined('ABSPATH')) exit;

function mypos_booking_shortcode($atts) {
    $atts = shortcode_atts([
        'width' => get_option('mypos_iframe_width', '100%'),
        'height' => get_option('mypos_iframe_height', '800px'),
    ], $atts);
    
    $app_url = get_option('mypos_app_url');
    
    if (!$app_url) {
        return '<div style="background: #fff3cd; padding: 15px; border-radius: 5px; color: #856404;">
                    ⚠️ Error: URL de la app no configurada. 
                    <a href="' . admin_url('admin.php?page=mypos-booking-settings') . '">Configura aquí</a>
                </div>';
    }
    
    ob_start();
    ?>
    <div style="margin: 20px 0; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <iframe src="<?php echo esc_url($app_url); ?>/booking"
                width="<?php echo esc_attr($atts['width']); ?>"
                height="<?php echo esc_attr($atts['height']); ?>"
                frameborder="0"
                style="border: none; display: block; width: 100%; height: <?php echo esc_attr($atts['height']); ?>;"
                allow="payment"
                sandbox="allow-same-origin allow-scripts allow-forms allow-popups">
        </iframe>
    </div>
    <?php
    return ob_get_clean();
}
