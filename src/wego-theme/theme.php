<?
/**
*	Класс темы с преднастройкми.
*/
class Theme
{
	/**
	*	Режим отладки.
	*/
	public $debug = false;


	/**
	*	Произвольные записи.
	*/
	public $custom_posts = array(
		/*
		'post_type' => array(
			'labels' => array(
				'name'          => 'Все слайды',
				'singular_name' => 'Слайд',
				'menu_name'     => 'Слайды',
			),
			'menu_position' => 210,
			'menu_icon'     => 'dashicons-format-gallery',
		),
		см. кодекс
		*/
	);


	/**
	*	Произвольные таксономии.
	*/
	public $custom_taxonomies = array(
		/*
		'tax_name' => array(
			'labels' => array(
				'name' => 'Категории',
			),
			'hierarchical' => true,
			'post_type'    => '...',
		),
		см. кодекс
		*/
	);


	/**
	*	Произвольные поля.
	*/
	public $custom_metaboxes = array(
		/*
		'metabox_id' => array(
			'function'   => 'render_slider_fields',
			'title'      => 'Дополнительно', // Необязательно
			'context'    => 'normal', // Необязательно
			'priority'   => 'default', // Необязательно
			'post_type'  => 'slider',
			'capability' => 'edit_posts', // Необязательно (если пусто, то используется возможности от post_type)
			'allowed'    => array('time', 'link'), // Разрешенные названия мета полей, необязательно (если пусто, то допуск для всех полей)
		),
		*/
	);


	/**
	*	Произвольные статусы.
	*/
	public $custom_post_statuses = array(
		/*
		'custom_post_status' => array(
			'label'                     => 'Новый статус записи',
			'public'                    => false,
			'exclude_from_search'       => false,
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'label_count_singular'      => 'Новый статус',
			'label_count_plural'        => 'Новых стутсов',
			'post_type'                 => '',
			'show_on_listing'           => true,
		),
		см. кодекс
		*/
	);


	/**
	*	Произвольные адреса URL.
	*/
	public $custom_urls = array(
		/*
		array(
			'regex'    => '^slider/([^/])/?',
			'redirect' => 'index.php?slider_name=$matches[1]',
			'after'    => 'top',
			'template' => 'slider.php',
			'tags'     => array(
				'slider_name' => '([^/])',
			),
		),
		array(
			'regex'    => '^slider/page/([0-9]{1,})/?',
			'redirect' => 'index.php?paged=$matches[1]',
			'after'    => 'top',
			'template' => 'slider.php',
		),
		*/
	);


	/**
	*	Размеры изображений.
	*/
	public $images = array(
		/*
		'$blogslug_<thumbnail>' => array(
			'width'     => 100, // Ширина в пикселя
			'height'    => 100, // Высота в пикселя
			'crop'      => true, // Обрезка изображения, можно использовать array('left', 'top') см. кодекс (по умолчнию true - срезать по центру)
			'blog_slug' => '', // Слаг блога (по умолчанию пусто для всех сайтов с дочерней темой)
			'title'     => '', // Название изображения в админке для произвольного изображения
		),
		*/
	);


	/**
	*	Стандартное изображение (если нет встроенного в запись),
	*	где %SIZE% шаблон для размеров.
	*/
	public $default_image = 'img/image-%SIZE%.jpg';


	/**
	*	Поддержка изображений-миниатюр для записей.
	*/
	public $thumbnails = array('post');


	/**
	*	Обработчик стандартной галереи (без $this).
	*/
	public $gallery_handler = '';


	/**
	*	Зоны навигационных меню.
	*/
	public $nav_menus = array(
		'header'  => 'Шапка',
		'sidebar' => 'Боковая панель',
		'footer'  => 'Подвал',
	);


	/**
	*	Виджет-зоны.
	*/
	public $sidebars = array(
		/*
		array(
			'name'        => 'Секции',
			'id'          => 'sections',
			'description' => 'Секции сайта.',
			'blog_slug'   => 'Слаг блога',
		),
		*/
	);


	/**
	*	Виджеты (названия классов виджетов).
	*/
	public $widgets = array();


	/**
	*	Отключение стандартных виджетов.
	*/
	public $disable_default_widgets = true;


	/**
	*	Дополнительные страницы в админке.
	*/
	public $admin_pages = array(
		/*
		array(
			'title'      => 'Контакты',
			'slug'       => 'contacts',
			'capability' => 'manage_options',
			'function'   => 'admin_page_contacts',
			'icon'       => 'dashicons-location-alt',
			'position'   => 100,
			'parent'     => false,
		),
		см. кодекс
		*/
	);


	/**
	*	Скрытие кнопки "Опубликовать" для записей и их состояний (включая произвольные статусы).
	*/
	public $hide_publish_button = array(
		/*
		'post_type' => array('pending', 'published', 'draft', 'custom_status'),
		*/
	);


	/**
	*	AJAX функции.
	*/
	public $ajax = array(
		/*
		'action_name' => array(
			'function' => 'function_name',
			'private'  => false, // Только для залогиненных пользователей (по умолчанию false)
		),
		*/
	);


	/**
	*	Внешние файлы (css, js).
	*/
	public $libs = array(
		/*
		array(
			'name'       => 'identifier',
			'path'       => 'css/style.css', // Путь к файлу (для стандартных использовать wp.css или wp.js)
			'dependency' => false, // Зависимости (по умолчанию false)
			'version'    => '1.0.0', // Версия файла (по умолчанию 1.0.0)
			'in_footer'  => true, // Подключать в футере (по умолчанию true для js, false для css)
			'target'     => 'backend, frontend, all', // Где подключать файлы (по умолчанию all)
			'force_type' => 'js, css' // Тип файла (если не удалось определить автоматически)
		),
		*/
	);


	/**
	*	Внешние переменные (JavaScript).
	*	Внимание! Подключается jQuery встренный в WordPress.
	*/
	public $variables = array(
		/*
		'var_name' => array('one', 'two', 'three'),
		'hello'    => 'I\'m string!',
		*/
	);


	/**
	*	Функции CRON.
	*/
	public $cron = array(
		/*
		'function' => array(
			'timestamp'  => 'time()',
			'recurrance' => 'hourly, twicedaily, daily or custom',
			'args'       => array(),
		),
		*/
	);


	/**
	*	Расписание повторений CRON.
	*/
	public $schedules = array(
		/*
		'monthly' => array(
			'interval' => 2629743,
			'display'  => 'Каждый месяц',
		),
		*/
	);


	/**
	*	Стили для TinyMCE Advanced.
	*/
	public $tinymce_styles = array();


	/**
	*	Запретить/разрешить RSS ленту (по умолчанию запретить).
	*/
	public $rss = false;


	/**
	*	Запретить/разрешить блоговые мета-теги (по умолчанию запретить).
	*/
	public $blog_features = false;


	/**
	*	Ссылки на главную страницу, на первую запись, на предыдущую и следующую запись,
	*	а также ссылка на связь с родительской записью (по умолчанию не отображается).
	*/
	public $rel_links = false;


	/**
	*	Запретить/разрешить использование канонической ссылки (по умолчанию запретить).
	*/
	public $canonical = false;


	/**
	*	Зарезервированные названия изображений.
	*/
	private $_reserved_images = array('thumb', 'thumbnail', 'medium', 'large', 'post-thumbnail');


	/**
	*	Регистрация хуков и фильтров.
	*/
	function __construct()
	{
		// Произвольные записи
		if ($this->custom_posts) {
			add_action('init', array($this, 'register_custom_posts'));
		}

		// Произвольные таксономии
		if ($this->custom_taxonomies) {
			add_action('init', array($this, 'register_custom_taxonomies'));
		}

		// Произвольные поля для записей
		if ($this->custom_metaboxes) {
			add_action('add_meta_boxes', array($this, 'register_custom_metaboxes'));
			add_action('save_post'     , array($this, 'save_post'), 10, 3);
		}

		// Произвольные статусы для записей
		if ($this->custom_post_statuses) {
			add_action('init'                 , array($this, 'register_custom_post_statuses'));
			add_action('admin_footer-post.php', array($this, 'statuses_append_dropdown'));
			add_filter('display_post_states'  , array($this, 'statuses_posts_index'));
		}

		// Управление страницами ссылками
		if ($this->custom_urls) {
			add_action('pre_get_posts'   , array($this, 'rewrite_wp_query'), 0);
			add_action('init'            , array($this, 'rewrite_init'));
			add_filter('template_include', array($this, 'rewrite_template'), 99);
		}

		// Размеры изображений
		if ($this->images) {
			add_action('after_setup_theme'      , array($this, 'images_setup'));
			add_filter('image_size_names_choose', array($this, 'images_admin_choose'));
		}

		// Поддержка миниатюр для записей
		if ($this->thumbnails) {
			add_action('after_setup_theme', array($this, 'thumbnails_support'));
		}

		// Стандартное изображение
		if ($this->default_image && !defined('DEFAULT_IMAGE')) {
			define('DEFAULT_IMAGE', $this->default_image);
		}

		// Собственный обработчик для галереи
		if ($this->gallery_handler) {
			add_filter('post_gallery', array($this, $this->gallery_handler), 10, 2);
		}

		// Навигационные меню
		if ($this->nav_menus) {
			add_action('after_setup_theme', array($this, 'register_nav_menus'));
		}

		// Виджет-зоны (сайдбары)
		if ($this->sidebars) {
			add_action('after_setup_theme', array($this, 'register_sidebars'));
		}
		
		// Регистрация произвольных виджетов
		if ($this->widgets) {
			add_action('widgets_init', array($this, 'register_widgets'), 10);
		}

		// Отключение стандартных виджетов
		if ($this->disable_default_widgets) {
			add_action('widgets_init', array($this, 'unregister_default_widgets'), 11);
		}

		// Страницы в админке
		if ($this->admin_pages) {
			add_action('admin_menu', array($this, 'register_pages'));
		}

		// Скрытие кнопки "Опубликовать" для записей
		if ($this->hide_publish_button) {
			add_action('admin_head', array($this, 'hide_publish_button'));
		}

		// Регистрация AJAX функций
		if ($this->ajax) {
			foreach ($this->ajax as $action => $args) {
				$args = wp_parse_args($args, array('private' => false));

				if (empty($args['function'])) {
					if ($this->debug) {
						$message = sprintf('Не указано название функции обратного вызова для %s.', $action);
						wp_die($message, __FUNCTION__);
					} else {
						continue;
					}
				}

				add_action('wp_ajax_' . $action, array($this, $args['function']));
				if (!$args['private']) {
					add_action('wp_ajax_nopriv_' . $action, array($this, $args['function']));
				}
			}
		}

		// Подключение внешних файлов
		if ($this->libs) {
			add_action('wp_enqueue_scripts'   , array($this, 'enqueue_scripts'));
			add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
		}

		// Подключение переменных для JavaScript
		if ($this->variables) {
			add_action('wp_enqueue_scripts'   , array($this, 'enqueue_variables'));
			add_action('admin_enqueue_scripts', array($this, 'enqueue_variables'));
		}

		// Функции CRON
		if ($this->cron) {
			foreach ($this->cron as $cron_name => $args) {
				add_action($cron_name, array($this, $cron_name));

				// Регистрация события в таблице CRON
				if (!wp_next_scheduled($cron_name)) {
					$args = wp_parse_args($args, array(
						'timestamp'  => time(),
						'recurrance' => 'daily',
						'args'       => array(),
					));
					wp_schedule_event($args['timestamp'], $args['recurrance'], $cron_name, $args['args']);
				}
			}
		}

		// Фильтрация расписания CRON
		if ($this->schedules) {
			add_filter('cron_schedules', array($this, 'cron_schedules'));
		}

		// Дополнение стилей для TinyMCE Advanced
		if ($this->tinymce_styles) {
			add_filter('mce_css', array($this, 'tinymce_style'));
		}

		// Заголовок
		add_filter('wp_title', array($this, 'filter_title'), 10, 2);

		// Отключение стиля стандартной галереи и админ бара
		add_filter('use_default_gallery_style', '__return_false');
		add_filter('show_admin_bar'           , '__return_false');

		// Отключение мета-тегов в заголовке
		remove_action('wp_head', 'wp_generator');

		// Отключение RSS ленты
		if (!$this->rss) {
			remove_action('wp_head', 'feed_links_extra', 3);
			remove_action('wp_head', 'feed_links', 2);
		}

		// Блоговые мета-теги
		if (!$this->blog_features) {
			remove_action('wp_head', 'rsd_link');
			remove_action('wp_head', 'wlwmanifest_link');
		}

		// Доаолнительные ссылки
		if (!$this->rel_links) {
			remove_action('wp_head', 'index_rel_link');
			remove_action('wp_head', 'parent_post_rel_link', 10, 0);
			remove_action('wp_head', 'start_post_rel_link', 10, 0);
			remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
		}

		// Каноническая ссылка
		if (!$this->canonical) {
			remove_action('wp_head', 'rel_canonical');
		}
	}


	/**
	*	Изменение расписание крона.
	*	@param array $schedules Массив интервалов крона.
	*	@return array Модифицированный массив интервалов крона.
	*/
	public function cron_schedules($schedules)
	{
		$schedules = array_merge($schedules, $this->schedules);
		return $schedules;
	}


	/**
	*	Подключение скриптов и таблиц стилей.
	*	@return void.
	*/
	public function enqueue_scripts()
	{
		$uri = get_template_directory_uri();
		$action = current_filter();

		$defaults = array(
			'version'    => '1.0.0',
			'dependency' => false,
			'target'     => 'all',
			'script'     => false,
		);

		foreach ($this->libs as $args) {
			$args = wp_parse_args($args, $defaults);

			// Путь и имя файла
			if (empty($args['path']) || empty($args['name'])) {
				if ($this->debug) {
					$message = sprintf('Путь (%s) или имя файла (%s) не найдено.', $args['path'], $args['name']);
					wp_die($message, __FUNCTION__);
				} else {
					continue;
				}
			}

			// URI к файлу
			if (preg_match('/^http/', $args['path'])) {
				$target_uri = $args['path'];
			} else {
				if ($args['path'][0] != '/') {
					$args['path'] = '/' . $args['path'];
				}

				$target_uri = $uri . $args['path'];
			}

			// Проскок не тех хуков
			if (($action == 'wp_enqueue_scripts') && ($args['target'] != 'all') && ($args['target'] != 'frontend')) {
				continue;
			} elseif (($action == 'admin_enqueue_scripts') && ($args['target'] != 'all') && ($args['target'] != 'backend')) {
				continue;
			}

			$ext = pathinfo($args['path'], PATHINFO_EXTENSION);
			$filename = pathinfo($args['path'], PATHINFO_FILENAME);

			if (!$ext && isset($args['force_type'])) {
				$ext = $args['force_type'];
			}

			if ($ext == 'js') {
				if (!isset($args['in_footer'])) {
					$args['in_footer'] = true;
				}

				if ($filename != 'wp') {
					$result = wp_register_script($args['name'], $target_uri, $args['dependency'], $args['version'], $args['in_footer']);

					if (!$result && $this->debug) {
						$message = sprintf('Не удалось зарегистрировать скрипт "%s".', $args['name']);
						wp_die($message, __FUNCTION__);
					}
				}

				wp_enqueue_script($args['name']);
			} else {
				if (!isset($args['in_footer'])) {
					$args['in_footer'] = false;
				}

				if ($filename != 'wp') {
					$result = wp_register_style($args['name'], $target_uri, $args['dependency'], $args['version'], $args['in_footer']);

					if (!$result && $this->debug) {
						$message = sprintf('Не удалось зарегистрировать стиль "%s".', $args['name']);
						wp_die($message, __FUNCTION__);
					}
				}

				wp_enqueue_style($args['name']);
			}
		}
	}


	/**
	*	Подключение переменных JavaScript.
	*	@return void.
	*/
	public function enqueue_variables()
	{
		wp_enqueue_script('jquery');

		foreach ($this->variables as $var_name => $data) {
			$result = wp_localize_script('jquery', $var_name, $data);

			if (!$result && $this->debug) {
				$message = sprintf('Не удалось вывести JavaScript переменную "%s"', $var_name);
				wp_die($message, __FUNCTION__);
			}
		}
	}


	/**
	*	Фильтрация заголовка страницы.
	*	@param string $title Заголовок страницы.
	*	@param string $sep Разделитель.
	*	@return string Возвращает модифицированный заголовок.
	*/
	public function filter_title($title, $sep)
	{
		if (is_feed()) {
			return $title;
		}

		if (empty($title)) {
			$title = get_bloginfo('blogname');
			$desc  = get_bloginfo('description');
			if ($desc) {
				$title .= ' &mdash; ' . get_bloginfo('description');
			}
		} else {
			$title = $title . ' &mdash; ' . get_bloginfo('blogname');
		}

		return $title;
	}


	/**
	*	Вывод имени поля в метабоксе.
	*	@param array $metabox_args Массив аругментов метабокса.
	*	@param string $name Заданное имя поля.
	*	@return void.
	*/
	public function get_name($metabox_args, $name)
	{
		$name      = '[' . $name . ']';
		$id        = isset($metabox_args['args']['id']) ? '[' . $metabox_args['args']['id'] . ']' : '';
		$post_type = isset($metabox_args['args']['post_type']) ? $metabox_args['args']['post_type'] : '';

		echo $post_type . $id . $name;
	}


	/**
	*	Вывод поля nonce.
	*	@param array $metabox_args Массив аругментов метабокса.
	*	@return void.
	*/
	public function get_nonce($metabox_args)
	{
		$id = isset($metabox_args['args']['id']) ? $metabox_args['args']['id'] : '';

		wp_nonce_field('nonce_' . $id, 'nonce_' . $id);
	}


	/**
	*	Скрытие кнопки "Опубликовать" для записей.
	*	@return void.
	*/
	public function hide_publish_button()
	{
		global $post;

		foreach ($this->hide_publish_button as $post_type => $post_statuses) {
			if (($post->post_type == $post_type) && in_array($post->post_status, $post_statuses)) {
				echo '<style>#publishing-action {display:none;}</style>';
				break;
			}
		}
	}


	/**
	*	Настройка изображений.
	*	@return void.
	*/
	public function images_setup()
	{
		// Получение слага текущего сайта
		$current_blog_slug = Mtools::get_blog_slug();

		foreach ($this->images as $size => $args) {
			// Проверка размеров
			$args['width'] = intval($args['width']);
			$args['height'] = intval($args['height']);

			if (empty($args['width']) || empty($args['height'])) {
				if ($this->debug) {
					$message = sprintf('Высота или ширина изображения "%s" не задана.', $size);
					wp_die($message, __FUNCTION__);
				} else {
					continue;
				}
			}

			// Стандартные параметры
			$args = wp_parse_args($args, array(
				'crop'      => true,
				'blog_slug' => '',
			));

			// Пропуск не того блога
			if ($args['blog_slug']) {
				if ($args['blog_slug'] != $current_blog_slug) {
					continue;
				}

				$size = str_replace($args['blog_slug'] . '_', '', $size);
			}

			// Настройка встроенных изображений
			if (in_array($size, $this->_reserved_images)) {
				$width  = get_option($size . '_size_w');
				$height = get_option($size . '_size_h');
				$crop   = get_option($size . '_crop');

				if ($width != $args['width']) {
					update_option($size . '_size_w', $args['width']);
				}
				if ($height != $args['height']) {
					update_option($size . '_size_h', $args['height']);
				}
				if ($crop != $args['crop']) {
					update_option($size . '_crop', $args['crop']);
				}
			} else {
				add_image_size($size, $args['width'], $args['height'], $args['crop']);
			}
		}
	}


	/**
	*	Отображение произвольных размеров изображений в админке.
	*	@param array $sizes Массив размеров и названий.
	*	@return void.
	*/
	public function images_admin_choose($sizes)
	{
		$custom_sizes = array();

		foreach ($this->images as $size => $args) {
			if (!in_array($size, $this->_reserved_images)) {
				$title = empty($args['title']) ? $size : $args['title'];
				$custom_sizes[$size] = $title;
			}
		}

		return array_merge($sizes, $custom_sizes);
	}


	/**
	*	Модификация WP_Query для произвольных шаблонов.
	*	@param object $wp_query Ссылка на объект WP_Query.
	*	@return void.
	*/
	public function rewrite_wp_query($wp_query)
	{
		// Модификация только основного цикла
		if (!$wp_query->is_main_query()) {
			return;
		}

		if (empty($wp_query->query_vars['template'])) {
			return;
		}

		// Поиск по шаблону
		foreach ($this->custom_urls as $rule) {
			if ($rule['template'] == $wp_query->query_vars['template']) {
				$wp_query->is_page = true;
				$wp_query->is_home = false;
				return;
			}
		}

		// Такой шаблон не найден в списке разрешенных
		$wp_query->is_404  = true;
		$wp_query->is_home = false;
	}


	/**
	*	Добавление правил ссылок.
	*	@return void.
	*/
	public function rewrite_init()
	{
		add_rewrite_tag('%template%', '([^/]+)');

		foreach ($this->custom_urls as $rule) {
			if (empty($rule['regex']) || empty($rule['redirect'])) {
				continue;
			}

			if (!empty($rule['template'])) {
				$rule['redirect'] .= strstr($rule['redirect'], '?') ? '&' : '?';
				$rule['redirect'] .= 'template=' . $rule['template'];
			}

			$rule['after'] = empty($rule['after']) ? 'bottom' : $rule['after'];
			add_rewrite_rule($rule['regex'], $rule['redirect'], $rule['after']);

			if (!empty($rule['tags'])) {
				foreach ($rule['tags'] as $tag => $regex) {
					add_rewrite_tag('%' . $tag . '%', $regex);
				}
			}
		}
	}


	/**
	*	Перенаправление на произвольный шаблон.
	*	@param string $template Файл шаблона для текущей страницы.
	*	@return string Возвращает путь к файлу шаблона.
	*/
	public function rewrite_template($template)
	{
		foreach ($this->custom_urls as $rule) {
			if (empty($rule['template'])) {
				continue;
			}

			$query_template = get_query_var('template', false);
			if (!$query_template) {
				continue;
			}

			if ($query_template != $rule['template']) {
				continue;
			}

			$new_template = locate_template(array($rule['template']));

			if ($new_template) {
				return $new_template;
			}
		}

		return $template;
	}


	/**
	*	Регистрация страниц админки.
	*/
	public function register_pages()
	{
		foreach ($this->admin_pages as $admin_page) {
			if (empty($admin_page['slug']) || empty($admin_page['function'])) {
				if ($this->debug) {
					$message = sprintf('Идентификатор страницы (%s) или функция (%s) пусты.', $admin_page['slug'], $admin_page['function']);
					wp_die($message, __FUNCTION__);
				}
				continue;
			}

			$title      = empty($admin_page['title']) ? 'Без заголовка' : $admin_page['title'];
			$icon       = empty($admin_page['icon']) ? '' : $admin_page['icon'];
			$position   = empty($admin_page['position']) ? '' : $admin_page['position'];
			$capability = empty($admin_page['capability']) ? 'manage_options' : $admin_page['capability'];

			if (isset($admin_page['parent']) && $admin_page['parent']) {
				add_submenu_page($admin_page['parent'], $title, $title, $capability, $admin_page['slug'], array($this, $admin_page['function']));
			} else {
				add_menu_page($title, $title, $capability, $admin_page['slug'], array($this, $admin_page['function']), $icon, $position);
			}
			
		}
	}


	/**
	*	Регистрация произвольных записей.
	*	@return void.
	*/
	public function register_custom_posts()
	{
		// Значения по умолчанию
		$default_label = array(
			'add_new'            => 'Добавить',
			'add_new_item'       => 'Добавить',
			'edit_item'          => 'Редактировать',
			'new_item'           => 'Новые',
			'view_item'          => 'Посмотреть',
			'search_items'       => 'Найти',
			'not_found'          => 'Ничего не найдено',
			'not_found_in_trash' => 'В корзине ничего не найдено',
			'parent_item_colon'  => '',
		);

		$default_args = array(
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'show_in_nav_menus'  => true,
			'supports'           => array('title', 'editor', 'thumbnail'),
		);

		// Регистрация всех постов
		foreach ($this->custom_posts as $post_type => $args) {
			$label = empty($args['labels']) ? array() : $args['labels'];
			$label = wp_parse_args($label, $default_label);
			$args['labels'] = $label;

			$args = wp_parse_args($args, $default_args);
			$result = register_post_type($post_type, $args);

			if (is_wp_error($result) && $this->debug) {
				$message = sprintf('Не удалось зарегистрировать запись "%s" по причине: %s.', $post_type, $result->get_error_message());
				wp_die($message, __FUNCTION__);
			}
		}
	}


	/**
	*	Регистрация произвольных таксономий.
	*	@return void.
	*/
	public function register_custom_taxonomies()
	{
		// Значения по умолчанию
		$default_label = array(
			'name'              => 'Категории',
			'singular_name'     => 'Категория',
			'search_items'      => 'Найти категорию',
			'all_items'         => 'Все категории',
			'parent_item'       => 'Родительский элемент',
			'parent_item_colon' => 'Родительский элемент',
			'edit_item'         => 'Родительский элемент',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить новую',
			'new_item_name'     => 'Название новой категории',
			'menu_name'         => 'Категории',
		);

		$default_args = array(
			'labels'       => $default_label,
			'hierarchical' => true
		);

		// Регистрация
		foreach ($this->custom_taxonomies as $taxonomy => $args) {
			$label = empty($args['label']) ? array() : $args['label'];
			$label = wp_parse_args($label, $default_label);
			$args['label'] = $label;

			$post_type = empty($args['post_type']) ? '' : $args['post_type'];
			unset($args['post_type']);

			$args = wp_parse_args($args, $default_args);
			$result = register_taxonomy($taxonomy, $post_type, $args);

			if (is_wp_error($result) && $this->debug) {
				$message = sprintf('Не удалось зарегистрировать таксономию "%s" по причине: %s.', $post_type, $result->get_error_message());
				wp_die($message, __FUNCTION__);
			}
		}
	}


	/**
	*	Регистрация произвольных метабоксов для записей.
	*	@return void.
	*/
	public function register_custom_metaboxes()
	{
		foreach ($this->custom_metaboxes as $id => $args) {

			if (empty($args['post_type']) || empty($args['function'])) {
				continue;
			}

			$args = wp_parse_args($args, array(
				'title'      => 'Дополнительно',
				'context'    => 'normal',
				'priority'   => 'default',
				'capability' => '',
			));

			$function = array($this, $args['function']);
			$arguments = array('id' => $id, 'post_type' => $args['post_type']);
			$capability = empty($args['capability']) ? '' : $args['capability'];

			if (!$args['capability'] || ($args['capability'] && current_user_can($args['capability']))) {
				add_meta_box($id, $args['title'], $function, $args['post_type'], $args['context'], $args['priority'], $arguments);
			}
		}
	}


	/**
	*	Регистрация произвольных статусов для записей.
	*	@return void.
	*/
	public function register_custom_post_statuses()
	{
		$count_label = ' <span class="count">(%s)</span>';
		foreach ($this->custom_post_statuses as $post_status => $args) {
			$args = wp_parse_args($args, array(
				'label'                     => 'Новый статус',
				'public'                    => false,
				'exclude_from_search'       => false,
				'show_in_admin_all_list'    => true,
				'show_in_admin_status_list' => true,
				'label_count_singular'      => 'Новый статус',
				'label_count_plural'        => 'Новых статусов',
				'post_type'                 => '',
				'show_on_listing'           => true,
			));
			$args['label_count'] = _n_noop(
				$args['label_count_singular'] . $count_label,
				$args['label_count_plural'] . $count_label
			);
			$this->custom_post_statuses[$post_status] = $args;
			register_post_status($post_status, $args);
		}
	}


	/**
	*	Регистрация навигационных меню.
	*	@return void.
	*/
	public function register_nav_menus()
	{
		//
		register_nav_menus($this->nav_menus);
	}


	/**
	*	Регистрация виджет-зон (сайдбары).
	*	@return void.
	*/
	public function register_sidebars()
	{
		$defaults = array(
			'name'          => '',
			'id'            => '',
			'description'   => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
			'blog_slug'     => '',
		);

		// Для мультисайт регистрации зон
		$current_blog_slug = Mtools::get_blog_slug();

		foreach ($this->sidebars as $sidebar) {
			$args = wp_parse_args($sidebar, $defaults);

			if ($args['blog_slug']) {
				if ($args['blog_slug'] == $current_blog_slug) {
					register_sidebar($args);
				}
			} else {
				register_sidebar($args);
			}
		}
	}


	/**
	*	Регистрация виджетов.
	*	@return void.
	*/
	public function register_widgets()
	{
		foreach ($this->widgets as $widget) {
			if (class_exists($widget)) {
				register_widget($widget);
				continue;
			}

			if ($this->debug) {
				$message = sprintf('Класс "%s" отсутствует.', $widget);
				wp_die($message, __FUNCTION__);
			}
		}
	}


	/**
	*	Сохранение произвольных полей для записей.
	*	@param int $post_id Идентификатор записи.
	*	@param object $post Объект записи.
	*	@param bool $update Идет обновление существующей записи или создание новой.
	*	@return int|bool В случае успеха возвращает идентификатор записи, иначе false.
	*/
	public function save_post($post_id, $post, $update)
	{
		// Проверка автосохранения
		if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)) {
			return false;
		}

		// Проверка ревизии
		if (wp_is_post_revision($post_id)) {
			return false;
		}

		// Сохранение каждого метабокса (в одной записи может быть несколько метабоксов)
		foreach ($this->custom_metaboxes as $id => $args) {

			if (@$args['post_type'] != $post->post_type) {
				continue;
			}

			// Права пользователя на сохранение метабокса
			$capability = empty($args['capability']) ? '' : $args['capability'];

			if ($capability && !current_user_can($capability)) {
				continue;
			}

			// Проверка nonce
			$nonce = 'nonce_' . $id;
			if (isset($_POST[$nonce]) && !wp_verify_nonce($_POST[$nonce], $nonce)) {
				continue;
			}

			// Данные
			if (empty($_POST[$post->post_type][$id]) && !is_array($_POST[$post->post_type][$id])) {
				continue;
			}

			$data = $_POST[$post->post_type][$id];

			foreach ($data as $field => $value) {

				// Пропуск не разрешенных полей
				if (!empty($args['allowed']) && !in_array($field, $args['allowed'])) {
					continue;
				}

				// Сохранение в БД
				if (is_numeric($value)) {
					update_post_meta($post_id, $field, $value);
				} else {
					if (is_string($value)) {
						$value = trim($value);
					}

					if (empty($value)) {
						delete_post_meta($post_id, $field);
					} else {
						update_post_meta($post_id, $field, $value);
					}
				}
			}
		}

		return $post_id;
	}


	/**
	*	Отображение статусов в админке.
	*	@return void.
	*/
	public function statuses_append_dropdown()
	{
		global $post;
		$script = array();

		foreach ($this->custom_post_statuses as $post_status => $args) {
			$args['post_type'] = empty($args['post_type']) ? $post->post_type : $args['post_type'];
			$selected = '';
			$label    = '';

			if ($args['post_type'] == $post->post_type) {
				if ($post->post_status == $post_status) {
					$selected = 'selected';
					$script[] = sprintf('$("#post-status-display").text("%s");', $args['label']);
				}

				$script[] = sprintf('$("#post_status").append(\'<option value="%s" %s>%s</option>\');', $post_status, $selected, $args['label']);
			}
		}

		if (!empty($script)) {
			$script = implode("\r\n", $script);
			printf('<script>jQuery(document).ready(function($){%s});</script>', $script);
		}
	}


	/**
	*	Отображение произвольных статусов в листинге записей.
	*	@param array $states Массив названий статусов.
	*	@return array Возвращает модифицированный массив статусов.
	*/
	public function statuses_posts_index($states)
	{
		global $post;
		$query_var = get_query_var('post_status');

		foreach ($this->custom_post_statuses as $post_status => $args) {
			if ($args['show_on_listing'] && ($query_var != $post_status) && ($post->post_status == $post_status)) {
				return array($args['label']);
			}
		}

		return $states;
	}


	/**
	*	Дополнение стилей TinyMCE Advanced.
	*	@param string $styles Строка стилей разделенная запятой.
	*	@return string Возвращается модифицированная строка.
	*/
	public function tinymce_style($styles)
	{
		foreach ($this->tinymce_styles as $style) {
			$styles .= ',' . get_template_directory_uri() . $style;
		}

		return $styles;
	}


	/**
	*	Подключение поддержки миниатюр.
	*	@return void.
	*/
	public function thumbnails_support()
	{
		add_theme_support('post-thumbnails', $this->thumbnails);
	}


	/**
	*	Удаление стандартных виджетов.
	*	@return void.
	*/
	public function unregister_default_widgets()
	{
		$widgets = array(
			'WP_Widget_Pages', 'WP_Widget_Calendar', 'WP_Widget_Archives', 'WP_Widget_Links', 'WP_Widget_Meta',
			'WP_Widget_Search', 'WP_Widget_Text', 'WP_Widget_Categories', 'WP_Widget_Recent_Posts',
			'WP_Widget_Recent_Comments', 'WP_Widget_RSS', 'WP_Widget_Tag_Cloud', 'WP_Nav_Menu_Widget'
		);

		foreach ($widgets as $widget) {
			unregister_widget($widget);
		}
	}
}