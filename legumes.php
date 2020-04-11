<?php
require_once ('config.php');
require_once (ROOT_PATH ."inc/database.php");
include_once (ROOT_PATH ."inc/head.php");
include_once (ROOT_PATH ."inc/navbar.php");
$query = $pdo->query('SELECT products.*, categories.*, packaging.* FROM products LEFT JOIN categories ON products.category_id=categories.id_category LEFT JOIN packaging ON products.packaging_id=packaging.id_packaging WHERE categories.name_category = "Légumes"');
$req = $pdo->query('SELECT * FROM categories ORDER BY name_category');
$stmt = $pdo->query('SELECT * FROM packaging ORDER BY name_packaging');

?>
<main>
  <article class="product__page__main">
<aside>
  <article>
  
    <h2>Catégories<span id="toggle__categories"><a href="#"><i class="fas fa-angle-double-down"></i></a></span></h2>
    <ul id="categories__toggle">
      <?php while ($category = $req->fetch()) { ?>
      <li><a href=""><?= $category['name_category']; ?></a></li>
      <?php } ?>
    </ul>
  </article>
  
  <article>
  
    <h2>Conditionnement<span id="toggle__packaging"><a href="#"><i class="fas fa-angle-double-down"></i></a></span></h2>
    <div>
    <form>
      <ul id="packaging__toggle">
        <?php while ($packaging = $stmt->fetch()) { ?>
          <li>
            <input type="checkbox" id="<?= $packaging['id_packaging']; ?>" name="vehicle1" value="Bike">
            <label for="vehicle1"><?= $packaging['name_packaging']; ?></label>
          </li>
        
  
        <?php } ?>
      </ul>
        
      </form>
      </div>
  </article>
</aside>

<section>
<h2>Produits</h2>
    <ul class="produits__main">
    <?php while ($data = $query->fetch()) { 
      $imageURL = 'images_produits/'.$data['image_product'];?>
      <li class="box_produit" id="product-<?=$data['id_product'];?>">
        <figure>
          <img src="<?php echo $imageURL; ?>" alt="">
          <figcaption>
            <ul>
              <li><h3 class="produit__title"><?=$data['name_product'];?></h3></li>
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
</article>
</main>
<?php include_once (ROOT_PATH ."inc/footer.php"); ?>