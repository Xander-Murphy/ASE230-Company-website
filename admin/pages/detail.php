<?php
include 'pages.php';

$page = $_GET['page'] ?? '';
$content = getPageContent($page);

if ($content === null) {
    die("Page not found.");
}
?>

<!DOCTYPE html>
<html>
<head><title>View Page</title></head>
<body>
<h1><?= htmlspecialchars($page) ?></h1>
<pre><?= htmlspecialchars($content) ?></pre>

<a href="index.php">Back to list</a>
</body>
</html>

