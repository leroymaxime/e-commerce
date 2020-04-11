<article class="navbar navbar-expand-lg navbar-light bg-light">
  <p class="navbar-brand navbar-nav mr-auto"><?= "Hello " . $user['name_user']; ?></p>
    <div class="my-2 my-lg-0">
      <a class="btn btn-outline-success my-2 my-sm-0" type="submit" href="<?= BASE_URL ?>deconnexion.php">Logout</a>
    </div>
  </div>
</article>
<section class="row">
  <article class="col-3">
    <nav class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a href="index.php" class="nav-link active">Accueil</a>
      <a href="produits.php" class="nav-link">Produits</a>
      <a href="categories.php" class="nav-link">Catégorie</a>
      <a href="conditionnement.php" class="nav-link">Conditionnement</a>
      <a href="commandes.php" class="nav-link">Commandes</a>
      <a href="utilisateurs.php" class="nav-link">Utilisateurs</a>
</nav>
</article>