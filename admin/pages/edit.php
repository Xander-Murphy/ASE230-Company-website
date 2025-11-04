<?php
include '../pages.php';

$page = $_GET['page'] ?? '';
$content = getPageContent($page);

if ($content === null) {
    die("Page not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newContent = $_POST['content'];
    updatePage($page, $newContent);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Page</title></head>
<body>
<h1>Edit <?= htmlspecialchars($page) ?></h1>

<form method="POST">
    <textarea name="content" rows="10" cols="60"><?= htmlspecialchars($content) ?></textarea><br><br>
    <button type="submit">Save Changes</button>
</form>

<a href="index.php">Cancel</a>
</body>
</html>
