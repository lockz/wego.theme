<?
/**
*	Утилиты мультисайта.
*/
class Mtools
{
	/**
	*	Получение слага блога по его идентификатору.
	*	@param int $blog_id Идентификатор блога.
	*	@return string Возвращает слаг блога (Для основного блога возвращает main).
	*	@todo Добавить поддержку субдиректориальной установки.
	*/
	public static function get_blog_slug($blog_id = 0)
	{
		if (!is_multisite()) {
			return 'main';
		}

		if ($blog_id == 0) {
			global $blog_id;
		}

		$blog = get_blog_details($blog_id);
		$blog = explode('.', $blog->domain);

		return count($blog) < 3 ? 'main' : $blog[0];
	}
}