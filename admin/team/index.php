<?php
// team/index.php
require_once __DIR__ . '/../JsonHelper.php';
require 'member.php';
$dataFile = __DIR__ . '/../../data/team.json';
$members = JsonHelper::readAll($dataFile);
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

<p><a href="create.php">Add a New Member</a></p>

<?php if (empty($members)): ?>
    <p>No members found.</p>
<?php else: ?>
    <table class="table table-dark table-striped mx-auto" style="width: 50%;">
        <tr>
					<th scope="col">Member</th>
					<th scope="col">Title</th>
					<th scope="col">background</th>
					<th scope="col">Action</th>
				</tr>
        <?php foreach ($members as $m): 
            $newMember = new Member($m['name'], $m['title'], $m['background']); ?>
            <tr>
                <td><?=htmlspecialchars($newMember->name ?? '')?></td>
                <td><?=htmlspecialchars($newMember->title ?? '')?></td>
                <td><?=htmlspecialchars($newMember->background ?? '')?></td>
                <td>
					<a href="detail.php?name=<?php echo urlencode($newMember->name); ?>" class="btn btn-primary">Details</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>
