<?php
// Include config file
require_once "../config.php";
require_once (ROOT_PATH ."inc/database.php");
require_once (ROOT_PATH ."admin/inc/header.php");
if(!isset($_SESSION['id_user'])) {
  Header('location:../index.php');
} else if (isset($_SESSION['id_user']) && ($user['group_user'] == "Admin")) {
require_once (ROOT_PATH ."admin/inc/navbar.php");

$req = $pdo->prepare("SELECT products.id_product, products.slug_product, products.image_product, products.description_product, products.name_product, products.origin_product, products.price_product, products.stock_product, categories.name_category, packaging.name_packaging FROM products LEFT JOIN categories ON products.category_id=categories.id_category LEFT JOIN packaging ON products.packaging_id=packaging.id_packaging WHERE products.slug_product = ?");
$req->execute(array($_GET['slug']));
$data = $req->fetch();
$imageURL = '../images_produits/'.$data['image_product'];
?><section class="container">
<ul>
  <li>Nom : <?= $data['name_product']; ?></li>
  <li>Slug : <?= $data['slug_product']; ?></li>
  <li>Description : <?= $data['description_product']; ?></li>
  <li>Prix : <?= $data['price_product']; ?> €</li>
  <li>stock : <?= $data['stock_product']; ?></li>
  <li>Catégorie : <?= $data['name_category']; ?></li>
  <li>Conditionnement : <?= $data['name_packaging']; ?></li>

</ul>
<img src="<?php echo $imageURL; ?>" alt="" />
</section>
<?php 
} else {
  Header('location:../index.php');
}
require_once (ROOT_PATH ."admin/inc/footer.php"); 
?>








