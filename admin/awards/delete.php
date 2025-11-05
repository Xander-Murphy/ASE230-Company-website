<?php
require 'awards.php';

$name = $_GET['name'] ?? '';
$year = $_GET['year'] ?? '';
$awardsFile = '../../data/awards.csv';
$award = getCSVByTwo($awardsFile, $name, $year);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
  deleteCSV($awardsFile, $award);
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Delete Award</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light text-center">

<nav class="my-3">
  <a class="btn btn-primary" href="index.php">Back to Index</a>
</nav>

<div class="container mt-5">
  <?php if ($award): ?>
    <div class="card bg-secondary text-light mx-auto" style="max-width: 500px;">
      <div class="card-body">
        <h2 class="card-title">Delete "<?php echo htmlspecialchars($award[1]); ?>"?</h2>
        <p class="card-text">Are you sure you want to permanently delete this award? This action cannot be undone.</p>

        <form method="POST">
          <button type="submit" name="confirm" class="btn btn-danger me-2">Yes, Delete</button>
          <a href="detail.php?award=<?php echo $name; ?>&year=<?php echo $year; ?>" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  <?php else: ?>
    <h3 class="text-danger mt-5">Award not found.</h3>
  <?php endif; ?>
</div>

</body>
</html>