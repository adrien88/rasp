<?php
# include "includes/_kernel.php";
?>


<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="App/src/assets/css/main.css">
	<title>
		<?php
		echo (substr($_SERVER['PATH_INFO'], 1) ?? 'accueil.html');
		?>
	</title>
</head>

<body>
	<header>
		<h1>Page perso</h1>
	</header>
	<nav>
		<?php
		foreach (glob('pages/*.html') as $file) {
			$link = basename($file);
			$name = substr($link, 0, -5);
			echo '<a href="./' . $link . '">' . $name . '</a>';
		}
		?>
	</nav>
	<main>
		<?php
		echo file_get_contents('pages/' . ($_SERVER['PATH_INFO'] ?? 'accueil.html'));
		?>
	</main>
	<footer>
		Adrien Boilley, votre hacker préféré.
	</footer>
</body>

</html>