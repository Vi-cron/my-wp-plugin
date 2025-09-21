<?php
/**
 * Plugin Name:       Мой Первый Плагин
 * Plugin URI:        https://github.com/Vi-cron/my-wp-plugin
 * Description:       Это мой первый плагин для WordPress. Он выводит текст в футере.
 * Version:           1.1.0
 * Author:            Victor
 * License:           GPL v2 or later
 * Text Domain:       my-first-plugin
 * Requires PHP:      7.4
 */

// Защищаемся от прямого вызова
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Автозагрузка классов (если будем добавлять больше классов)
// require_once __DIR__ . '/vendor/autoload.php';

/**
 * Главная функция для инициализации плагина
 *
 * @return My_First_Plugin
 */
function my_first_plugin() {
    return My_First_Plugin::get_instance();
}

// Запускаем плагин
add_action( 'plugins_loaded', 'my_first_plugin_init' );

function my_first_plugin_init() {
    // Подключаем главный класс
    require_once __DIR__ . '/includes/class-my-first-plugin.php';
    
    // Инициализируем плагин
    my_first_plugin();
}