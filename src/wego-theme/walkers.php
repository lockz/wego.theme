<?
/**
*	Универсальный валкер для навигационного меню.
*/
class WalkerNav extends Walker_Nav_Menu
{
	/**
	*	Классы.
	*/
	private $_classes = array();


	/**
	*	Создание валкера.
	*	@param array $args Массив названий классов.
	*	@return void.
	*/
	function __construct($args = array())
	{
		$defaults = array(
			'ul'             => 'nav-child',
			'li'             => 'nav-item',
			'a'              => 'nav-item-link',
			'current'        => '_current',
			'current_parent' => '_current-parent',
		);

		$args = wp_parse_args($args, $defaults);
		$this->_classes = $args;
	}


	/**
	*	Открытие тега <ul>.
	*	@param string $output Ссылка на выходной код html.
	*	@param int $depth Вложенность меню (начинается с нуля). Используется для табуляции.
	*	@param array $args Дополнительные аргументы.
	*/
	public function start_lvl(&$output, $depth = 0, $args = array())
	{
		// Fold
		$output .= '<ul class="' . $this->_classes['ul'] . '">';
	}


	/**
	*	Закрытие тега <ul>.
	*	@param string $output Ссылка на выходной код html.
	*	@param int $depth Вложенность меню (начинается с нуля). Используется для табуляции.
	*	@param array $args Дополнительные аргументы.
	*/
	public function end_lvl(&$output, $depth = 0, $args = array())
	{
		// Fold
		$output .= '</ul>';
	}


	/**
	*	Открытие тега <li>.
	*	@param pointer $output Ссылка на выходной текст html.
	*	@param object $item Объект текущего пункта меню.
	*	@param int $depth Вложенность меню (начинается с нуля).
	*	@param array $args Дополнительные аргументы.
	*	@param array $id Идентификатор текущего пункта меню.
	*	@return void.
	*/
	public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		// Классы
		$classes = array($this->_classes['li'], $this->_classes['li'] . '-' . $item->ID);
		if (!empty($item->classes) && ($item->classes[0])) {
			$classes[] = $item->classes[0];
		}

		if ($item->current) {
			$classes[] = $this->_classes['current'];

		// Фикс для урл'ных пунктов меню в мультисайте
		} elseif ($item->type == 'custom' && defined('WP_ALLOW_MULTISITE') && WP_ALLOW_MULTISITE) {

			global $blog_id;

			// Субдоменная установка
			if (defined('SUBDOMAIN_INSTALL') && SUBDOMAIN_INSTALL) {
				$current_blog_id = $blog_id;
				restore_current_blog();
				$current  = strtolower(trim(get_option('siteurl'), '/'));
				$item_url = strtolower(trim($item->url, '/'));
				switch_to_blog($current_blog_id);
				if ($current == $item_url) {
					$classes[] = $this->_classes['current'];
				}

			// Субдиректориальная установка
			} else {
				$current_blog_id = $blog_id;
				restore_current_blog();
				$current_url = strtolower(trim(get_option('siteurl'), '/'));
				switch_to_blog($current_blog_id);
				$home_url = strtolower(trim(get_option('siteurl'), '/'));
				$item_url = strtolower(trim($home_url . $item->url, '/'));

				if (($current_url == $item_url) && ($home_url != $item_url)) {
					$classes[] = $this->_classes['current'];
				}
			}

		// Current для архивных страниц и иерархических страниц
		} else {
			$url  = ('on' == $_SERVER['HTTPS']) ? 'https://' : 'http://';
			$url .= $_SERVER['SERVER_NAME'];
			$url .= ('80' == $_SERVER['SERVER_PORT']) ? '' : ':' . $_SERVER['SERVER_PORT'];
			$url .= $_SERVER['REQUEST_URI'];
			$url  = trailingslashit($url);
			$homepage_url = trailingslashit(get_bloginfo('url'));

			if (!is_404() && ($item->url != $homepage_url) && ($item->url != '/') && ($item->url) && strstr($url, $item->url)) {
				$classes[] = $this->_classes['current'];
			}

			if ($item->current_item_parent) {
				$classes[] = $this->_classes['current_parent'];
			}
		}

		$classes = esc_attr(implode(' ', $classes));

		// Ссылка
		$link = '<a class="' . $this->_classes['a'] . '"';
		(!empty($item->attr_title)) && ($link .= ' title="' . esc_attr($item->attr_title) . '"');
		(!empty($item->target)) && ($link .= ' target="' . esc_attr($item->target) . '"');
		(!empty($item->xfn)) && ($link .= ' rel="' . esc_attr($item->xfn) . '"');
		(!empty($item->url)) && ($link .= ' href="' . esc_url($item->url) . '"');
		$link .= '>' . $item->title . '</a>';

		$output .= '<li class="' . $classes . '">' . $link . '</li>';
	}


	/**
	*	Завершение тега <li>.
	*	@param string $output Ссылка на выходной код HTML.
	*	@param object $page Не используется.
	*	@param int $depth Не используется.
	*	@param array $args Не используется.
	*	@return void.
	*/
	public function end_el(&$output, $page, $depth = 0, $args = array())
	{
		// Fold
		$output .= '</li>';
	}
}


/**
*	Универсальный валкер для категорий.
*/
class WalkerCategory extends Walker_Category
{
	/**
	*	Классы.
	*/
	private $_classes = array();


	/**
	*	Создание валкера.
	*	@param array $args Массив названий классов.
	*	@return void.
	*/
	function __construct($args = array())
	{
		$defaults = array(
			'ul'             => 'categories-child',
			'li'             => 'categories-item',
			'a'              => 'categories-item-link',
			'counter'        => 'categories-item-counter',
			'current'        => '_current',
			'current_parent' => '_current-parent',
		);

		$args = wp_parse_args($args, $defaults);
		$this->_classes = $args;
	}


	/**
	*	Открытие тега <ul>.
	*	@param string $output Ссылка на выходной код html.
	*	@param int $depth Вложенность меню (начинается с нуля). Используется для табуляции.
	*	@param array $args Дополнительные аргументы.
	*/
	public function start_lvl(&$output, $depth = 0, $args = array())
	{
		// Fold
		$output .= '<ul class="' . $this->_classes['ul'] . '">';
	}


	/**
	*	Закрытие тега <ul>.
	*	@param string $output Ссылка на выходной код html.
	*	@param int $depth Вложенность меню (начинается с нуля). Используется для табуляции.
	*	@param array $args Дополнительные аргументы.
	*/
	public function end_lvl(&$output, $depth = 0, $args = array())
	{
		// Fold
		$output .= '</ul>';
	}


	/**
	*	Открытие тега <li>.
	*	@param pointer $output Ссылка на выходной код html.
	*	@param object $category Объект текущего пункта меню.
	*	@param int $depth Вложенность меню (начинается с нуля).
	*	@param array $args Дополнительные аргументы.
	*	@param array $id Идентификатор текущего пункта меню.
	*	@return void.
	*/
	public function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0)
	{
		$name = esc_attr($category->name);
		if (!$name) {
			return;
		}

		// Ссылка
		$link  = '<a class="' . $this->_classes['a'] . '"';
		$link .= ' href="' . esc_url(get_term_link($category)) . '"';
		if ($args['use_desc_for_title'] && !empty($category->description)) {
			$link .= ' title="' . esc_attr(strip_tags($category->description)) . '"';
		}
		$link .= '>' . $name;

		// Количество постов в категории
		if (!empty($args['show_count'])) {
			$link .= ' <span class="' . $this->_classes['counter'] . '">' . $category->count . '</span>';
		}
		$link .= '</a>';

		// Классы элемента li
		$classes = array($this->_classes['li'], $this->_classes['li'] . '-' . $category->term_id);
		if (!empty($args['current_category'])) {
			$_current_category = get_term($args['current_category'], $category->taxonomy);
			if ($category->term_id == $args['current_category']) {
				$classes[] = $this->_classes['current'];
			} elseif ($category->term_id == $_current_category->parent) {
				$classes[] = $this->_classes['current_parent'];
			}
		}
		$output .= '<li class="' . implode(' ', $classes) . '">' . $link;
	}


	/**
	*	Завершение тега <li>.
	*	@param string $output Ссылка на выходной код HTML.
	*	@param object $page Не используется.
	*	@param int $depth Не используется.
	*	@param array $args Не используется.
	*	@return void.
	*/
	public function end_el(&$output, $page, $depth = 0, $args = array())
	{
		// Fold
		$output .= '</li>';
	}
}


/**
*	Универсальный валкер для страниц.
*/
class WalkerPage extends Walker_Page
{
	/**
	*	Классы.
	*/
	private $_classes = array();


	/**
	*	Создание валкера.
	*	@param array $args Массив названий классов.
	*	@return void.
	*/
	function __construct($args = array())
	{
		$defaults = array(
			'ul'             => 'pagelist-child',
			'li'             => 'pagelist-item',
			'a'              => 'pagelist-item-link',
			'counter'        => 'pagelist-item-counter',
			'current'        => '_current',
			'current_parent' => '_current-parent',
			'has_children'   => '_has-children',
			'ancestor'       => '_ancestor',
		);

		$args = wp_parse_args($args, $defaults);
		$this->_classes = $args;
	}


	/**
	*	Открытие тега <ul>.
	*	@param string $output Ссылка на выходной код html.
	*	@param int $depth Вложенность меню (начинается с нуля). Используется для табуляции.
	*	@param array $args Дополнительные аргументы.
	*/
	public function start_lvl(&$output, $depth = 0, $args = array())
	{
		// Fold
		$output .= '<ul class="' . $this->_classes['ul'] . '">';
	}


	/**
	*	Закрытие тега <ul>.
	*	@param string $output Ссылка на выходной код html.
	*	@param int $depth Вложенность меню (начинается с нуля). Используется для табуляции.
	*	@param array $args Дополнительные аргументы.
	*/
	public function end_lvl(&$output, $depth = 0, $args = array())
	{
		// Fold
		$output .= '</ul>';
	}


	/**
	*	Открытие тега <li>.
	*	@param pointer $output Ссылка на выходной код html.
	*	@param object $page Объект текущего страницы.
	*	@param int $depth Вложенность меню (начинается с нуля).
	*	@param array $args Дополнительные аргументы.
	*	@param array $current_page Идентификатор текущей открытой страницы пользователем.
	*	@return void.
	*/
	public function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0)
	{
		$css_class = array($this->_classes['li']);

		// Текущая страница имеет потомков
		if (isset($args['pages_with_children'][$page->ID])) {
			$css_class[] = $this->_classes['has_children'];
		}

		// Пользователь смотрит страницу
		if (!empty($current_page)) {
			$_current_page = get_post($current_page);
			
			// Наследники текущей страницы
			if ($_current_page && in_array($page->ID, $_current_page->ancestors)) {
				$css_class[] = $this->_classes['ancestors'];
			}

			// Текущая страницы
			if ($page->ID == $current_page) {
				$css_class[] = $this->_classes['current'];

			// Родитель текущей страницы
			} elseif ($_current_page && $page->ID == $_current_page->post_parent) {
				$css_class[] = $this->_classes['current_parent'];
			}

		// Пользователь не смотрит страницу
		} elseif ($page->ID == get_option('page_for_posts')) {
			$css_class[] = $this->_classes['current_parent'];
		}

		$css_classes = implode(' ', $css_class);

		// Страница без заголовка
		if ($page->post_title === '') {
			$page->post_title = sprintf(__('#%d (no title)'), $page->ID);
		}

		// Дата страницы
		if (!empty($args['show_date'])) {
			$time = ($args['show_date'] == 'modified') ? $page->post_modified : $page->post_date;
			$date_format = empty($args['date_format']) ? '' : $args['date_format'];
			$date .= sprintf('<span class="%s">%s</span>', $this->_classes['counter'], mysql2date($date_format, $time));
		} else {
			$date = '';
		}

		$output .= sprintf(
			'<li class="%s"><a class="%s" href="%s">%s%s</a>',
			$css_classes,
			$this->_classes['a'],
			get_permalink($page->ID),
			$page->post_title,
			$date
		);
	}


	/**
	*	Завершение тега <li>.
	*	@param string $output Ссылка на выходной код HTML.
	*	@param object $page Не используется.
	*	@param int $depth Не используется.
	*	@param array $args Не используется.
	*	@return void.
	*/
	public function end_el(&$output, $page, $depth = 0, $args = array())
	{
		// Fold
		$output .= '</li>';
	}
}