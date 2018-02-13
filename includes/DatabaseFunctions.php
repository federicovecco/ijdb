
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

function updateJoke($pdo, $fields) {
	$query = 'UPDATE `joke` SET ';

	foreach ($array as $key => $value) {
		$query .= '`' . $key . '` = :' . $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= ' WHERE `id` = :primaryKey';

	$fields['primaryKey'] = $fields['id'];

	query($pdo, $query, $fields);
}

function deleteJoke($pdo, $id) {
	$parameters = [':id' => $id];
	query($pdo, 'DELETE FROM `joke` WHERE `id` =  :id', $parameters); 	
}

function allJokes($pdo) {
	$jokes = query($pdo, 'SELECT `joke`.`id`, `joketext`, `name`, `email` FROM `joke` INNER JOIN `author`
		ON `authorid` = `author`.`id`');

	return $jokes->fetchAll();
}
?>