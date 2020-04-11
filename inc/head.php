<?php session_start(); 

require_once (ROOT_PATH ."inc/database.php");
if(isset($_SESSION['id_user'])) {
   $req = $pdo->prepare("SELECT * FROM users WHERE id_user = ?");
   $req->execute(array($_SESSION['id_user']));
   $user = $req->fetch();
   }
   
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e49f106c84.js"></script>
  <link rel="stylesheet" href="<?= BASE_URL ?>css/app.css">
</head>