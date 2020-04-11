<?php 
require_once '../../config.php';
require_once (ROOT_PATH ."inc/database.php");
require_once (ROOT_PATH ."Admin/inc/header.php");

$name = htmlentities($_POST['name']);
$slug = htmlentities($_POST['slug']);

$req = $pdo->query('SELECT * FROM categories WHERE name_category = "'.$_POST['name'].'" OR slug_category = "'.$_POST['slug'].'"')->rowCount();
if ($req == 0) {

$req = $pdo->prepare('INSERT INTO categories (name_category, slug_category, created_category, modified_category) VALUES (?, ?, NOW(), NOW())');
$req->execute(array($name, $slug));

echo 'Catégorie créée, <a href="../../Admin/">retourner à l\'administration</a>'; 
} else {
  echo 'Cette catégorie existe déjà, <a href="../../Admin/create-categorie.php">retourner à la création</a>';
}