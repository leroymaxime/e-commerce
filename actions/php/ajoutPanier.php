<?php 
require_once '../../config.php';
session_start(); 

require_once (ROOT_PATH ."inc/database.php");
if(isset($_SESSION['id_user'])) {
   $req = $pdo->prepare("SELECT * FROM users WHERE id_user = ?");
   $req->execute(array($_SESSION['id_user']));
   $user = $req->fetch();   
   }

$idproduct = htmlentities($_POST['id']);
$quantity = htmlentities($_POST['quantity']);

$req = $pdo->prepare('INSERT INTO cart (user_id ,product_id, quantity_product_cart) values(?, ?, ?)');
$req->execute(array($_SESSION['id_user'], $idproduct, $quantity));
header('Location:'.BASE_URL.'cart.php');


?>