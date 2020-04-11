<?php
header('Content-type: text/html; charset=utf-8');
include_once "config.php";
include_once (ROOT_PATH ."inc/head.php");
if(!isset($_SESSION['id_user'])) {
  Header('location:index.php');
}
include_once (ROOT_PATH ."inc/navbar.php"); 
?>
<main>
  <article class="product__page__main">
    <aside>
      <h3>Mon compte</h3>
      <ul>
        <li><a href="modifier-profile.php">Update Profile</a></li>
        <li><a href="changepassword.php">Change Password</a></li>
        <?php if(isset($_SESSION['id_user']) && $user['group_user']== "Admin") { ?>
          <li><a href="Admin/">Administration</a></li>
      <?php  } ?>
      </ul>
    </aside>

    <section>
      <p><?= htmlspecialchars(html_entity_decode($user['name_user'])); ?></p>
      <p><?= htmlspecialchars(html_entity_decode($user['lastname_user'])); ?></p>
      <p><?= htmlspecialchars(html_entity_decode($user['email_user'])); ?></p>
      <p><?= htmlspecialchars(html_entity_decode($user['adress_user'])); ?></p>
      <p><?= htmlspecialchars(html_entity_decode($user['cp_user'])); ?></p>
      <p><?= htmlspecialchars(html_entity_decode($user['city_user'])); ?></p>
      <p><?= $user['group_user']; ?></p>
    </section>
    </article>