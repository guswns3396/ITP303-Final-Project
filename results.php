<?php 
	require "config.php";

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ($mysqli->connect_errno) {
		header("location: ./error.php");
		exit();
	}

	// echo "success";

	$mysqli->set_charset("utf8");

	// var_dump($_GET);
	$sql = "SELECT * FROM";
	$sql = $sql . " (SELECT *, dorm_id AS id FROM dorms NATURAL JOIN locations NATURAL JOIN prices";
	$sql = $sql . " NATURAL JOIN room_types) D";
	$sql = $sql . " LEFT OUTER JOIN";
	$sql = $sql . " (SELECT dorm_id, AVG(review_rating) AS review_rating FROM reviews";
	$sql = $sql . " GROUP BY dorm_id) R";
	$sql = $sql . " ON D.dorm_id = R.dorm_id";
	$sql = $sql . " WHERE 1=1";

	foreach ($_GET as $key => $val) {
		if (isset($val) && !empty($val)) {
			$sql = $sql . " AND ";	
			if ($key == "name") {
				$sql = $sql . "dorm_name LIKE '%" . $val . "%'";
			}
			elseif ($key == "review_rating") {
				$sql = $sql . $val . " < " . $key;
			}
			else {
				$sql = $sql . $key . " = " . $val;
			}	
		}
	}
	$sql = $sql . ";";
	// echo $sql;

	$results = $mysqli->query($sql);

	if (!$results) {
		header("location: ./error.php");
		exit();
	}
	// var_dump($results);

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Results</title>
</head>
<body>

	<div class="container-fluid">
		<?php include "nav.php"; ?>

		<div class="row row-margin">
			<div class="col col-12 heading">
				<h2>Search Results</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div id="results">
					Showing <?php echo $results->num_rows ?> result(s).
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th></th>
							<th>Name</th>
							<th>Rating</th>
							<th>Location</th>
							<th>Price</th>
							<th>Room Type</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row = $results->fetch_assoc()) : ?>
							<tr>
								<td>
									<a href="dorm.php?dorm_id=<?php echo $row["id"]; ?>" class="btn btn-color rounded-0">
										GO TO
									</a>
								</td>
								<td><?php echo $row["dorm_name"]; ?></td>
								<td>
									<?php
										if (isset($row["review_rating"]) && !empty($row["review_rating"])) {
											echo number_format($row["review_rating"],1);
										}
										else {
											echo "0.0";
										}
									?>
								</td>
								<td><?php echo $row["location_name"]; ?></td>
								<td><?php echo $row["price"]; ?></td>
								<td><?php echo $row["room_type_name"]; ?></td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
		

<!-- 	<div class="footer">
		Copyright 2020 University of Southern California. All rights reserved.
	</div> -->


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>