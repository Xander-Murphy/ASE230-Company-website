<?php
require 'awards.php';
$awardsFile = '../../data/awards.csv';

$name = $_GET['name'] ?? '';
$year = $_GET['year'] ?? '';
$award = getCSVByTwo($awardsFile, $name, $year);

if (!$award) {
    die("Award not found.");
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nameVal = trim($_POST['name'] ?? '');
  $yearVal = trim($_POST['year'] ?? '');
  $detailsVal = trim($_POST['details'] ?? '');

  if ($nameVal === '') $errors[] = "Name is required.";
  if ($yearVal === '') $errors[] = "Year is required.";
  if ($detailsVal === '') $errors[] = "Details are required.";

  if (empty($errors)) {
        $newRow = [$yearVal, $nameVal, $detailsVal];
        updateCSVRow($awardsFile, $award, $newRow);
        header('Location: detail.php?award=' . urlencode($nameVal) . '&year=' . urlencode($yearVal));
        exit;
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Award</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">Edit Award "<?php echo htmlspecialchars($award[1]); ?>"</h2>

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
        <label class="form-label">Award Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($award[1]); ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Year</label>
        <input name="year" type="number" class="form-control"  min="1900" max="2099" value="<?php echo htmlspecialchars($award[0]); ?>" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Details</label>
        <input type="text" name="details" class="form-control mb-2" value="<?php echo htmlspecialchars($award[2]); ?>" required>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-success me-2">Save Changes</button>
        <a href="detail.php?award=<?php echo $name; ?>&year=<?php echo $year; ?>" class="btn btn-secondary">Cancel</a>
      </div>
  </form>
</div>
</body>
</html>