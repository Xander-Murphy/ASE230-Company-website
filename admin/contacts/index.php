<?php
    $contactFile = '../../data/contacts.json';
    $contacts = json_decode(file_get_contents($contactFile), true) ?? [];
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
		<th scope="col">Name</th>
		<th scope="col">Subject</th>
		<th scope="col">Date</th>
        <th scope="col">Details</th>
	</tr>
	<?php if (count($contacts) > 0): ?>
		<?php foreach ($contacts as $contact): ?>
			<tr id="row-<?php echo htmlspecialchars($contact['name']); ?>">
				<td><?php echo htmlspecialchars($contact['name']); ?></td>
				<td><?php echo htmlspecialchars($contact['subject']); ?></td>
				<td><?php echo htmlspecialchars($contact['date']); ?></td>
				<td><a href="detail.php?name=<?php echo urlencode($contact['name']); ?>&date=<?php echo urlencode($contact['date']); ?>" class="btn btn-primary">Details</a></td>
			</tr>
		<?php endforeach; ?>
	<?php else: ?>
		<tr><td colspan="3">No contacts found.</td></tr>
	<?php endif; ?>
</table>

</body>
</html>