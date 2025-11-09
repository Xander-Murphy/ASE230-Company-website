<?php
// products/create.php
require_once __DIR__ . '/../JsonHelper.php';

$dataFile = __DIR__ . '/../../data/products.json';
$errors = [];
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim((string)($_POST['name'] ?? ''));
    $description = trim((string)($_POST['description'] ?? ''));
    $app1 = trim((string)($_POST['application_1'] ?? ''));
    $app2 = trim((string)($_POST['application_2'] ?? ''));
    $app3 = trim((string)($_POST['application_3'] ?? ''));

    // Validation
    if ($name === '') {
        $errors[] = "Name is required.";
    } else {
        $existing = JsonHelper::findByField($dataFile, 'name', $name);
        if ($existing !== null) {
            $errors[] = "A product with that name already exists.";
        }
    }

    $applications = [$app1, $app2, $app3];
    $missingApps = [];
    foreach ($applications as $i => $app) {
        if ($app === '') $missingApps[] = $i + 1;
    }
    if (!empty($missingApps)) {
        $errors[] = "Please provide all three applications (missing: " . implode(', ', $missingApps) . ").";
    }

    if (empty($errors)) {
        $item = [
            'name' => $name,
            'description' => $description,
            'applications' => array_values($applications),
        ];
        JsonHelper::create($dataFile, $item);
        header('Location: edit.php?name=' . urlencode($name));
        $_POST = [];
    }
}

function old($key) {
    return isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : '';
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

  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="POST" class="mx-auto" style="max-width: 600px;">
    <div class="mb-3">
      <label class="form-label">Product Name</label>
      <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="3"><?= old('description') ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Applications</label>
      <input type="text" name="application_1" class="form-control mb-2" placeholder="Application 1" value="<?= old('application_1') ?>" required>
      <input type="text" name="application_2" class="form-control mb-2" placeholder="Application 2" value="<?= old('application_2') ?>" required>
      <input type="text" name="application_3" class="form-control mb-2" placeholder="Application 3" value="<?= old('application_3') ?>" required>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-success me-2">Create Product</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
</body>
</html>
