<?php

$pdo = require 'includes/config.php';

$sql = 'SELECT UserName,level FROM admin';

$statement = $pdo->query($sql);

// get all publishers
$publishers = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($publishers) {
	// show the publishers
	foreach ($publishers as $publisher) {
		echo $publisher['UserName'] . '<br>';
	} }
    
    ?>