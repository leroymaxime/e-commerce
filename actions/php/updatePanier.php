<?php 
require_once '../../config.php';
session_start(); 

require_once (ROOT_PATH ."inc/database.php");
if(isset($_SESSION['id_user'])) {
   $req = $pdo->prepare("SELECT * FROM users WHERE id_user = ?");
   $req->execute(array($_SESSION['id_user']));
   $user = $req->fetch();   
   }

   $req = $pdo->prepare("UPDATE cart SET quantity_product_cart=:quantity_product WHERE id_cart=:idPanier");
   $req->execute(array(
     'idPanier' => trim(htmlentities($_POST['idPanier'])),
     'quantity_product' => trim(htmlentities($_POST['quantity_product']))));

     header('Location:'.BASE_URL.'cart.php');

?>