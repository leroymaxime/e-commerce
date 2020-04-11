<?php 
require_once '../../config.php';
require_once (ROOT_PATH ."inc/database.php");
require_once (ROOT_PATH ."Admin/inc/header.php");

$name = htmlentities($_POST['name']);

$req = $pdo->query('SELECT * FROM packaging WHERE name_packaging = "'.$_POST['name'].'"')->rowCount();
if ($req == 0) {

$req = $pdo->prepare('INSERT INTO packaging (name_packaging, created_packaging, modified_packaging) VALUES (?, NOW(), NOW())');
$req->execute(array($name));

echo 'Conditionnement créé, <a href="../../Admin/conditionnement.php">retourner à l\'administration</a>'; 
} else {
  echo 'Ce conditionnement existe déjà, <a href="../../Admin/create-conditionnement.php">retourner à la création</a>';
}