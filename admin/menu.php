<?php
if (!defined('ABSPATH')) exit;

add_action('admin_menu', function() {
    add_menu_page(
        'Mypos Booking',
        'Mypos Booking',
        'manage_options',
        'mypos-booking-settings',
        'mypos_render_settings',
        'dashicons-calendar',
        25
    );
});

function mypos_render_settings() {
    if (!current_user_can('manage_options')) wp_die('No tienes permisos');
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mypos_nonce'])) {
        if (wp_verify_nonce($_POST['mypos_nonce'], 'mypos_settings')) {
            update_option('mypos_app_url', sanitize_url($_POST['mypos_app_url']));
            update_option('mypos_iframe_width', sanitize_text_field($_POST['mypos_iframe_width']));
            update_option('mypos_iframe_height', sanitize_text_field($_POST['mypos_iframe_height']));
            echo '<div class="notice notice-success"><p>✅ Configuración guardada</p></div>';
        }
    }
    
    $app_url = get_option('mypos_app_url');
    $width = get_option('mypos_iframe_width', '100%');
    $height = get_option('mypos_iframe_height', '800px');
    ?>
    
    <div class="wrap">
        <h1>⚠️ Configuración de Mypos Booking</h1>
        
        <div class="card" style="max-width: 600px; padding: 20px; margin-top: 20px;">
            <h2>🔧 Parámetros de la App</h2>
            
            <form method="POST">
                <?php wp_nonce_field('mypos_settings', 'mypos_nonce'); ?>
                
                <table class="form-table">
                    <tr>
                        <th><label for="mypos_app_url">URL de tu app Mypos:</label></th>
                        <td>
                            <input type="url" name="mypos_app_url" id="mypos_app_url"
                                   value="<?php echo esc_attr($app_url); ?>"
                                   placeholder="https://mypos-connect--jwpcelias.replit.app"
                                   class="regular-text" required>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="mypos_iframe_width">Ancho del iframe:</label></th>
                        <td>
                            <input type="text" name="mypos_iframe_width" id="mypos_iframe_width"
                                   value="<?php echo esc_attr($width); ?>" placeholder="100%" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th><label for="mypos_iframe_height">Alto del iframe:</label></th>
                        <td>
                            <input type="text" name="mypos_iframe_height" id="mypos_iframe_height"
                                   value="<?php echo esc_attr($height); ?>" placeholder="800px" class="regular-text">
                        </td>
                    </tr>
                </table>
                <?php submit_button('Guardar Configuración', 'primary'); ?>
            </form>
        </div>
        
        <div class="card" style="max-width: 600px; padding: 20px; margin-top: 20px;">
            <h2>📚 Cómo usar</h2>
            <p>Usa este shortcode en cualquier página o post:</p>
            <code style="background: #f5f5f5; padding: 10px; display: block;">[mypos_booking]</code>
        </div>
    </div>
    <?php
}
