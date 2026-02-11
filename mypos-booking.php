<?php
/**
 * Plugin Name: Mypos Booking Integration
 * Description: Integra tu sistema de reservas Mypos Connect en WordPress
 * Version: 1.0.0
 * Author: Tu Nombre
 * License: MIT
 * Text Domain: mypos-booking
 */

if (!defined('ABSPATH')) exit;

define('MYPOS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MYPOS_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once MYPOS_PLUGIN_DIR . 'includes/embed-handler.php';
require_once MYPOS_PLUGIN_DIR . 'admin/menu.php';

add_action('init', function() {
    add_shortcode('mypos_booking', 'mypos_booking_shortcode');
});

add_action('admin_enqueue_scripts', function() {
    wp_enqueue_style('mypos-admin', MYPOS_PLUGIN_URL . 'assets/css/admin-styles.css');
    wp_enqueue_script('mypos-admin', MYPOS_PLUGIN_URL . 'assets/js/admin-script.js', ['jquery']);
});

register_activation_hook(__FILE__, function() {
    add_option('mypos_app_url', 'https://mypos-connect--jwpcelias.replit.app');
    add_option('mypos_iframe_width', '100%');
    add_option('mypos_iframe_height', '800px');
});

register_deactivation_hook(__FILE__, function() {
    // No eliminar opciones para preservar configuración
});
