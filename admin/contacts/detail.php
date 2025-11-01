<?php

$contactFile = '../../data/contacts.json';

$name = $_GET['name'] ?? '';
$date = $_GET['date'] ?? '';
$contacts = json_decode(file_get_contents($contactFile), true) ?? [];

$contact = null;
foreach ($contacts as $c) {
  if ($c['name'] === $name && $c['date'] === $date) {
    $contact = $c;
    break;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 text-light bg-dark text-center">

<nav class="mb-4 mt-3">
  <a class="btn btn-primary" href="index.php" role="button">Index</a>
  <a href="edit.php?name=<?php echo $name ?>" class="btn btn-primary">Edit</a>
  <a href="delete.php?name=<?php echo $name ?>" class="btn btn-primary">Delete</a>
</nav>

<div class="container mt-4">
  <?php if ($contact): ?>
    <h2><?php echo htmlspecialchars($contact['name']); ?></h2>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($contact['email']); ?></p>
    <h5><strong>Subject:</strong> <?php echo htmlspecialchars($contact['subject']); ?></h5>
    <p>Message: <?php echo htmlspecialchars($contact['message']); ?></p>
    <p>Date: <?php echo htmlspecialchars($contact['date']); ?></p>
  <?php else: ?>
      <h3 class="text-danger">Contact not found.</h3>
  <?php endif; ?>
</div>

</body>
</html>
