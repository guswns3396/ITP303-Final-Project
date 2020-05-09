<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Search</title>
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

		<div class="row row-margin">
			<div class="col col-12 heading">
				<h2>Search</h2>
			</div>
		</div>


		<form action="results.php" method="">
			<!-- name, rating, location, price, room -->
			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name-id" name="name">
				</div>
			</div>
			<div class="form-group row">
				<label for="location-id" class="col-sm-3 col-form-label text-sm-right">Location:</label>
				<div class="col-sm-9">
					<select name="location" id="location-id" class="form-control">
						<option value="" selected>-- All --</option>
						<option value="1">Parkside</option>
						<option value="2">North</option>
						<option value="3">South</option>
						<option value="4">West</option>
						<option value="5">Village</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="rating-id" class="col-sm-3 col-form-label text-sm-right">Rating:</label>
				<div class="col-sm-9">
					<select name="rating" id="rating-id" class="form-control">
						<option value="0">0 &lt;</option>
						<option value="1">1 &lt;</option>
						<option value="2">2 &lt;</option>
						<option value="3">3 &lt;</option>
						<option value="4">4 &lt;</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="price-id" class="col-sm-3 col-form-label text-sm-right">Price:</label>
				<div class="col-sm-9">
					<select name="price" id="price-id" class="form-control">
						<option value="1">$</option>
						<option value="2">$$</option>
						<option value="3">$$$</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-3 col-form-label text-sm-right">Room Type:</label>
				<div class="col-sm-9">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="1" id="check1">
						<label class="form-check-label" for="check1">
							Single
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="1" id="check2">
						<label class="form-check-label" for="check2">
							Double
						</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-color rounded-0">Search</button>
				</div>
			</div>

		</form>
	</div>

<!-- 	<div class="footer">
		Copyright 2020 University of Southern California. All rights reserved.
	</div> -->


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>