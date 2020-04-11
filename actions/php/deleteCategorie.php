<?php
require_once '../../config.php';
require_once (ROOT_PATH ."inc/database.php");
if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $pdo->query('DELETE FROM categories WHERE id_category ='.$_GET['id']);
   header('Location:'.BASE_URL.'admin/categories.php');
}
?>