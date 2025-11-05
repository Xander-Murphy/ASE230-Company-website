<?php


$productsFile = '../../data/products.json';

//Delete Functions
function getAllProducts() {
  global $productsFile;
  return json_decode(file_get_contents($productsFile), true) ?? [];
}

function getProductByName($name) {
  $products = getAllProducts();
  foreach ($products as $p) {
    if ($p['name'] === $name) return $p;
  }
  return null;
}

function deleteProduct($name) {
  global $productsFile;
  $products = getAllProducts();
  $products = array_values(array_filter($products, fn($p) => $p['name'] !== $name));
  file_put_contents($productsFile, json_encode($products, JSON_PRETTY_PRINT));
}

//Create Functions
function createProduct($data) {
  global $productsFile;
  $products = json_decode(file_get_contents($productsFile), true) ?? [];

  $products[] = $data;

  file_put_contents($productsFile, json_encode($products, JSON_PRETTY_PRINT));
}

//Edit Functions
function updateProduct($oldName, $newData) {
  global $productsFile;
  $products = getAllProducts();

  foreach ($products as &$p) {
    if ($p['name'] === $oldName) {
      $p = $newData;
      break;
    }
  }
  file_put_contents($productsFile, json_encode($products, JSON_PRETTY_PRINT));
}
?>
