<?php 
require_once '../../config.php';
require_once (ROOT_PATH ."inc/database.php");
$req = $pdo->prepare("UPDATE products SET 
                                              name_product=:name_product,
                                              slug_product=:slug_product,
                                              origin_product=:origin_product,
                                              description_product=:description_product,
                                              price_product=:price_product,
                                              category_id=:category_id,
                                              packaging_id=:packaging_id,
                                              stock_product=:stock_product,
                                              modified_product=NOW()
                                              WHERE id_product=:id_product");
$req->execute(array(
  'name_product' => trim(htmlentities($_POST['name_product'])),
  'slug_product' => trim(htmlentities($_POST['slug_product'])),
  'origin_product' => trim(htmlentities($_POST['origin_product'])),
  'description_product' => trim(htmlentities($_POST['description_product'])),
  'price_product' => trim(htmlentities($_POST['price_product'])),
  'category_id' => trim(htmlentities($_POST['category_id'])),
  'packaging_id' => trim(htmlentities($_POST['packaging_id'])),
  'stock_product' => trim(htmlentities($_POST['stock_product'])),
  'id_product' => trim(htmlentities($_POST['id_product']))));
  
  header('Location:'.BASE_URL.'admin/produits.php');
  ?>