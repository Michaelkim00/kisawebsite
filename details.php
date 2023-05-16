<?php
	if( !isset( $_GET["id"] ) || empty($_GET["id"]) ) {
		$error = "Invalid URL.";
	} else {
		// Connect to db
		$host = "303.itpwebdev.com";
		$user = "mkim6056_db_user";
		$pass = "Mk121600!";
		$db = "mkim6056_alumni_db";

		// Establish MySQL Connection.
		$mysqli = new mysqli($host, $user, $pass, $db);

		if( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		// Write the SQL statement
		$sql = "SELECT alumni.id, alumni.name, major.major AS major, grad.grad AS grad, location.location AS location, alumni.company, alumni.position, industry.industry AS industry
					FROM alumni
					LEFT JOIN major
						ON alumni.major_id = major.id
					LEFT JOIN grad
						ON alumni.grad_id = grad.id
					LEFT JOIN industry
						ON alumni.industry_id = industry.id
					LEFT JOIN location
						ON alumni.location_id = location.id
					WHERE alumni.id = " . $_GET["id"]  . ";";
		
		$results = $mysqli->query($sql);

		if( !$results ) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}
		
		// Close the connection
		$mysqli->close();

		$row = $results->fetch_assoc();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Details | Alumni Database</title>
	<meta name="description" content="Displays details of an alumni with his/her name, major, graduation year, location, industry, company, and position.">
	<link rel="icon" type="image/png" href="img/kisa_logo.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<style>
		h1 {
			margin-top: 90px;
		}

		@media (max-width: 767px) {
                #footer p {
                    font-size: 70%;
                }
		}
	</style>
</head>
<body>
	<div class="container">
        <div class="row">
            <nav class="navbar fixed-top navbar-expand-lg navbar-light">
                <div class="d-flex flex-grow-1">
                    <span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
                    <a class="navbar-brand d-none d-lg-inline-block" href="finalproject.html">
                        <img src="img/kisa-font.png" width="80" alt="KISA Logo">
                    </a>
                    <a class="navbar-brand-two mx-auto d-lg-none d-inline-block" href="finalproject.html">
                        <img src="img/kisa-font.png" width="80" alt="logo">
                    </a>
                    <div class="w-100 text-right">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </div>
                <div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar">
                    <ul class="navbar-nav ml-auto flex-nowrap">
                        <li class="nav-item">
                            <a href="finalproject.html" class="nav-link m-2 menu-item nav-active">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle m-2" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Members
                            </a>
    
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="eboard.html">Eboard</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="alumni_main.html">Alumni</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle m-2" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Schedule
                            </a>
    
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                <a class="dropdown-item" href="fall_schedule.html">Fall Semester</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="spring_schedule.html">Spring Semester</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="recruitment.html" class="nav-link m-2 menu-item">Recruitment</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div> 
    </div>

	<div class="container">
		<div class="row">
			<h1 class="col-12">Alumni Details</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && !empty($error) ) : ?>

					<div class="text-danger">
						<?php echo $error; ?>
					</div>

				<?php else : ?>

				<table class="table table-responsive">

					<tr>
						<th class="text-right">Title:</th>
						<td><?php echo $row['name']; ?></td>
					</tr>

					<tr>
						<th class="text-right">Major</th>
						<td><?php echo $row['major']; ?></td>
					</tr>

					<tr>
						<th class="text-right">Industry:</th>
						<td><?php echo $row['industry']; ?></td>
					</tr>

					<tr>
						<th class="text-right">Location:</th>
						<td><?php echo $row['location']; ?></td>
					</tr>

					<tr>
						<th class="text-right">Company:</th>
						<td><?php echo $row['company']; ?></td>
					</tr>

					<tr>
						<th class="text-right">Position:</th>
						<td><?php echo $row['position']; ?></td>
					</tr>

					<tr>
						<th class="text-right">Grad Year:</th>
						<td><?php echo $row['grad']; ?></td>
					</tr>

				</table>

				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
			<a href="search_alumni.php" role="button" class="btn btn-primary">Back to Search Results</a>
				<a href="edit_alumni.php?id=<?php echo $row['id']?>" role="button" class="btn btn-warning">Edit This Alumni</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>