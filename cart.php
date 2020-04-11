<?php 
require_once ('config.php');
include_once (ROOT_PATH ."inc/head.php");
if(!isset($_SESSION['id_user'])) {
  Header('location:index.php');
}
include_once (ROOT_PATH ."inc/navbar.php");
$query = $pdo->query('SELECT products.*, cart.*, users.id_user, categories.* FROM cart LEFT JOIN products ON products.id_product = cart.product_id LEFT JOIN users ON users.id_user = cart.user_id LEFT JOIN categories ON categories.id_category = products.category_id WHERE users.id_user ='.$_SESSION["id_user"]);
$reqPanier = $query->fetchAll();
$panier = [];
for($i=0; $i < count($reqPanier); $i++) {
  $panier[$i]['id_cart'] = $reqPanier[$i]['id_cart'];
  $panier[$i]['image_product'] = $reqPanier[$i]['image_product'];
  $panier[$i]['name_product'] = $reqPanier[$i]['name_product'];
  $panier[$i]['name_category'] = $reqPanier[$i]['name_category'];
  $panier[$i]['price_product'] = $reqPanier[$i]['price_product'];
  $panier[$i]['quantity_product_cart'] = $reqPanier[$i]['quantity_product_cart'];
}

function getTotal($panier) {
  $total = 0;
  for($i=0; $i < count($panier); $i++) {
    $total += $panier[$i]['price_product'] * $panier[$i]['quantity_product_cart'];
  }
  return $total;
}

function getTVA($panier) {
  $tva = 0;
  for($i=0; $i < count($panier); $i++) {
    $tva += ($panier[$i]['price_product'] * $panier[$i]['quantity_product_cart']) / 100*20;
  }
  return $tva;
}

?>
  <main>
    <section class="cart">
      <table class="shopping__cart__table">
      <thead>
        <tr>
          <td class="text-center">Image</td>
          <td class="text-left">Produit</td>
          <td class="text-left">Categorie</td>
          <td class="text-left">Quantitée</td>
          <td class="text-right">Prix Unitaire</td>
          <td class="text-right">Total</td>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0; $i < count($panier); $i++) {
          $imageURL = 'images_produits/'.$panier[$i]['image_product'];
        ?>
        <tr>
          <td class="text-center"><a href=""><img src="<?= $imageURL; ?>" class="img-thumbnail" style="width:75px; height:75px;"/></a></td>
          <td class="text-left"><a href=""><?= $panier[$i]['name_product']; ?></a></td>
          <td class="text-left"><?= $panier[$i]['name_category'];?></td>
          <td class="text-left">
            <form action="<?= BASE_URL ?>actions/php/updatePanier.php" method="POST">
              <ul class="quantity__cart__bloc">
                <li><input type="number" class="form-control" name="idPanier" value="<?=$panier[$i]['id_cart'];?>" style="display:none;"></li>
                <li><input type="number" class="form-control" name="quantity_product" value="<?=$panier[$i]['quantity_product_cart'];?>" style="max-width:75px;"></li>
                <li><button type="submit" class=""><i class="fa fa-refresh"></i></button></li>
                <li><a href="<?=BASE_URL?>actions/php/deleteCart.php?id=<?php echo $panier[$i]['id_cart'];?>" class=""><i class="far fa-trash-alt"></i></a></li>
              </ul>               
            </form>
          </td>
          <td class="text-right"><?= $panier[$i]['price_product'];?>€</td>
          <td class="text-right"><?= $panier[$i]['price_product'] * $panier[$i]['quantity_product_cart'];?>€</td>
        </tr>
      </tbody>
      <?php
    }?>
      </table>
    </section>
    <p>Total de la commande : <?=getTotal($panier);?>€ T.T.C</p>
    <p>Dont TVA à 20% : <?=getTVA($panier);?>€</p>

  </main>
  <?php include_once 'inc/footer.php'; ?>