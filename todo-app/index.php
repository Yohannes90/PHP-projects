<?php

require "conn.php";

if(isset($_POST["submit"])) {
	$task = $_POST['mytask'];
	$insert = $conn->prepare("INSERT INTO tasks (name) VALUES (:name)");
	$insert->execute([':name' => $task]);
	header("location: index.php");
}

$data = $conn->query("SELECT * FROM tasks");
$data->execute();
$rows = $data->fetchAll(PDO::FETCH_OBJ);




?>

<!DOCTYPE html>
<html>

<head>
	<title>todos</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="style.css">

</head>

<body>
	<div class="container">
		<form method="POST" action="insert.php" class="form-inline" id="user_form">

			<div class="form-group mx-sm-3 mb-2">
				<label for="inputPassword2" class="sr-only">create</label>
				<input name="mytask" type="text" class="form-control" id="task" placeholder="enter task">
			</div>

			<input type="submit" name="submit" class="btn btn-primary" value="Insert" />
		</form>

		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Task Name</th>
					<th>delete</th>
					<th>update</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($rows as $row) : ?>
					<tr>

						<td><?php echo $row->id; ?></td>
						<td><?php echo $row->name; ?></td>
						<td><a href="delete.php?del_id=<?php echo $row->id; ?>" class="btn btn-danger">delete</a></td>
						<td><a href="update.php?upd_id=<?php echo $row->id; ?>" class="btn btn-warning">update</a></td>
					</tr>
				<?php endforeach; ?>


			</tbody>
		</table>
	</div>



</body>

</html>
