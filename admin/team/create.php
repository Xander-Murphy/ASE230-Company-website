<?php
require 'team.php';

$name = '';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $title = trim($_POST['title'] ?? '');
  $background = trim($_POST['background'] ?? '');


  //validation
  if ($name === '') $errors[] = "Name is required.";
  if ($title === '') $errors[] = "Title is required.";
  if ($background === '') $errors[] = "Background is required.";
  if (empty($errors)) {
    addMember([
      'name' => $name,
      'title' => $title,
      'background' => $background
    ]);

    // Redirect to back to index after member is created
    header('Location: edit.php?name=' . urlencode($name));
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add a New Member</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">Add a New Member</h2>

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
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Title</label>
      <textarea name="title" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Background</label>
      <textarea name="background" class="form-control" rows="3" required></textarea>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-success me-2">Add Member</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
</body>
</html>