<?php
// Include config file
require_once "../config.php";
require_once (ROOT_PATH ."inc/database.php");
require_once (ROOT_PATH ."admin/inc/header.php");
if(!isset($_SESSION['id_user'])) {
  Header('location:../index.php');
} else if (isset($_SESSION['id_user']) && ($user['group_user'] == "Admin")) {
require_once (ROOT_PATH ."admin/inc/navbar.php");

$req = $pdo->prepare("select * from packaging WHERE id_packaging = ?");
$req->execute(array($_GET['id']));
$data = $req->fetch(); 

?>
<section class="container">
<h1>Modifier un conditionnement</h1>
<form action="<?= BASE_URL ?>/actions/php/updateConditionnement.php" method="POST">
<div class="form-group row" style="display:none;">
    <label class="col-sm-2 col-form-label">ID</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="id" value="<?= $data['id_packaging'];?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nom</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" value="<?= $data['name_packaging'];?>">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Publier</button>
</form>
</section>
<?php 
} else {
  Header('location:../index.php');
}
require_once (ROOT_PATH ."admin/inc/footer.php"); 
?>