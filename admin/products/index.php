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

<h2>User List</h2>

<nav class="mb-4">
	<a class="btn btn-primary" href="index.php" role="button">Index</a>
	<a class="btn btn-primary" href="chat.php" role="button">Chat</a>
</nav>

<table class="table table-dark table-striped mx-auto" style="width: 50%;">
	<tr>
		<th scope="col">Product</th>
		<th scope="col">Email</th>
		<th scope="col">Action</th>
	</tr>
	<?php if (count($users) > 0): ?>
		<?php foreach ($users as $user): ?>
			<tr id="row-<?php echo htmlspecialchars($user['name']); ?>">
					<td><?php echo htmlspecialchars($user['name']); ?></td>
					<td><?php echo htmlspecialchars($user['description']); ?></td>
					<td>
							<button class="btn btn-primary" onclick="deleteUser('<?php echo htmlspecialchars($user['name']); ?>')">Delete</button>
					</td>
			</tr>
		<?php endforeach; ?>
	<?php else: ?>
			<tr><td colspan="3">No users found.</td></tr>
	<?php endif; ?>
</table>

<script>
  function deleteUser(product) {
    if (!confirm("Are you sure you want to delete " + product + "?")) return;

    fetch("", { // same page
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "product=" + encodeURIComponent(product)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
          document.getElementById("row-" + product).remove();
          alert("User deleted successfully!");
      } else {
          alert("Error: " + (data.message || "Unknown error"));
      }
    })
    .catch(err => console.error("Error:", err));
  }
</script>

</body>
</html>