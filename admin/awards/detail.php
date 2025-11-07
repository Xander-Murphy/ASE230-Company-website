<?php
require '../csvHelper.php';
require 'award.php';
$awardsFile = '../../data/awards.csv';

$awardName = $_GET['award'] ?? '';
$awardYear = $_GET['year'] ?? '';

$award = csvHelper::getCSVByTwo($awardsFile, $awardYear, $awardName);
if($award)
  $award = new Award($award[0], $award[1], $award[2]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Award Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 text-light bg-dark text-center">

<nav class="mb-4 mt-3">
  <a class="btn btn-primary" href="index.php" role="button">Index</a>
  <a href="edit.php?name=<?php echo $award->title ?>&year=<?php echo $award->year ?>" class="btn btn-primary">Edit</a>
  <a href="delete.php?name=<?php echo $award->title ?>&year=<?php echo $award->year ?>" class="btn btn-primary">Delete</a>
</nav>

<div class="container mt-4">
  <?php if ($award): ?>
    <h2><?php echo htmlspecialchars($award->title); ?></h2><br>
    <p><strong>Year:</strong> <?php echo htmlspecialchars($award->year); ?></p>

    <p><strong>Details:</strong> <?php echo htmlspecialchars($award->detail); ?></p>
  <?php else: ?>
      <h3 class="text-danger">Award not found.</h3>
  <?php endif; ?>
</div>

</body>
</html>