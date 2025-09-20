<?php
/**
 * Plugin Name:       Мой Первый Плагин
 * Plugin URI:        https://example.com/my-first-plugin
 * Description:       Это мой первый плагин для WordPress. Он выводит текст в футере.
 * Version:           1.0.0
 * Author:            Ваше Имя
 * License:           GPL v2 or later
 * Text Domain:       my-first-plugin
 */

// Добавляем текст в подвал сайта
add_action( 'wp_footer', 'my_first_plugin_add_footer_text' );

function my_first_plugin_add_footer_text() {
    echo '<p style="text-align: center; padding: 10px;">Сайт работает на моём первом плагине!</p>';
}