<?php

include __DIR__ . '/includes/DatabaseConnection.php';
include __DIR__ . '/includes/DatabaseFunctions.php';

try {
	if (isset($_POST['joketext'])) {

		$fields = ['id' => $_POST['jokeId'],
					'joketext' => $_POST['joketext'],
					'authorid' => 1];
		updateJoke($pdo, $fields);

		header('location: jokes.php');
	} else {
		$joke = getJoke($pdo, $_GET['id']);

		$title = 'Edit Joke';

		ob_start();

		include __DIR__ . '/tmp/editjoke.html.php';

		$output = ob_get_clean();
	}
} catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/tmp/layout.html.php';
