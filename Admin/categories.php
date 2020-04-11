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
<h2>Catégories des produits</h2>
<a href="create-categorie.php" class="btn btn-outline-primary">Créer</a>
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
      $query = $pdo->query('SELECT id_category, name_category, created_category FROM categories ORDER BY id_category');
      while ($data = $query->fetch()) {
    ?>
    <tr>
      <th scope="row"><?= $data['id_category'];?></th>
      <td><?= $data['name_category'];?></td>
      <td><?= $data['created_category'];?></td>
      <td>
      <a href="edit-categorie.php?id=<?= htmlspecialchars($data['id_category']);?>" class="btn btn-outline-dark"><i class="far fa-edit"></i></a>
      <a href="<?=BASE_URL?>actions/php/deleteCategorie.php?id=<?php echo $data['id_category'];?>" class="btn btn-outline-dark"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php 
} else {
  Header('location:../index.php');
}
require_once (ROOT_PATH ."admin/inc/footer.php"); 
?>