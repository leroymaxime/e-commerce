<?php
  require_once '../../config.php';
  require_once (ROOT_PATH ."inc/database.php");

  $email = htmlentities($_POST['email']);
  $req = $pdo->prepare('SELECT id_user, password_user FROM users WHERE email_user = :email');
  $req-> execute(array('email' => $email));

  $resultat = $req->fetch();

         
  if (!$resultat OR !password_verify(htmlentities($_POST['password']), $resultat['password_user'])) {
    echo 'Identifiant ou Mot De Passe incorrect.<br/>';
  } else {
    session_start();
    $_SESSION['id_user'] = htmlentities($resultat['id_user']);
    $_SESSION['email_user'] = htmlentities($email);
    header('location: ../../index.php');
  }
  $req->closeCursor();