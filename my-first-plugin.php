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

// Регистрируем настройки плагина
add_action( 'admin_init', 'my_first_plugin_settings_init' );

function my_first_plugin_settings_init() {
    // Регистрируем новую настройку
    register_setting( 'general', 'my_first_plugin_footer_text' );

    // Добавляем секцию (можно добавить в существующие)
    add_settings_section(
        'my_first_plugin_section',
        'Настройки моего первого плагина',
        'my_first_plugin_section_callback',
        'general'
    );

    // Добавляем поле ввода
    add_settings_field(
        'my_first_plugin_field',
        'Текст в подвале сайта',
        'my_first_plugin_field_callback',
        'general',
        'my_first_plugin_section'
    );
}

// Функция-колбэк для описания секции
function my_first_plugin_section_callback() {
    echo '<p>Здесь вы можете настроить текст, который отображается в подвале сайта.</p>';
}

// Функция-колбэк для вывода поля ввода
function my_first_plugin_field_callback() {
    // Получаем значение из базы данных
    $value = get_option( 'my_first_plugin_footer_text', 'Сайт работает на моём первом плагине!' );
    // Выводим HTML-поле
    echo '<input type="text" name="my_first_plugin_footer_text" value="' . esc_attr( $value ) . '" class="regular-text">';
}

// Добавляем текст в подвал сайта
add_action( 'wp_footer', 'my_first_plugin_add_footer_text' );

function my_first_plugin_add_footer_text() {
    // Получаем текст из настроек. Если его нет, используем текст по умолчанию.
    $footer_text = get_option( 'my_first_plugin_footer_text', 'Сайт работает на моём первом плагине!' );
    // Выводим текст, экранируя спецсимволы для безопасности
    echo '<p style="text-align: center; padding: 10px;">' . esc_html( $footer_text ) . '</p>';
}