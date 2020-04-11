<?php
require_once "../config.php";
require_once "inc/header.php";

if(!isset($_SESSION['id_user'])) {
  Header('location:../index.php');
} else if (isset($_SESSION['id_user']) && ($user['group_user'] == "Admin")) {
require_once 'inc/navbar.php';
?>
<main class="col-9">
    
</main>
</section>
<?php
} else {
  Header('location:../index.php');
}

require_once "inc/footer.php";
?>