<?php
	require 'awards.php';
	$awardPath = '../../data/awards.csv';
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
		<th scope="col">Year</th>
		<th scope="col">Award</th>
		<th scope="col">Details</th>
		<th scope="col">Action</th>
	</tr>
	<?php
		$csvData = readAllCSV($awardPath);
		foreach($csvData as $award){
			if($award[0] != 'Year')
			echo
				'<tr>
					<td> ' . $award[0] . '</td>
					<td> ' . $award[1] . '</td>
					<td> ' . $award[2] . '</td>
					<td><a href="detail.php?award=' . $award[1] . '&year=' . $award[0] . '" class="btn btn-primary">Details</a></td>
					</tr>';
		}
	?>
</table>
<a href='create.php'>Create a New Award</a>

</body>
</html>