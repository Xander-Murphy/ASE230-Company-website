<?php
require 'products.php';

$name = $description = '';
$applications = [];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $description = trim($_POST['description'] ?? '');
  $app1 = trim($_POST['app1'] ?? '');
  $app2 = trim($_POST['app2'] ?? '');
  $app3 = trim($_POST['app3'] ?? '');

  //validation
  if ($name === '') $errors[] = "Name is required.";
  if ($description === '') $errors[] = "Description is required.";
  if ($app1 === '' || $app2 === '' || $app3 === '') {
    $errors[] = "All three applications are required.";
  }
  if (empty($errors)) {
    createProduct([
      'name' => $name,
      'description' => $description,
      'applications' => [$app1, $app2, $app3]
    ]);

    // Redirect to back to index after product is created
    header('Location: edit.php?name=' . urlencode($name));
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">Create New Product</h2>

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
      <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="3" required><?php echo htmlspecialchars($description); ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Applications</label>
      <input type="text" name="app1" class="form-control mb-2" placeholder="Application 1" required>
      <input type="text" name="app2" class="form-control mb-2" placeholder="Application 2" required>
      <input type="text" name="app3" class="form-control mb-2" placeholder="Application 3" required>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-success me-2">Create Product</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
</body>
</html>