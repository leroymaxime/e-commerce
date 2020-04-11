<?php
header('Content-type: text/html; charset=utf-8');
include_once "config.php";
include_once (ROOT_PATH ."inc/head.php");
if(!isset($_SESSION['id_user'])) {
  Header('location:../index.php');
}
include_once (ROOT_PATH ."inc/navbar.php"); 

if(isset($_SESSION['id_user']))
{
    $requser = $pdo->prepare("SELECT * FROM users WHERE id_user = ?");
    $requser->execute(array($_SESSION['id_user']));
    $user = $requser->fetch();

 # MAIL
  if(!empty($_POST['email']) AND $_POST['email'] != $user['email'])
    {
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $newmail = htmlentities($_POST['email']);
            $insertmail = $pdo->prepare("UPDATE users SET email_user = ? WHERE id_user = ?");
            $insertmail->execute(array($newmail, $_SESSION['id_user']));
            header('Location: mon-compte.php');
        }
    }

    # ADRESSE 
    if(!empty($_POST['newadresse']) AND $_POST['newadresse'] != $user['adress_user'])
    {
        $newadresse = htmlentities($_POST['newadresse']);
        $insertadresse = $pdo->prepare("UPDATE users SET adress_user = ? WHERE id_user = ?");
        $insertadresse->execute(array($newadresse, $_SESSION['id_user']));
        header('Location: mon-compte.php');
    }

    # CODE POSTALE 
    if(!empty($_POST['newcp']) AND $_POST['newcp'] != $user['cp_user'])
    {
        $newcp = htmlentities($_POST['newcp']);
        $insertcp = $pdo->prepare("UPDATE users SET cp_user = ? WHERE id_user = ?");
        $insertcp->execute(array($newcp, $_SESSION['id_user']));
        header('Location: mon-compte.php');
    }

    # VILLE 
    if(!empty($_POST['newville']) AND $_POST['newville'] != $user['city_user'])
    {
        $newville = htmlentities($_POST['newville']);
        $insertville = $pdo->prepare("UPDATE users SET city_user = ? WHERE id_user = ?");
        $insertville->execute(array($newville, $_SESSION['id_user']));
        header('Location: mon-compte.php');
    }

 # MOT DE PASSE

    if(!empty($_POST['password']) AND !empty($_POST['confirm_password']))
    {
        $password = htmlentities($_POST['password']);
        $confirm_password = htmlentities($_POST['confirm_password']);

        if(strlen($password) >= 8 AND strlen($password) <= 100) {
            if($password == $confirm_password) {

            $password_crypted = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $insertmdp = $pdo->prepare("UPDATE users SET password_user = ? WHERE id_user = ?");
            $insertmdp->execute(array($password_crypted, $_SESSION['id_user']));
            header('Location: mon-compte.php');
        }
        } else {
            $erreur = "Vos deux mot de passe ne correspondent pas !";
        }
    }

}
?>
<main>
  <article class="product__page__main">
    <aside>
      <h3>Mon compte</h3>
      <ul>
        <li><a href="update.php">Update Profile</a></li>
        <li><a href="changepassword.php">Change Password</a></li>
        <?php if(isset($_SESSION['id_user']) && $user['group_user']== "Admin") { ?>
        <li><a href="Admin/">Administration</a></li>
        <?php  } ?>
      </ul>
    </aside>

    <section>
      <form method="POST" enctype="multipart/form-data">
        <article class="formgroup">
          <label>Votre nouvel email</label>
          <input type="text" name="email" placeholder="Votre nouvel email">
        </article>
        <hr />
        <article class="formgroup">
          <label>Votre nouveau mot de passe</label>
          <input type="password" name="password">
        </article>

        <article class="formgroup">
          <label>Confirmez votre nouveau mot de passe</label>
          <input type="password" name="confirm_password">
        </article>
        <hr />
        <article class="formgroup">
          <label>Votre nouvelle adresse</label>
          <input type="text" name="newadresse">
        </article>
        <hr />
        <article class="formgroup">
          <label>Code Postale</label>
          <input type="text" name="newcp">
        </article>
        <hr />
        <article class="formgroup">
          <label>Ville</label>
          <input type="text" name="newville">
        </article>
        
        <input type="submit" name="submit" value="Mettre à jour mon profil !" />
      </form>
      <?php if(isset($erreur)) { echo $erreur; } ?>
    </section>
  </article>
</main>