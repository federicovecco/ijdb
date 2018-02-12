<?php

try {
	include __DIR__ . '/includes/DatabaseConnection.php';

	$sql = 'DELETE FROM `joke` WHERE `id` = :id';

	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':id', $_POST['id']);
	$stmt->execute();

	header('location: jokes.php');

} catch(PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Unable to conncect to the database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

include __DIR__  . '/tmp/layout.html.php';

