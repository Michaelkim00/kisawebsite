<?php
	if ( !isset($_POST['name']) || empty($_POST['name'])) {
		$error = "Please fill in the name.";
	} else {
		$host = "303.itpwebdev.com";
		$user = "mkim6056_db_user";
		$pass = "Mk121600!";
		$db = "mkim6056_alumni_db";

		// Establish db connection
		$mysqli = new mysqli($host, $user, $pass, $db);

		$name = $_POST['name'];

		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		if( isset($_POST["major_id"]) && !empty($_POST["major_id"]) ) {
			$major_id = $_POST["major_id"];
		} else {
			$major_id = "null";
		}
		
		if( isset($_POST["grad_id"]) && !empty($_POST["grad_id"]) ) {
			$grad_id = $_POST["grad_id"];
		} else {
			$grad_id = "null";
		}
		
		if( isset($_POST["industry_id"]) && !empty($_POST["industry_id"]) ) {
			$industry_id = $_POST["industry_id"];
		} else {
			$industry_id = "null";
		}
		
		if( isset($_POST["company"]) && !empty($_POST["company"]) ) {
			$company = $_POST["company"];
		} else {
			$company = "null";
		}

		if( isset($_POST["position"]) && !empty($_POST["position"]) ) {
			$position = $_POST["position"];
		} else {
			$position = "null";
		}

		if( isset($_POST["location_id"]) && !empty($_POST["location_id"]) ) {
			$location_id = $_POST["location_id"];
		} else {
			$location_id = "null";
		}

		$sql = "INSERT INTO alumni (name, major_id, grad_id, industry_id, company, position, location_id) 
						VALUES('$name', $major_id, $grad_id, $industry_id, '$company', '$position', $location_id);";
		
		$results = $mysqli->query($sql);

		if (!$results) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		$mysqli->close();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | Alumni Database</title>
	<link rel="icon" type="image/png" href="img/kisa_logo.png">
	<meta name="description" content="Displays success when an alumni is successfully added with his/her name, major, graduation year, industry, company, position, and location.">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<style>
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
			<h1 class="col-12 mt-4">Add an Alumni</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if( isset($error) && !empty($error) ) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				
				<?php else : ?>

					<div class="text-success">
						<span class="font-italic">
							<?php echo $name; ?>
						</span> was successfully added.
					</div>
				<?php endif; ?>

				<!-- <div class="text-danger font-italic">Display Errors Here</div>

				<div class="text-success"><span class="font-italic">Display Title Here</span> was successfully added.</div> -->

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_alumni.php" role="button" class="btn btn-primary">Go to Search Form</a>
				<a href="add_alumni.php" role="button" class="btn btn-primary">Go to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>