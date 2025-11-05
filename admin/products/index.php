<?php
// users.php

// Path to JSON file
$productsFile = '../../data/products.json';

// Handle AJAX deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
	header('Content-Type: application/json');
	$product = $_POST['name'];

	// Load users
	$users = json_decode(file_get_contents($productsFile), true) ?? [];

	// Filter out deleted user
	$newUsers = array_filter($users, fn($u) => $u['name'] !== $product);

	// Save updated list
	if (file_put_contents($productsFile, json_encode(array_values($newUsers), JSON_PRETTY_PRINT))) {
		echo json_encode(['success' => true]);
	} else {
		echo json_encode(['success' => false, 'message' => 'Failed to update file']);
	}
	exit;
}

// Normal page load: read users
$users = json_decode(file_get_contents($productsFile), true) ?? [];
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

<nav class="mb-4">
	<a class="btn btn-primary" href="index.php" role="button">Index</a>
</nav>

<table class="table table-dark table-striped mx-auto" style="width: 50%;">
	<tr>
		<th scope="col">Product</th>
		<th scope="col">Description</th>
		<th scope="col">Applications</th>
		<th scope="col">Action</th>
	</tr>
	<?php if (count($users) > 0): ?>
		<?php foreach ($users as $user): ?>
			<tr id="row-<?php echo htmlspecialchars($user['name']); ?>">
				<td><?php echo htmlspecialchars($user['name']); ?></td>
				<td><?php echo htmlspecialchars($user['description']); ?></td>
				<td>
				<?php 
					for($i = 0; $i < count($user['applications']); $i++) {
						echo htmlspecialchars($user['applications'][$i]) . "," . "<br>";
					}
				?>
				</td>
				<td>
					<a href="detail.php?name=<?php echo urlencode($user['name']); ?>" class="btn btn-primary">Details</a>
				</td>
			</tr>
		<?php endforeach; ?>
	<?php else: ?>
		<tr><td colspan="3">No products found.</td></tr>
	<?php endif; ?>
</table>
<a href='create.php'>Create a New Product</a>

</body>
</html>