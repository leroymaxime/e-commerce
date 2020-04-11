<?php
// Include config file
require_once "../config.php";
require_once (ROOT_PATH ."inc/database.php");
require_once (ROOT_PATH ."admin/inc/header.php");
if(!isset($_SESSION['id_user'])) {
  Header('location:../index.php');
} else if (isset($_SESSION['id_user']) && ($user['group_user'] == "Admin")) {
require_once (ROOT_PATH ."admin/inc/navbar.php");
?>
<section class="container">
<h2>Utilisateurs Inscrits</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $query = $pdo->query('SELECT * FROM users');
      while ($data = $query->fetch()) {
    ?>
    <tr>
      <th scope="row"><?= $data['id_user'];?></th>
      <td><?= $data['name_user'];?></td>
      <td><?= $data['lastname_user'];?></td>
      <td><?= $data['email_user'];?></td>
      <td>ACTIONS</td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</section>
<?php 
} else {
  Header('location:../index.php');
}
require_once (ROOT_PATH ."admin/inc/footer.php"); 
?>
