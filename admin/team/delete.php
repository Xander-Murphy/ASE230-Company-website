<?php
// team/delete.php
require_once __DIR__ . '/../JsonHelper.php';
require 'member.php';
$dataFile = __DIR__ . '/../../data/team.json';
$errors = [];

$name = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : null;
if ($name === null || $name === '') {
    http_response_code(400);
    echo "Member name is required.";
    exit;
}

$member = JsonHelper::findByField($dataFile, 'name', $name);
if ($member === null) {
    http_response_code(404);
    echo "Member not found.";
    exit;
}

$member = new Member($member['name'], $member['title'], $member['background']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    $deleted = JsonHelper::deleteByField($dataFile, 'name', $name);
    if ($deleted) {
        header('Location: index.php');
        exit;
    } else {
        $errors[] = "Failed to delete member.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Delete member</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light text-center">

<nav class="my-3">
  <a class="btn btn-primary" href="index.php">Back to Index</a>
</nav>

<div class="container mt-5">
<?php if (!empty($errors)): ?>
    <ul style="color:red">
        <?php foreach ($errors as $e): ?><li><?=htmlspecialchars($e)?></li><?php endforeach; ?>
    </ul>
<?php endif; ?>
<div class="card bg-secondary text-light mx-auto" style="max-width: 500px;">
  <div class="card-body">
    <h2 class="card-title">Delete "<?php echo htmlspecialchars($member->name); ?>"?</h2>
    <p class="card-text">Are you sure you want to permanently delete this member? This action cannot be undone.</p>

    <form method="post">
      <input type="hidden" name="action" value="delete">
      <button type="submit" name="confirm" class="btn btn-danger me-2">Yes, Delete</button>
      <a href="detail.php?name=<?php echo $member->name?>" class="btn btn-secondary">Cancel</a>
</form>
  </div>
</div>


</div>
</body>
</html>
