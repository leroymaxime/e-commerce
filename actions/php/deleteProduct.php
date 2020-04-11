<?php
require_once '../../config.php';
require_once (ROOT_PATH ."inc/database.php");
if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $pdo->query('SELECT * FROM products WHERE id_product='.$_GET['id'])->fetch();
   $pdo->query('DELETE FROM products WHERE id_product ='.$_GET['id']);

   header('Location:'.BASE_URL.'admin/produits.php');
}
?>