<?php
require 'products.php';

$name = $_GET['name'] ?? '';
$product = getProductByName($name);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
  deleteProduct($name);
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Delete Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light text-center">

<nav class="my-3">
  <a class="btn btn-primary" href="index.php">Back to Index</a>
</nav>

<div class="container mt-5">
  <?php if ($product): ?>
    <div class="card bg-secondary text-light mx-auto" style="max-width: 500px;">
      <div class="card-body">
        <h2 class="card-title">Delete "<?php echo htmlspecialchars($product['name']); ?>"?</h2>
        <p class="card-text">Are you sure you want to permanently delete this product? This action cannot be undone.</p>

        <form method="POST">
          <button type="submit" name="confirm" class="btn btn-danger me-2">Yes, Delete</button>
          <a href="detail.php?name=<?php echo $name?>" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  <?php else: ?>
    <h3 class="text-danger mt-5">Product not found.</h3>
  <?php endif; ?>
</div>

</body>
</html>
