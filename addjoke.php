<?php

if(isset($_POST['joketext'])) {
	try {
		
		include __DIR__ . '/includes/DatabaseConnection.php';
		include __DIR__ . '/includes/DatabaseFunctions.php';

		insertJoke($pdo, $_POST['joketext'], 1);
		
		header('location: jokes.php');

	} catch(PDOException $e) {
		$title = 'An error has occurred';

		$output = 'Database error: ' . $e->getMessage() . '<br /> in ' . $e->getFile() . ':' . $e->getLine();
	}
} else {
	$title = 'Add a new joke';

	ob_start();

	include __DIR__ . '/tmp/addjoke.html.php';

	$output = ob_get_clean();
}

include __DIR__ . '/tmp/layout.html.php';