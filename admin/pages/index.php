<?php
include 'pages.php';
$pages = getAllPages();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Pages</title>
</head>
<body>
<h1>Website Pages</h1>

<table border="1">
    <tr><th>Page</th><th>Actions</th></tr>
    <?php foreach ($pages as $page): ?>
        <tr>
            <td><?= htmlspecialchars($page) ?></td>
            <td>
                <a href="detail.php?page=<?= urlencode($page) ?>">View</a> |
                <a href="edit.php?page=<?= urlencode($page) ?>">Edit</a> |
                <a href="delete.php?page=<?= urlencode($page) ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="create.php">Create New Page</a>
</body>
</html>

