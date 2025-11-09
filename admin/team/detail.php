<?php

$teamFile = '../../data/team.json';
require 'member.php';
// Get member name from the query string
$name = $_GET['name'] ?? '';

// Load members
$members = json_decode(file_get_contents($teamFile), true) ?? [];

// Find the matching member
$member = null;
foreach ($members as $p) {
  if ($p['name'] === $name) {
    $member = new Member($p['name'], $p['title'], $p['background']);
    break;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Member Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 text-light bg-dark text-center">

  <nav class="mb-4 mt-3">
    <a class="btn btn-primary" href="index.php" role="button">Index</a>
    <a href="edit.php?name=<?php echo $member->name ?>" class="btn btn-primary">Edit</a>
    <a href="delete.php?name=<?php echo $member->name ?>" class="btn btn-primary">Delete</a>
  </nav>

  <div class="container mt-4">
    <?php if ($member): ?>
      <h2><?php echo htmlspecialchars($member->name); ?></h2>
        <p><strong>Title:</strong> <?php echo htmlspecialchars($member->title); ?></p>
        <p><strong>Background:</strong> <?php echo htmlspecialchars($member->background); ?></p>


      <?php else: ?>
        <h3 class="text-danger">Member not found.</h3>
      <?php endif; ?>
  </div>

</body>
</html>
