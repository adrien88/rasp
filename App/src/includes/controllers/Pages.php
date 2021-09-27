<?php

namespace APP\controllers;

use APP\models\Pages as modelsPages;

/**
 * APP = "includes/"
 */
class Pages
{
	static function default($page)
	{
		self::read($page);
	}

	static function read($page)
	{
		# $model = new modelsPages();
		var_dump($page);
	}
}
