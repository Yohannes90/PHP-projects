<?php
require "./conn.php";

	// quering and fetching URLs from database
	$select = $conn->query('SELECT * FROM urls');
	$select->execute();
	$rows = $select->fetchAll(PDO::FETCH_OBJ);

	// inserting URLs to database
	if (isset($_POST['submit'])) {
		if ($_POST['url'] == '') {
			echo ("Please input URL to shorten");
		} else {
			$url = $_POST['url'];
			$insert = $conn->prepare("INSERT INTO urls (url) VALUES (:url)");
			$insert->execute([
				':url' => $url
			]);
		}
	}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
		body {
			/* overflow: hidden; */
		}

		/* .margin {
			margin-top: 100px;
		}

		.head-margin {
			margin-top: 160px;
			margin-bottom: -80px
		} */
	</style>
	<title>URL Shortner</title>
</head>

<body>

	<div class="conatiner mb-5">
		<div class="row text-center justify-content-center">
			<div class="col-md-6">
				<h3 class="text-center head-margin bg-success ">URL Shortner</h3>

				<form class="card p-2 margin" method="POST" action="index.php">
					<div class="input-group">
						<input type="text" name="url" class="form-control mt-2" placeholder="Enter URL to shorten e.g 'www.yoursite.com/?/post/2021/12/08/$5982-!#_ref;di(@%'">
					</div>
					<div class="input-group-append m-4">
						<button type="submit" name="submit" class="btn btn-success w-100">Submit</button>
					</div>
				</form>
				<table class="table table-striped border">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Long URLs</th>
							<th scope="col">Shortened URLs</th>
							<th scope="col">Clicks</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($rows as $row) : ?>
							<tr>
								<th scope="row"><?php echo $row->id ?></th>
								<td><?php echo $row->url ?></td>
								<td><?php echo "$row->short_url" ?></td>
								<td><?php echo $row->clicks ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</body>

</html>
