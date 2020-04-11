<?php
require_once ('config.php');
require_once (ROOT_PATH ."inc/database.php");
include_once (ROOT_PATH ."inc/head.php");
include_once (ROOT_PATH ."inc/navbar.php");
$query = $pdo->query('SELECT products.*, categories.*, packaging.* FROM products LEFT JOIN categories ON products.category_id=categories.id_category LEFT JOIN packaging ON products.packaging_id=packaging.id_packaging WHERE categories.name_category = "Paniers"');
?>
<section class="container">
<h2>Produits</h2>

<section class="produits">
    <ul class="produits__main">
    <?php while ($data = $query->fetch()) { 
      $imageURL = 'images_produits/'.$data['image_product'];?>
      <li class="produit_box" id="product-<?=$data['id_product'];?>">
        <figure>
          <img src="<?php echo $imageURL; ?>" alt="">
          <figcaption>
            <ul>
              <li><h3 class="produit__title"><?=$data['name_product'];?></h3></li>
              <li><?= $data['id_product'];?></li>
              <li><?= $data['origin_product']; ?></li>
              <li><?= $data['name_packaging']; ?></li>
              <li><?= $data['price_product']; ?>€</li>
              <li><a href="#" data-target="product-modal-<?=$data['id_product'];?>" class="toggle-modal">Ouvrir la modal</a></li>
            </ul>
          </figcaption>
        </figure>
        <div class="modal" id="product-modal-<?=$data['id_product'];?>">
          <div class="modal-content" id='modal-content<?= $data['id_product']; ?>'>
            <span class="close-button" id='close-button'>&times;</span>
            <div class="modal__bloc">
              <p><?= $data['name_category'] . "> " . $data['name_product'] ?></p>
              <div class="modal__body">
                <figure class="modal__body__image">
                  <img src="<?php echo $imageURL; ?>" alt="">
                </figure>
                <div class="modal__body__infos">
                  <h2><?= $data['name_product'];?></h2>
                  <ul>
                    <li>> Description</li>
                    <li><?= $data['description_product'];?></li>
                    <li><?= $data['price_product'] . " par " . $data['name_packaging'] . " - la " . $data['name_packaging'];?></li>
                    <?php
                      if ($data['stock_product'] == 0) { ?>
                      <li>Produit épuisé</li>
                    <?php  
                    } else if ($data['stock_product'] < 10 ) {?>
                      <li>Produit bientôt épuisé</li>
                    <?php }
                    else { ?>
                      <li>Produit en stock</li>
                  <?php  }?>
                  </ul>
                  <?php
                    if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == true) {
                  ?>
                  <form action="<?= BASE_URL ?>actions/php/ajoutPanier.php" method="POST">
                  <input type="text" class="form-control" name="id" value="<?= $data['id_product'];?>" style="display:none;">
                  <input type="number" class="form-control" name="quantity">
                    <button type="submit">Ajouter Panier</button>
                  </form>
                  <?php } else if ($data['stock_product'] == 0){
                    } ?>
                </div>
              </div>
            
            </div>
          </div>
        </div>
      </li>
      <?php } $query->closeCursor();?>
    </ul>
  </section>
  <?php include_once (ROOT_PATH ."inc/footer.php"); ?>