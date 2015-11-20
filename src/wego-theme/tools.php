<?
/**
*	Утилиты (статический класс).
*/
class Tools
{
	/**
	*	Форматирование даты в человеко-понятный вид.
	*	@param string|int $date Дата в MySQL datetime или timestamp.
	*	@return string Возвращает форматированную дату.
	*/
	public static function format_date($date, $format = array())
	{
		$translation = array(
			'January' => 'января' , 'February' => 'февраля', 'March'     => 'марта',
			'April'   => 'апреля' , 'May'      => 'мая'    , 'June'      => 'июня',
			'July'    => 'июля'   , 'August'   => 'августа', 'September' => 'сентября',
			'October' => 'октября', 'November' => 'ноября' , 'December'  => 'декабря',
			'Jan' => 'янв', 'Feb' => 'фев', 'Mar' => 'мар', 'Apr' => 'апр',
			'May' => 'май', 'Jun' => 'июн', 'Jul' => 'июл', 'Aug' => 'авг',
			'Sep' => 'сен', 'Oct' => 'окт', 'Nov' => 'ноя', 'Dec' => 'дек',
			'Monday'   => 'понедельник', 'Tuesday'  => 'вторник', 'Wednesday' => 'среда',
			'Thursday' => 'четверг'    , 'Friday'   => 'пятница', 'Saturday'  => 'суббота',
			'Sunday'   => 'воскресенье',
			'Mon' => 'пн', 'Tue' => 'вт', 'Wed' => 'ср', 'Thu' => 'чт', 'Fri' => 'пт',
			'Sat' => 'сб', 'Sun' => 'вс'
		);

		$defaults = array(
			'yesterday' => array('вчера в %s', 'H:i'),
			'today'     => array('сегодня в %s', 'H:i'),
			'tomorrow'  => array('завтра в %s', 'H:i'),
			'long'      => array('%s, %s', 'j F Y', 'H:i'),
		);

		$format = wp_parse_args($format, $defaults);
		$date_unix = is_integer($date) ? $date : strtotime($date);

		if ($date_unix) {
			$ymd = date('Ymd', $date_unix);

			if ($ymd == date('Ymd', strtotime('yesterday'))) {
				$key = 'yesterday';
			} elseif ($ymd == date('Ymd')) {
				$key = 'today';
			} elseif ($ymd == date('Ymd', strtotime('tomorrow'))) {
				$key = 'tomorrow';
			} else {
				$key = 'long';
			}

			$title  = array_shift($format[$key]);
			$params = array();
			foreach ($format[$key] as $date_format) {
				$params[] = @date($date_format, $date_unix);
			}
			array_unshift($params, $title);
			$date_unix = call_user_func_array('sprintf', $params);
			$date_unix = strtr($date_unix, $translation);

			return $date_unix;
		} else {
			return $date;
		}
	}


	/**
	*	Разделение числа тонкой шпацией каждые тысячные.
	*	@param int $number Исходное число.
	*	@param string $separator Разделитель (по умолчанию &thinsp;).
	*	@return string Возвращает форматированное число или пустую строку.
	*/
	public static function format_number($number, $separator = '&thinsp;')
	{
		$number = intval($number);

		if (!empty($number)) {
			return preg_replace('/(\d)(?=(\d\d\d)+([^\d]|$))/', '$1' . $separator, $number);
		} else {
			return '';
		}
	}


	/**
	*	Форматирование номера телефона (Россия).
	*	@param string $number Номер телефона.
	*	@param string $url Возврат номера для URL (по умолчанию false).
	*	@return string Возвращает форматированный номер.
	*/
	public static function format_phone($number, $url = false)
	{
		// Удаление знака + и других знаков перед номером
		$phone  = preg_replace('/[^0-9]/', '', $number);
		$length = strlen($phone);

		// Замена 8 на 7 для мобильных
		if ($length == 11) {
			$phone = preg_replace('/^8/', '7', $phone);
		}

		// Возврат номера для URL
		if ($url) {
			return ($length == 11) ? '+' . $phone : $phone;
		}

		// Мобильный
		if ($length == 11) {
			return preg_replace('/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})/', '+$1 ($2) $3-$4-$5', $phone);

		// Городской
		} elseif ($length == 6) {
			return preg_replace('/([0-9]{2})([0-9]{2})([0-9]{2})/', '$1-$2-$3', $phone);

		// Не удалось отформатировать
		} else {
			return $number;
		}
	}


	/**
	*	Обрезка текста до N символов с добавлением многоточия.
	*	@param string $text Исходный текст.
	*	@param int $length Максимальная длина в символах.
	*	@param string $pruning Символ или текст в месте обрезки (по умолчанию …).
	*	@return string Возвращает обрезанный текст.
	*/
	public static function format_text($text, $length, $pruning = '…')
	{
		$text = strip_tags($text);

		if (mb_strlen($text) > $length) {
			$text = mb_substr($text, 0, $length);
			$text = rtrim($text, '!,.- ') . $pruning;
		}

		return $text;
	}


	/**
	*	Склонение числительных.
	*	@param array $titles Массив текстов для числительных, например array('%s просмотр', '%s просмотра', '%s просмотров').
	*	@param int $number Числительное.
	*	@param bool $format Форматирование с использованием sprintf (по умолчанию true).
	*	@return string Возвращает текст или пустой текст в случае ошибки.
	*/
	public static function declension_text($titles, $number, $format = true)
	{
		if (!is_array($titles) || (count($titles) < 3)) {
			return '';
		}

		$cases = array(2, 0, 1, 1, 1, 2);
		$key = (($number % 100 > 4) && ($number % 100 < 20)) ? 2 : $cases[min($number % 10, 5)];

		if ($format) {
			return sprintf($titles[$key], $number);
		} else {
			return $titles[$key];
		}
	}


	/**
	*	Получение стандартной картинки.
	*	@param string $size Размер картинки (thumbnail, medium, large) или
	*	размеры картинки в пикселях (например 120x90).
	*	@return string Возвращает URL к изображению.
	*/
	public static function get_default_image($size)
	{
		// Имя файла
		if (defined('DEFAULT_IMAGE')) {
			$filename = str_replace('%SIZE%', $size, DEFAULT_IMAGE);
			$fullname = str_replace('%SIZE%', 'full', DEFAULT_IMAGE);
		} else {
			$filename = 'default-image-' . $size . '.jpg';
			$fullname = 'default-image-full.jpg';
		}

		// Пути в фс и сети
		if ($filename[0] != '/') {
			$filename = '/' . $filename;
		}

		if ($fullname[0] != '/') {
			$fullname = '/' . $fullname;
		}

		$path = get_template_directory() . $filename;
		$uri  = get_template_directory_uri() . $filename;

		$fpath = get_template_directory() . $fullname;
		$furi  = get_template_directory_uri() . $fullname;

		// Подготовка нового файла
		if (!file_exists($path)) {
			// Размер
			if (preg_match('/(\d+)x(\d+)/', $size, $matches)) {
				$width  = $matches[1];
				$height = $matches[2];
			} else {
				$width  = get_option($size . '_size_w', 0);
				$height = get_option($size . '_size_h', 0);
			}

			$image = wp_get_image_editor($fpath);

			if (is_wp_error($image)) {
				return $furi;
			}

			$image->resize($width, $height, true);
			$image = $image->save($path);

			if (is_wp_error($image)) {
				return $furi;
			}
		}

		return $uri;
	}


	/**
	*	Вывод пагинации.
	*	@param array $classes Классы элементов пагинации.
	*		Значение по умолчанию:
	*		array(
	*			'ul'      => 'pagination',
	*			'li'      => 'pagination-item',
	*			'a'       => 'pagination-item-link',
	*			'current' => '_current',
	*		)
	*	@param array $args Аругменты для paginate_links.
	*	@param bool $echo Вывод пагинации или возврат html.
	*	@return string Выводит код пагинации.
	*/
	public static function pagination($classes = array(), $args = array(), $echo = true)
	{
		global $wp_query;

		if ($wp_query->max_num_pages <= 1) {
			return '';
		}

		// Классы
		$classes = wp_parse_args($classes, array(
			'ul'      => 'pagination',
			'li'      => 'pagination-item',
			'a'       => 'pagination-item-link',
			'current' => '_current',
		));

		// Аргументы
		$args = wp_parse_args($args, array(
			'format'    => 'page/%#%/',
			'current'   => max(1, get_query_var('paged')),
			'total'     => $wp_query->max_num_pages,
			'prev_text' => '&larr; <span class="hidden-xs">Назад</span>',
			'next_text' => '<span class="hidden-xs">Вперед</span> &rarr;',
			'type'      => 'array',
		));

		$links = paginate_links($args);
		$html  = '';

		// Формирование пагинации
		foreach ($links as $link) {
			$link    = str_replace('page-numbers', $classes['a'], $link);
			$current = strstr($link, 'current') ? $classes['current'] : '';
			$html   .= sprintf('<li class="%s %s">%s</li>', $classes['li'], $current, $link);
		}

		$html = sprintf('<ul class="%s">%s</ul>', $classes['ul'], $html);

		// Вывод
		if ($echo) {
			echo $html;
		} else {
			return $html;
		}
	}


	/**
	*	Установка мета для записи. Удаляет мета, если значение пустое.
	*	@param int $post_id Идентификатор записи.
	*	@param string $meta_key Название мета поля.
	*	@param mixed $meta_value Значение мета поля.
	*	@return void.
	*/
	public static function set_post_meta($post_id, $meta_key, $meta_value)
	{
		if (is_numeric($meta_value)) {
			update_post_meta($post_id, $meta_key, $meta_value);
		} else {
			if (is_string($meta_value)) {
				$meta_value = trim($meta_value);
			}

			if (empty($meta_value)) {
				delete_post_meta($post_id, $meta_key);
			} else {
				update_post_meta($post_id, $meta_key, $meta_value);
			}
		}
	}
}