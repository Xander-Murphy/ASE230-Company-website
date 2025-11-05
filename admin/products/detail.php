<?php

$productsFile = '../../data/products.json';

// Get product name from the query string
$name = $_GET['name'] ?? '';

// Load products
$products = json_decode(file_get_contents($productsFile), true) ?? [];

// Find the matching product
$product = null;
foreach ($products as $p) {
  if ($p['name'] === $name) {
    $product = $p;
    break;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 text-light bg-dark text-center">

<nav class="mb-4 mt-3">
  <a class="btn btn-primary" href="index.php" role="button">Index</a>
  <a href="edit.php?name=<?php echo $name ?>" class="btn btn-primary">Edit</a>
  <a href="delete.php?name=<?php echo $name ?>" class="btn btn-primary">Delete</a>
</nav>

<div class="container mt-4">
  <?php if ($product): ?>
    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
    <p><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>

    <h4>Applications:</h4>
    <ul class="list-group list-group-flush">
      <?php foreach ($product['applications'] as $app): ?>
        <li class="list-group-item bg-dark text-light">
          <?php echo htmlspecialchars($app); ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
      <h3 class="text-danger">Product not found.</h3>
  <?php endif; ?>
</div>

</body>
</html>
