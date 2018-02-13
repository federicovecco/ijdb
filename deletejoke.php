<?php

try {
	include __DIR__ . '/includes/DatabaseConnection.php';

	deleteJoke($pdo, $_POST['id']);

	header('location: jokes.php');

} catch(PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Unable to conncect to the database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

include __DIR__  . '/tmp/layout.html.php';

