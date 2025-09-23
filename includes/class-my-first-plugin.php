<?php
/**
 * Главный класс плагина
 *
 * @package My_First_Plugin
 */

// Защищаемся от прямого вызова
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Класс My_First_Plugin
 * Управляет всей основной функциональностью плагина
 */
class My_First_Plugin
{

	/**
	 * Экземпляр класса (реализация Singleton)
	 *
	 * @var My_First_Plugin
	 */
	private static $instance = null;

	/**
	 * Версия плагина
	 *
	 * @var string
	 */
	public $version = '1.1.0';

	/**
	 * Получить экземпляр класса (Singleton)
	 *
	 * @return My_First_Plugin
	 */
	public static function get_instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Конструктор класса
	 * Регистрирует все хуки действий и фильтров
	 */
	private function __construct()
	{
		$this->define_constants();
		$this->init_hooks();
	}

	/**
	 * Определение констант плагина
	 */
	private function define_constants()
	{
		define('MFP_VERSION', $this->version);
		define('MFP_PLUGIN_URL', plugin_dir_url(__DIR__));
		define('MFP_PLUGIN_PATH', plugin_dir_path(__DIR__));
	}

	/**
	 * Инициализация всех хуков
	 */
	private function init_hooks()
	{
		// Хуки для фронтенда
		add_action('wp_footer', array($this, 'add_footer_text'));

		// Подключение стилей и скриптов
		add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));

		// Хуки для админки
		add_action('admin_init', array($this, 'register_settings'));
	}

	/**
	 * Регистрирует и подключает стили и скрипты
	 */
	public function enqueue_assets()
	{
		// Регистрируем CSS файл
		wp_register_style(
			'mfp-frontend-style',
			MFP_PLUGIN_URL . 'assets/css/frontend.css',
			array(), // Зависимости (нет)
			MFP_VERSION // Версия для инвалидации кеша
		);

		// Подключаем CSS на фронтенде
		if (!is_admin()) {
			wp_enqueue_style('mfp-frontend-style');
		}
	}


	/**
	 * Добавляет текст в подвал сайта
	 */
	public function add_footer_text()
	{
		$footer_text = get_option('my_first_plugin_footer_text', 'Сайт работает на моём первом плагине!');

		// Добавляем CSS-класс для стилизации
		echo '<p class="mfp-footer-text">' . esc_html($footer_text) . '</p>';
	}


	/**
	 * Регистрирует настройки плагина
	 */
	public function register_settings()
	{
		register_setting('general', 'my_first_plugin_footer_text');

		add_settings_section(
			'my_first_plugin_section',
			'Настройки моего первого плагина',
			array($this, 'render_settings_section'),
			'general'
		);

		add_settings_field(
			'my_first_plugin_field',
			'Текст в подвале сайта',
			array($this, 'render_settings_field'),
			'general',
			'my_first_plugin_section'
		);
	}

	/**
	 * Выводит описание секции настроек
	 */
	public function render_settings_section()
	{
		echo '<p>Здесь вы можете настроить текст, который отображается в подвале сайта.</p>';
	}

	/**
	 * Выводит поле ввода для настроек
	 */
	public function render_settings_field()
	{
		$value = get_option('my_first_plugin_footer_text', 'Сайт работает на моём первом плагине!');
		echo '<input type="text" name="my_first_plugin_footer_text" value="' . esc_attr($value) . '" class="regular-text">';
	}
}

?>