
<?php
function query($pdo, $sql, $parameters = []) {
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}

function totalJokes($pdo) {
	$query = query($pdo, 'SELECT COUNT(*) FROM `joke`');
	$row = $query->fetch();
	return $row[0];
}

function getJoke($pdo, $id) {
	$parameters = [':id' => $id];
	$query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id', $parameters);
	return $query->fetch();
}

function insertJoke($pdo, $jokeText, $authorId) {
	$query = 'INSERT INTO `joke` (`joketext`, `jokedate`, `authorId`) VALUES (:joketext, CURDATE(), :authorId)';
	$parameters = [':joketext' => $jokeText, ':authorId' => $authorId];
	query($pdo, $query, $parameters);	
}

function updateJoke($pdo, $jokeId, $joketext, $authorId) {
	$query = 'UPDATE `joke` SET `authorId` = :authorId, `joketext` = :joketext WHERE `id` = :id';
	$parameters = [':joketext' => $joketext, 'authorId' => $authorId, ':id' => $jokeId];
	query($pdo, $query, $parameters);
}
?>