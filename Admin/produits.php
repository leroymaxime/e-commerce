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
<h2>Produits</h2>
<a href="create-product.php" class="btn btn-outline-primary">Créer</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nom</th>
      <th scope="col">Origine</th>
      <th scope="col">Catégorie</th>
      <th scope="col">prix</th>
      <th scope="col">Stock</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $query = $pdo->query('SELECT products.id_product, products.slug_product, products.name_product, products.origin_product, products.price_product, products.stock_product, categories.name_category, packaging.name_packaging FROM products LEFT JOIN categories ON products.category_id=categories.id_category LEFT JOIN packaging ON products.packaging_id=packaging.id_packaging');
      while ($data = $query->fetch()) {
    ?>
    <tr>
      <th scope="row"><?= $data['id_product'];?></th>
      <td><?= $data['name_product'];?></td>
      <td><?= $data['origin_product'];?></td>
      <td><?= $data['name_category'];?></td>
      <td><?= $data['price_product'];?></td>
      <td><?= $data['stock_product'];?></td>
      <td>ACTIONS</td>
      <td>
      <a href="produit.php?slug=<?= htmlspecialchars($data['slug_product']);?>" class="btn btn-outline-dark"><i class="far fa-eye"></i></a>
      <a href="edit-product.php?id=<?= htmlspecialchars($data['id_product']);?>" class="btn btn-outline-dark"><i class="far fa-edit"></i></a>
      <a href="<?=BASE_URL?>actions/php/deleteProduct.php?id=<?php echo $data['id_product'];?>" class="btn btn-outline-dark"><i class="far fa-trash-alt"></i></a>

    </tr>
    <?php } $query->closeCursor();?>
  </tbody>
</table>
</section>
<?php 
} else {
  Header('location:../index.php');
}
require_once (ROOT_PATH ."admin/inc/footer.php"); 
?>