<?php
	if ( !isset($_GET['id']) || empty($_GET['id']) ) {
		$error = "Invalid Alumni.";
	} else {
		$host = "303.itpwebdev.com";
		$user = "mkim6056_db_user";
		$pass = "Mk121600!";
		$db = "mkim6056_alumni_db";

		// DB Connection.
		$mysqli = new mysqli($host, $user, $pass, $db);

		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		$sql = "DELETE FROM alumni 
						WHERE id = " . $_GET["id"] . ";";
		
		$results = $mysqli->query($sql);

		if(!$results) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		$mysqli->close();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete an Alumni | Alumni Database</title>
	<meta name="description" content="Displays success when an alumni was successfully deleted. Can also navigate back to search results.">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="icon" type="image/png" href="img/kisa_logo.png">
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
			<h1 class="col-12 mt-4">Delete an Alumni</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>

				<?php else: ?>
					<div class="text-success"><span class="font-italic"><?php echo $_GET['alumni_name']; ?></span> was successfully deleted.</div>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="result_alumni.php" role="button" class="btn btn-primary">Back to Search Results</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>