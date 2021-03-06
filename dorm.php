<?php
	require "config.php";

	// echo $_GET["dorm_id"];

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ($mysqli->connect_errno) {
		header("location: ./error.php");
		exit();
	}

	$error = true;
	$review_err = true;

	if (isset($_GET["dorm_id"]) && !empty($_GET["dorm_id"])) {

		$mysqli->set_charset("utf8");

		$sql = "SELECT * FROM dorms NATURAL JOIN locations";
		$sql = $sql . " NATURAL JOIN prices NATURAL JOIN room_types WHERE dorm_id = ?";
		// echo $sql;

		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("i", $_GET["dorm_id"]);
		$stmt->execute();

		$results = $stmt->get_result();

		if (!$results) {
			header("location: ./error.php");
			exit();
		}

		$dorm = $results->fetch_assoc();

		$sql = "SELECT * FROM reviews NATURAL JOIN users WHERE dorm_id = ? ORDER BY review_date DESC";
		// echo $sql;

		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("i", $_GET["dorm_id"]);
		$stmt->execute();

		$results = $stmt->get_result();

		if (!$results) {
			header("location: ./error.php");
			exit();
		}

		$rating = 0;
		$reviews = [];
		while ($row = $results->fetch_assoc()) {
			array_push($reviews, $row);
			$rating = $rating + $row["review_rating"];
		}
		if ($results->num_rows > 0) {
			$rating = number_format($rating / $results->num_rows, 1);
		}
		else {
			$rating = 0;
			$noReviews = true;
		}
		// echo $rating;

		define("RPP", 5);
		$num_reviews = sizeof($reviews);
		$last_page = ceil($num_reviews / RPP);
		$current_page = 1;

		if (isset($_GET["page"]) && !empty($_GET["page"])) {
			$current_page = (int)$_GET["page"];
		}

		if ($current_page < 1) {
			$current_page = 1;
		}
		elseif ($current_page > $last_page) {
			$current_page = $last_page;
		}

		$start_index = ($current_page - 1) * RPP;
	}

	if (isset($dorm) && !empty($dorm)) {
		$error = false;

		$path = str_replace(" ", "%20", $dorm["dorm_name"]);
		// echo $path;

		$desc = "";
		for ($i = 0; $i < 330; $i++) {
			$desc = $desc . $dorm["dorm_desc"][$i];
		}
		$desc = $desc . " ... ";
		// echo $desc;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Dorm</title>
</head>
<body>

	<div class="container-fluid">

		<?php include "nav.php"; ?>

		<?php if (!$error) : ?>
			<!-- slide show -->
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner">
			    <div class="carousel-item active">
			      <img class="d-block w-100" src="images/<?php echo $path ; ?>/1.jpg" alt="First slide">
			    </div>
			    <div class="carousel-item">
			      <img class="d-block w-100" src="images/<?php echo $path ; ?>/2.jpg" alt="Second slide">
			    </div>
			    <div class="carousel-item">
			      <img class="d-block w-100" src="images/<?php echo $path ; ?>/3.jpg" alt="Third slide">
			    </div>
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		<?php endif; ?>

		<?php if ($error) : ?>
			<div class="row row-margin justify-content-center">
				<div class="col col-xs-10 welcome-message">
					<h2>
						The dorm does not exist :o
					</h2>
				</div>
			</div>
		<?php else : ?>
			<div class="row row-margin justify-content-center">
				<div class="col col-xs-10 welcome-message">
					<h2>
						<?php echo $dorm["dorm_name"]; ?>
					</h2>
				</div>
			</div>

			<div class="row justify-content-around row-margin">
				<div class="col col-10 col-md-5 box">
					<h4>Quick Overview</h4>
					<hr>
					<ul>
						<li>Location: <?php echo $dorm["location_name"]; ?></li>
						<li>Rating: <?php echo $rating; ?></li>
						<li>Price: <?php echo $dorm["price"]; ?></li>
						<li>Room Type: <?php echo $dorm["room_type_name"]; ?></li>
					</ul>
				</div>
				<div class="col col-10 col-md-5 box">
					<h4>Write a Review</h4>
					<hr>
					<p>Help the incoming freshmen pick which dorm they should live in. Write a review for the dorm here!</p>

					<?php if ($_SESSION["logged"]) : ?>
						<form action="review.php" method="POST">
							<input type="hidden" name="dorm_id" value="<?php echo $dorm["dorm_id"]; ?>"/>
							<button type="submit" class="btn btn-color btn-position rounded-0">REVIEW</button>
						</form>
					<?php else : ?>
						<a class="btn btn-color btn-position rounded-0" href="login.php" role="button">REVIEW</a>
					<?php endif; ?>

				</div>
			</div>

			<div class="row justify-content-center row-margin">
				<div class="col col-10 box" id="desc-box">
					<h4>About</h4>
					<hr>
					<p id="short"><?php echo $desc; ?></p>
					<p id="long" class="hidden"><?php echo $dorm["dorm_desc"]; ?></p>
					<h6 id="more">show more</h6>
					<h6 id="less" class="hidden">show less</h6>
				</div>
			</div>

			<hr>

			<div class="row justify-content-center row-margin">
				<div class="col col-12 box">
					<h4>Reviews</h4>
					<div class="table-responsive review">
						<table class="table table-hover mt-4">
							<thead>
								<tr>
									<th>Name</th>
									<th>Date</th>
									<th>Rating</th>
									<th>Comment</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php for ($i = $start_index; $i < $start_index + RPP && !$noReviews && $i < sizeof($reviews); $i++) : ?>
									<tr>
										<td><?php echo $reviews[$i]["user_name"]; ?></td>
										<td><?php echo $reviews[$i]["review_date"]; ?></td>
										<td><?php echo $reviews[$i]["review_rating"]; ?></td>
										<td><?php echo $reviews[$i]["review_comment"]; ?></td>
										<td>
											<?php if ($_SESSION["logged"] && ($_SESSION["user_name"] == $reviews[$i]["user_name"] || $_SESSION["user_admin"])) : ?>
												<form action="review.php" method="POST">
													<input type="hidden" name="isUpdate" value="1"/>
													<input type="hidden" name="review_id" value="<?php echo $reviews[$i]["review_id"]; ?>"/>
													<button type="submit" class="btn btn-color rounded-0">UPDATE</button>
												</form>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($_SESSION["logged"] && ($_SESSION["user_name"] == $reviews[$i]["user_name"] || $_SESSION["user_admin"])) : ?>
												<form action="delete_confirmation.php" method="POST">
													<input type="hidden" name="review_id" value="<?php echo $reviews[$i]["review_id"]; ?>"/>
													<input type="hidden" name="dorm_id" value="<?php echo $dorm["dorm_id"]; ?>"/>
													<button type="submit" class="btn btn-color-danger rounded-0" onclick="return confirm('Are you sure you want to delete this review?')">DELETE</button>
												</form>
											<?php endif; ?>
										</td>
									</tr>
								<?php endfor; ?>
							</tbody>
						</table>
						<nav id="page">
						  <ul class="pagination justify-content-center">
						    <li class="page-item"><a class="page-link page-color" href="<?php echo "dorm.php?dorm_id=" . $_GET["dorm_id"] . "&page=" . strval($current_page - 1); ?>">PREV</a></li>
						    <?php if ($current_page == 1) : ?>
						    	<?php for ($i = 0; $i < 3; $i++) : ?>
							    	<?php if ($current_page + $i >= 1 && $current_page + $i <= $last_page) : ?>
							    		<?php if ($current_page + $i == $current_page) : ?>
									    	<li class="page-item">
									    			<a class="page-link page-color page-active" href="<?php echo "dorm.php?dorm_id=" . $_GET["dorm_id"] . "&page=" . strval($current_page + $i); ?>">
									    			<?php echo $current_page + $i; ?>
								    			</a>
								    		</li>
						    			<?php else : ?>
									    	<li class="page-item">
									    			<a class="page-link page-color" href="<?php echo "dorm.php?dorm_id=" . $_GET["dorm_id"] . "&page=" . strval($current_page + $i); ?>">
									    			<?php echo $current_page + $i; ?>
								    			</a>
								    		</li>
							    		<?php endif; ?>
							    	<?php endif; ?>
							    <?php endfor; ?>
						    <?php elseif ($current_page == $last_page) : ?>
						    	<?php for ($i = -2; $i < 1; $i++) : ?>
							    	<?php if ($current_page + $i >= 1 && $current_page + $i <= $last_page) : ?>
							    		<?php if ($current_page + $i == $current_page) : ?>
									    	<li class="page-item">
									    			<a class="page-link page-color page-active" href="<?php echo "dorm.php?dorm_id=" . $_GET["dorm_id"] . "&page=" . strval($current_page + $i); ?>">
									    			<?php echo $current_page + $i; ?>
								    			</a>
								    		</li>
						    			<?php else : ?>
									    	<li class="page-item">
									    			<a class="page-link page-color" href="<?php echo "dorm.php?dorm_id=" . $_GET["dorm_id"] . "&page=" . strval($current_page + $i); ?>">
									    			<?php echo $current_page + $i; ?>
								    			</a>
								    		</li>
							    		<?php endif; ?>
							    	<?php endif; ?>
							    <?php endfor; ?>
						    <?php else : ?>
							    <?php for ($i = -1; $i < 2; $i++) : ?>
							    	<?php if ($current_page + $i >= 1 && $current_page + $i <= $last_page) : ?>
							    		<?php if ($current_page + $i == $current_page) : ?>
									    	<li class="page-item">
									    			<a class="page-link page-color page-active" href="<?php echo "dorm.php?dorm_id=" . $_GET["dorm_id"] . "&page=" . strval($current_page + $i); ?>">
									    			<?php echo $current_page + $i; ?>
								    			</a>
								    		</li>
						    			<?php else : ?>
									    	<li class="page-item">
									    			<a class="page-link page-color" href="<?php echo "dorm.php?dorm_id=" . $_GET["dorm_id"] . "&page=" . strval($current_page + $i); ?>">
									    			<?php echo $current_page + $i; ?>
								    			</a>
								    		</li>
							    		<?php endif; ?>
							    	<?php endif; ?>
							    <?php endfor; ?>
							<?php endif; ?>
						    <li class="page-item"><a class="page-link page-color" href="<?php echo "dorm.php?dorm_id=" . $_GET["dorm_id"] . "&page=" . strval($current_page + 1); ?>">NEXT</a></li>
						  </ul>
						</nav>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>

<!-- 	<div class="footer-div">
		<div class="footer">
			Copyright 2020 University of Southern California. All rights reserved.
		</div>
	</div> -->


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="js/dorm.js"></script>
</body>
</html>