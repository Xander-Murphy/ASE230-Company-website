<?php
// team/create.php
require_once __DIR__ . '/../JsonHelper.php';
require 'member.php';
$dataFile = __DIR__ . '/../../data/team.json';
$errors = [];
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $title = trim($_POST['title'] ?? '');
  $background = trim($_POST['background'] ?? '');

    // Validation
    if ($name === '') {
        $errors[] = "Name is required.";
    } else {
        $existing = JsonHelper::findByField($dataFile, 'name', $name);
        if ($existing !== null) {
            $errors[] = "A member with that name already exists.";
        }
    }

    if (empty($errors)) {
      $newMember = new Member($name, $title, $background);
        $item = $newMember->returnAsArray();
        JsonHelper::create($dataFile, $item);
        header('Location: edit.php?name=' . urlencode($newMember->name));
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
  <h2 class="text-center mb-4">Add new member</h2>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="POST" class="mx-auto" style="max-width: 600px;">
    <div class="mb-3">
      <label class="form-label">Member Name</label>
      <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Title</label>
      <textarea name="title" class="form-control" rows="3"><?= old('title') ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Background</label>
      <textarea name="background" class="form-control" rows="3"><?= old('background') ?></textarea>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-success me-2">Add Member</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
</body>
</html>
