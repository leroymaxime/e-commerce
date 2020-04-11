<?php 
require_once '../../config.php';
require_once (ROOT_PATH ."inc/database.php");
$req = $pdo->prepare("UPDATE packaging SET name_packaging=:name, modified_packaging=NOW() WHERE id_packaging=:id");
$req->execute(array(
  'name' => trim(htmlentities($_POST['name'])),
  'id' => trim(htmlentities($_POST['id']))));
  
  header('Location:'.BASE_URL.'admin/conditionnement.php');
  ?>