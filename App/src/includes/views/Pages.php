<?php

namespace APP\views;

class Pages
{
	function __construct()
	{

	}

	function read(array $data)
	{
		extract($data);
		return <<<HTML
			<article>
				<h2>$title</h2>
				$content
			</article>
			<aside>
				auteur: $author date: $date
			</aside>
			<aside>
				<!-- commentaires -->
			</aside>

		HTML;
	}

}


