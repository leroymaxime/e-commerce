
<?php 
require_once ('config.php');
include_once (ROOT_PATH ."inc/head.php");
if(isset($_SESSION['id_user'])) {
  Header('location:index.php');
}
include_once (ROOT_PATH ."inc/navbar.php"); ?>
<main>
  <section class="formsection">
      <h2>Connexion</h2>
    <form name="connexionForm" onsubmit="return validateFormConnexion()" action="actions/php/connect.php" method="post">
      <ul>
        <li class="formgroup">
          <label class="col-25">Email</label>
          <input class="col-75" type="text" name="email">
          <div class="error" id="emailErr"></div>
        </li>

        <li class="formgroup">
          <label class="col-25">Mot de passe</label>
          <input class="col-75" type="password" name="password">
          <div class="error" id="passwordErr"></div>
        </li>

        <li class="formgroup">
          <input class="btn__connexion" type="submit" value="Se connecter">
        </li>
      </ul>   
  </form>
  </section>
</main>
<script src="script.js"></script>