<?php session_start(); 

require_once (ROOT_PATH ."inc/database.php");
if(isset($_SESSION['id_user'])) {
   $req = $pdo->prepare("SELECT * FROM users WHERE id_user = ?");
   $req->execute(array($_SESSION['id_user']));
   $user = $req->fetch();   
   }
   
?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Dashboard Admin</title>
    <script src="https://kit.fontawesome.com/e49f106c84.js"></script>
  </head>
  <body>