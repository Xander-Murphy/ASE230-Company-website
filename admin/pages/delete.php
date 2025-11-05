<?php
include '../pages.php';

$page = $_GET['page'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    deletePage($page);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Delete Page</title></head>
<body>
<h1>Delete “<?= htmlspecialchars($page) ?>”?</h1>

<form method="POST">
    <button type="submit">Yes, Delete</button>
</form>

<a href="index.php">Cancel</a>
</body>
</html>
