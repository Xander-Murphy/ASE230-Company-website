<?php
// products/index.php
require_once __DIR__ . '/../JsonHelper.php';

$dataFile = __DIR__ . '/../../data/products.json';
$products = JsonHelper::readAll($dataFile);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Panel</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100 text-light bg-dark text-center">

<h2>Admin Index</h2>

<p><a href="create.php">Create new product</a></p>

<?php if (empty($products)): ?>
    <p>No products found.</p>
<?php else: ?>
    <table class="table table-dark table-striped mx-auto" style="width: 50%;">
        <tr>
					<th scope="col">Product</th>
					<th scope="col">Description</th>
					<th scope="col">Applications</th>
					<th scope="col">Action</th>
				</tr>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?=htmlspecialchars($p['name'] ?? '')?></td>
                <td><?=nl2br(htmlspecialchars($p['description'] ?? ''))?></td>
                <td><?=htmlspecialchars(implode(', ', $p['applications'] ?? []))?></td>
                <td>
					<a href="detail.php?name=<?php echo urlencode($p['name']); ?>" class="btn btn-primary">Details</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>
