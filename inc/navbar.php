<header class="top-header__index">
    <form class="search-bar__index" action="">
      <input type="text">
      <button>Recherche</button>
    </form>
    <figure>
      <img src="<?= BASE_URL ?>images/logo.jpg" alt="">
    </figure>
    <span class="toggle"><a href="#"><i class="fas fa-bars"></i></a></span>
      <ul class="meta">
      <?php if(isset($_SESSION['id_user']) && $_SESSION['id_user']==true) { ?>
        <li><a href="<?= BASE_URL ?>mon-compte.php"><i class="far fa-user"></i></a></li>
        <li><a href="<?= BASE_URL ?>cart.php"><i class="fas fa-shopping-cart"></i></a></li>
        <li><a href="<?= BASE_URL ?>deconnexion.php">Logout</a></li>
      <?php } else {?>
        <li><a href="<?= BASE_URL ?>inscription.php">S'inscrire</i></a></li>
        <li><a href="<?= BASE_URL ?>connexion.php">Se connecter</a></li>
      <?php } ?>
      </ul>
    <nav>
      <ul class="menu">
        <li><a href="<?= BASE_URL ?>index.php">Accueil</a></li>
        <li><a href="<?= BASE_URL ?>arrivages.php">Arrivages</a></li>
        <li><a href="<?= BASE_URL ?>paniers.php">Paniers</a></li>
        <li><a href="<?= BASE_URL ?>fruits.php">Fruits</a></li>
        <li><a href="<?= BASE_URL ?>legumes.php">Légumes</a></li>
        <li><a href="<?= BASE_URL ?>epicerie.php">Epicerie</a></li>
        <li><a href="<?= BASE_URL ?>contact.php">Contact</a></li>
      </ul>
    </nav>
  </header>