<?php
require 'products.php';

$name = $_GET['name'] ?? '';
$product = getProductByName($name);

if (!$product) {
    die("Product not found.");
}

$errors = [];
// Pre-fill form values
$nameVal = $product['name'];
$descriptionVal = $product['description'];
$app1 = $product['applications'][0] ?? '';
$app2 = $product['applications'][1] ?? '';
$app3 = $product['applications'][2] ?? '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nameVal = trim($_POST['name'] ?? '');
  $descriptionVal = trim($_POST['description'] ?? '');
  $app1 = trim($_POST['app1'] ?? '');
  $app2 = trim($_POST['app2'] ?? '');
  $app3 = trim($_POST['app3'] ?? '');

  // Validation
  if ($nameVal === '') $errors[] = "Name is required.";
  if ($descriptionVal === '') $errors[] = "Description is required.";
  if ($app1 === '' || $app2 === '' || $app3 === '') $errors[] = "All three applications are required.";

  if (empty($errors)) {
    updateProduct($name, [
      'name' => $nameVal,
      'description' => $descriptionVal,
      'applications' => [$app1, $app2, $app3]
    ]);
      header('Location: detail.php?name=' . urlencode($nameVal));
      exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">Edit Product "<?php echo htmlspecialchars($product['name']); ?>"</h2>

  <?php if ($errors): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?php echo htmlspecialchars($err); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
  <?php endif; ?>

  <form method="POST" class="mx-auto" style="max-width: 600px;">
      <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($nameVal); ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" required><?php echo htmlspecialchars($descriptionVal); ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Applications</label>
        <input type="text" name="app1" class="form-control mb-2" placeholder="Application 1" value="<?php echo htmlspecialchars($app1); ?>" required>
        <input type="text" name="app2" class="form-control mb-2" placeholder="Application 2" value="<?php echo htmlspecialchars($app2); ?>" required>
        <input type="text" name="app3" class="form-control mb-2" placeholder="Application 3" value="<?php echo htmlspecialchars($app3); ?>" required>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-success me-2">Save Changes</button>
        <a href="detail.php?name=<?php echo urlencode($name); ?>" class="btn btn-secondary">Cancel</a>
      </div>
  </form>
</div>
</body>
</html>