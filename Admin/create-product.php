<?php
// Include config file
require_once "../config.php";
require_once (ROOT_PATH ."inc/database.php");
require_once (ROOT_PATH ."admin/inc/header.php");
if(!isset($_SESSION['id_user'])) {
  Header('location:../index.php');
} else if (isset($_SESSION['id_user']) && ($user['group_user'] == "Admin")) {
require_once (ROOT_PATH ."admin/inc/navbar.php");

$statusMsg = '';

if(isset($_POST["submit"]) && !empty($_FILES["image"]["name"])) {
  $name= trim($_POST['name']);
  $slug= trim($_POST['slug']);
  $origine= trim($_POST['origine']);
  $description= trim($_POST['description']);
  $price= trim($_POST['price']);
  $category_id= trim($_POST['category_id']);
  $conditionnement_id= trim($_POST['conditionnement_id']);
  $stock= trim($_POST['stock']);
  $targetDir = "../images_produits/";
  $image = basename($_FILES["image"]["name"]);
  $targetFilePath = $targetDir . $image;
  $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

  
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)) {
      // Upload file to server
      if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
        
        // Insert image file name into database
        $req = $pdo->prepare("INSERT INTO products (name_product, slug_product, origin_product, description_product, price_product, category_id, packaging_id, stock_product, image_product, created_product, modified_product) VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $req->execute(array($name, $slug, $origine, $description, $price, $category_id, $conditionnement_id, $stock, $image));
        if($req) {
          $statusMsg = "Le produit à bien été publié";
        } else {
          $statusMsg = "File upload failed, please try again.";
        } 
      } else {
        $statusMsg = "Sorry, there was an error uploading your file.";
      }
    } else {
      $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
  } else {
    $statusMsg = 'Please select a file to upload.';
  }
?>
<section class="container">
<h1>Ajouter un produit</h1>
<form method="post" enctype="multipart/form-data">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nom</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Slug</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="slug">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Origine</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="origine">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Catégorie</label>
    <div class="col-sm-10">
      <select class="form-control" name="category_id">
        <option selected>Selectionner une catégorie</option>
        <?php 
        $query = $pdo->query("SELECT id_category, name_category FROM categories ORDER BY name_category");
        while ($data = $query->fetch()) {
           ?>
        <option value="<?= $data['id_category'];?>"><?= $data['name_category'];?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" name="description"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Conditionnement</label>
    <div class="col-sm-10">
      <select class="form-control" name="id_packabging">
        <option selected>Selectionner conditionnement</option>
        <?php 
        $query = $pdo->query("SELECT id_packaging, name_packaging FROM packaging ORDER BY name_packaging");
        while ($data = $query->fetch()) {
           ?>
        <option value="<?= $data['id_packaging'];?>"><?= $data['name_packaging'];?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Stock</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="stock">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Prix</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="price">
    </div>
  </div>
  <div class=" form-group row">
    <label class="col-sm-2 col-form-label">Photo</label>
    <div class="col-sm-10">
    <input type="file" class="form-control-file" name="image">
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Publier</button>
</form>
<?php echo $statusMsg; ?>
</section>
<?php 
} else {
  Header('location:../index.php');
}
require_once (ROOT_PATH ."admin/inc/footer.php"); 
?>