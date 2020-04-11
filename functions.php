<?php
require_once "../config.php";
require_once "inc/database.php";

function readCategory() {
  $categories = $pdo->prepare("SELECT id, name FROM categories ORDER BY name");
  $categories->execute();

  return $categories;
}