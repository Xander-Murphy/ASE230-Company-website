<?php
require 'awards.php';
$awardsFile = '../../data/awards.csv';

$name = $year = $details = '';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $year = trim($_POST['year'] ?? '');
  $details = trim($_POST['details'] ?? '');

  if ($name === '') $errors[] = "Name is required.";
  if ($year === '') $errors[] = "Year is required.";
  if ($details === '') $errors[] = "Details are required.";

  if (empty($errors)) {
    $handle = fopen($awardsFile, 'a');
    createCSV($handle, [$year, $name, $details]);
    fclose($handle);
    header('Location: index.php');
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Award</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Create New Product</h2>

    <?php
    if ($errors) {
        echo '<div class="alert alert-danger"><ul>';
        foreach ($errors as $err) {
            echo '<li>' . htmlspecialchars($err) . '</li>';
        }
        echo '</ul></div>';
    }
    ?>

  <form method="POST" class="mx-auto" style="max-width: 600px;">
    <div class="mb-3">
      <label class="form-label">Award Name</label>
      <input type="text" name="name" class="form-control" required></input>
    </div>

    <div class="mb-3">
      <label class="form-label">Year</label>
      <input name="year" class="form-control" type="number" rows="1" min="1900" max="2099"></input>
    </div>

    <div class="mb-3">
      <label class="form-label">Details</label>
      <input type="text" name="details" class="form-control" required></input>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-success me-2">Create Product</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
</body>
</html>