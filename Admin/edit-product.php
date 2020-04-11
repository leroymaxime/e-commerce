<?php
// Include config file
require_once "../config.php";
require_once (ROOT_PATH ."inc/database.php");
require_once (ROOT_PATH ."admin/inc/header.php");
if(!isset($_SESSION['id_user'])) {
  Header('location:../index.php');
} else if (isset($_SESSION['id_user']) && ($user['group_user'] == "Admin")) {
require_once (ROOT_PATH ."admin/inc/navbar.php");

$req = $pdo->prepare("select products.*,products.price_product, categories.* from products join categories on categories.id_category=products.category_id WHERE products.id_product = ?");
$req->execute(array($_GET['id']));
$data = $req->fetch();     
  // Insert image file name into database
?>
<section class="container">
<h1>Ajouter un produit</h1>
<form action="<?= BASE_URL ?>/actions/php/updateProduct.php" method="post">
<div class="form-group row" style="display:none;">
    <label class="col-sm-2 col-form-label">ID</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="id_product" value="<?= $data['id_product'];?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nom</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name_product" value="<?= $data['name_product'];?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Slug</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="slug_product" value="<?= $data['slug_product'];?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Origine</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="origin_product" value="<?= $data['origin_product'];?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Catégorie</label>
    <div class="col-sm-10">
      <select class="form-control" name="category_id">
        <option selected >Catégorie Actuelle => <?= $data['name_category'];?></option>
        <?php 
        $query = $pdo->query("SELECT id_category, name_category FROM categories ORDER BY name_category");
        while ($category = $query->fetch()) {
           ?>
        <option value="<?= $category['id_category'];?>"><?= $category['name_category'];?></option>
        <?php } $query->closeCursor();?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" name="description_product"><?= $data['description_product'];?></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Conditionnement</label>
    <div class="col-sm-10">
      <select class="form-control" name="packaging_id">
        <option selected>Selectionner conditionnement</option>
        <?php 
        $query = $pdo->query("SELECT id_packaging, name_packaging FROM packaging ORDER BY name_packaging");
        while ($conditionnement = $query->fetch()) {
           ?>
        <option value="<?= $conditionnement['id_packaging'];?>"><?= $conditionnement['name_packaging'];?></option>
        <?php } $query->closeCursor();?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Stock</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="stock_product" value="<?= $data['stock_product']?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Prix</label>
    <div class="col-sm-10">
      <input value="<?= $data['price_product']?>" class="form-control" name="price_product">
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Publier</button>
</form>
</section>
<?php $query->closeCursor();?>
<?php 
} else {
  Header('location:../index.php');
}
require_once (ROOT_PATH ."admin/inc/footer.php"); 
?>