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
<h2>Catégories des conditionnements</h2>
<a href="create-conditionnement.php" class="btn btn-outline-primary">Créer</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nom</th>
      <th scope="col">Date création</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $query = $pdo->query('SELECT * FROM packaging');
      while ($data = $query->fetch()) {
    ?>
    <tr>
      <th scope="row"><?= $data['id_packaging'];?></th>
      <td><?= $data['name_packaging'];?></td>
      <td><?= $data['created_packaging'];?></td>
      <td>
      <a href="edit-conditionnement.php?id=<?= htmlspecialchars($data['id_packaging']);?>" class="btn btn-outline-dark"><i class="far fa-edit"></i></a>
      <a href="<?=BASE_URL?>actions/php/deleteConditionnement.php?id=<?php echo $data['id_packaging'];?>" class="btn btn-outline-dark"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<section>
<?php 
} else {
  Header('location:../index.php');
}
require_once (ROOT_PATH ."admin/inc/footer.php"); 
?>