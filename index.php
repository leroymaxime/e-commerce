<?php 
require_once ('config.php');
include_once (ROOT_PATH ."inc/head.php");
include_once (ROOT_PATH ."inc/navbar.php"); 
?>
  <main>
  <section class="hero">
      <article class="hero__image">
      <img src="images/cover.png" alt="">
    </article>
    <article class="hero__text">
      <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, similique?</h1>
    </article>
  </section>
  <div class="button__group">
    <ul>
      <li><a href="">Derniers Ajouts</a></li>
      <li><a href="">Meilleurs Ventes</a></li>
      <li><a href="">Promotions</a></li>
    </ul>
  </div>
  <?php include_once (ROOT_PATH ."inc/produits.php"); ?>
  </main>
  <section class="categorie__index">
    <h2>Achetez par catégorie</h2>
    <ul class="categorie__index__content__items">
      <li>
        <ul>
          <li><img src="https://fakeimg.pl/120x120/" alt=""></li></li>
          <li>Catégorie</li>
          <li>[ + ]</li>
        </ul>
        
      <li>
        <ul>
          <li><img src="https://fakeimg.pl/120x120/" alt=""></li></li>
          <li>Catégorie</li>
          <li>[ + ]</li>
        </ul>
      </li>
      <li>
        <ul>
          <li><img src="https://fakeimg.pl/120x120/" alt=""></li></li>
          <li>Catégorie</li>
          <li>[ + ]</li>
        </ul>
      </li>
      <li>
        <ul>
          <li><img src="https://fakeimg.pl/120x120/" alt=""></li></li>
          <li>Catégorie</li>
          <li>[ + ]</li>
        </ul>
      </li>
      <li>
        <ul>
          <li><img src="https://fakeimg.pl/120x120/" alt=""></li></li>
          <li>Catégorie</li>
          <li>[ + ]</li>
        </ul>
      </li>
      <li>
        <ul>
          <li><img src="https://fakeimg.pl/120x120/" alt=""></li></li>
          <li>Catégorie</li>
          <li>[ + ]</li>
        </ul>
      </li>
    </ul>
  </section>
  </main>
  <?php include_once 'inc/footer.php'; ?>