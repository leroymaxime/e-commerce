<?php 
require_once '../../config.php';
require_once (ROOT_PATH ."inc/database.php");
$req = $pdo->prepare("UPDATE categories SET name_category=:name, slug_category=:slug, modified_category= NOW() WHERE id_category=:id");
$req->execute(array(
  'name' => trim(htmlentities($_POST['name'])),
  'slug' => trim(htmlentities($_POST['slug'])),
  'id' => trim(htmlentities($_POST['id']))));
  
  header('Location:'.BASE_URL.'admin/categories.php');
  ?>