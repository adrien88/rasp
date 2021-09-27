<?php

namespace APP\models\entities;

class Pages
{
	private string $encode = 'UTF-8';
	private string $lang = 'fr-FR';
	private string $title = 'Document';

	function dev(){
		$req = <<<SQL
				CREATE TABLE IF NOT EXISTS pages(
					id INT(16) NOT NULL PRIMARY KEY AUTO_INCREMENT,
					urlid INT(16) NOT NULL,
					title VARCHAR(255),
					title VARCHAR(),
				);
		SQL;
	}

	function __construct (string $pagename)
	{
		$req = <<<SQL
				SELECT id FROM urls WHERE url = $pagename;
		SQL;
		$stmt = $this->PDO->prepare($req);
		$stmt->execute();
		foreach($stmt->fetch(\PDO::FETCH_ASSOC) as $col => $value)
			$this->$col = $value;
	}

}
