<?php
	echo $_GET["dorm_id"];
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Dorm</title>
</head>
<body>

	<div class="container-fluid">

		<!-- header -->
		<div class="row header">

			<!-- nav bar -->
			<div class="col col-3 center">
				<nav class="navbar navbar-expand-lg navbar-light">
				  <button class="navbar-toggler button-color" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarNav">
				    <ul class="navbar-nav">
				      <li class="nav-item">
				        <a class="nav-link" href="index.html"><span class="item-color">Home</span></a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="search.php"><span class="item-color">Search</span></a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="browse.php"><span class="item-color">Browse</span></a>
				      </li>
				    </ul>
				  </div>
				</nav>
			</div>

			<!-- title -->
			<div class="col col-6 center" id="title">
				<a href="index.html">
					<h1><span>USC </span>Rate My Dorm</h1>
				</a>
			</div>

			<!-- icon -->
			<div class="col col-3" id="icon">
				<img src="images/icon.png" alt="USC icon"/>
			</div>

		</div>

		<!-- slide show -->
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		  <div class="carousel-inner">
		    <div class="carousel-item active">
		      <img class="d-block w-100" src="images/irc/irc1.jpg" alt="First slide">
		    </div>
		    <div class="carousel-item">
		      <img class="d-block w-100" src="images/irc/irc2.jpg" alt="Second slide">
		    </div>
		    <div class="carousel-item">
		      <img class="d-block w-100" src="images/irc/irc3.jpg" alt="Third slide">
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

		<div class="row row-margin justify-content-center">
			<div class="col col-xs-10 welcome-message">
				<h2>International Residential College</h2>
			</div>
		</div>

		<div class="row justify-content-around row-margin">
			<div class="col col-10 col-md-5 box">
				<h4>Quick Overview</h4>
				<hr>
				<ul>
					<li>Location: Parkside</li>
					<li>Rating: 3.9</li>
					<li>Price: $$$</li>
					<li>Room Type: Single, Double</li>
				</ul>
			</div>
			<div class="col col-10 col-md-5 box">
				<h4>Write a Review</h4>
				<hr>
				<p>Help the incoming freshmen pick which dorm they should live in. Write a review for the dorm here!</p>
				<a class="btn btn-color btn-position rounded-0" href="review.php" role="button">REVIEW</a>
			</div>
		</div>

		<div class="row justify-content-center row-margin">
			<div class="col col-10 box" id="desc-box">
				<h4>About</h4>
				<hr>
				<p id="short">Parkside International Residential College is located in the southwest corner of campus. The four-story building provides housing for 400 students in a variety of five-, six-, seven- and eight-person suites...</p>
				<p id="long" class="hidden">Parkside International Residential College is located in the southwest corner of campus. The four-story building provides housing for 400 students in a variety of five-, six-, seven- and eight-person suites, mixing single and double rooms. Residents enjoy privacy and independence, as well as the benefits of a residential college. Although IRC has "international" in its name, residents are students of varying backgrounds from the U.S. and around the world. The complex shares facilities with residents of the Parkside area, including a collaborative learning center for group study, formal and informal meeting and seminar spaces, music rooms, lounges, a recreation room with exercise equipment, a laundry facility and a Customer Service Center. The central dining hall features international gourmet cuisine and accommodates special dietary needs, such as gluten-free and vegan. Residents have a required meal plan</p>
				<h6 id="more">show more</h6>
				<h6 id="less" class="hidden">show less</h6>
			</div>
		</div>

		<hr>

		<div class="row justify-content-center row-margin">
			<div class="col col-12 box">
				<h4>Ratings</h4>
				<div class="table-responsive review">
					<table class="table table-hover mt-4">
						<thead>
							<tr>
								<th>Name</th>
								<th>Date</th>
								<th>Rating</th>
								<th>Comment</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Jack Yang</td>
								<td>August 20, 2019</td>
								<td>4.5</td>
								<td>Amazing place with amazing people!</td>
								<td>
									<a href="dorm.php" class="btn btn-color-danger rounded-0">
										DELETE
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

<!-- 	<div class="footer-div">
		<div class="footer">
			Copyright 2020 University of Southern California. All rights reserved.
		</div>
	</div> -->


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="dorm.js"></script>
</body>
</html>