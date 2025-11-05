<?php
include '../pages.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $content = $_POST['content'];

    if (createPage($name, $content)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "A page with that name already exists!";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Create Page</title></head>
<body>
<h1>Create New Page</h1>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Page Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Content:</label><br>
    <textarea name="content" rows="10" cols="60"></textarea><br><br>

    <button type="submit">Create Page</button>
</form>

<a href="index.php">Cancel</a>
</body>
</html>
