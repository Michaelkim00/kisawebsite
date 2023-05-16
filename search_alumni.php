<?php

	$host = "303.itpwebdev.com";
	$user = "mkim6056_db_user";
	$pass = "Mk121600!";
	$db = "mkim6056_alumni_db";

	$mysqli = new mysqli($host, $user, $pass, $db);

	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$sql_major = "SELECT * FROM major;";
	$results_major = $mysqli->query( $sql_major );

	if ( !$results_major ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	$sql_industry = "SELECT * FROM industry;";
	$results_industry = $mysqli->query( $sql_industry );

	if ( !$results_industry ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

    $sql_grad = "SELECT * FROM grad;";
	$results_grad = $mysqli->query( $sql_grad );

	if ( !$results_grad ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Allows searching for alumni within the database. Also allows searching based on name, major, industry, and graduation year.">
	<title>KISA Alumni Search Form</title>
    <link rel="icon" type="image/png" href="img/kisa_logo.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <style>
		@media (max-width: 767px) {
                #footer p {
                    font-size: 70%;
                }
		}

        h1 {
            margin-top: 90px;
        }

        #footer {
            line-height: 100px;
            color: white;
        }

        #footer img {
            width: 100px;
            height: auto;
        }

        nav {
            background-color: #e3f2fd;
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
			<h1 class="col-12 mb-5">KISA Alumni Search</h1>
		</div> <!-- .row -->

        <div class="row">
            <h2 class="col-12 mb-2 text-center">Search for an Alumni!</h2>
        </div> <!-- .row -->

        <div class="row mb-5">
                <span class="col-12 font-italic text-center">
                    To show all alumni, search with all fields blank.
                </span>
        </div>
	</div> <!-- .container -->

	<div class="container">
		<form action="result_alumni.php" method="GET">
			<div class="form-group row">
				<label for="name-id" class="col-2 col-form-label text-right mb-3">Name:</label>
				<div class="col-9">
					<input type="text" class="form-control" id="name-id" name="name">
				</div>
			</div> <!-- .form-group -->
         
			<div class="form-group row">
				<label for="major-id" class="col-2 col-form-label text-right mb-3">Major:</label>
				<div class="col-9">
					<select name="major_id" id="major-id" class="form-control">
						<option value="" selected>-- All --</option>

						<?php while ( $row = $results_major->fetch_assoc() ) : ?>
							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['major']; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="industry-id" class="col-2 col-form-label text-right mb-3">Industry:</label>
				<div class="col-9">
					<select name="industry_id" id="industry-id" class="form-control">
						<option value="" selected>-- All --</option>

						<?php while ( $row = $results_industry->fetch_assoc() ) : ?>
							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['industry']; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="grad-id" class="col-2 col-form-label text-right mb-3">Graduation Year:</label>
				<div class="col-9">
					<select name="grad_id" id="grad-id" class="form-control">
						<option value="" selected>-- All --</option>

						<?php while ( $row = $results_grad->fetch_assoc() ) : ?>
							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['grad']; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-12 mt-2 mb-5 text-center">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->

    <div class="container-fluid bg-secondary">
        <div class="row" id="footer">
            <div class="col-1 text-center">
                <a href="https://www.instagram.com/kisausc/" target="_blank"><img class="w-50" src="img/ig-icon.png" alt="Instagram Icon"></a>
            </div>
            <div class="col-1 text-center">
                <a href="mailto:mkim6056@usc.edu"><img class="w-50" src="img/email-icon.webp" alt="Email Icon"></a>
            </div>

            <div class="col-3"></div>

            <div class="col-2 text-center">
                <img class="mt-3" src="img/kisa-font.png" alt="KISA Logo">
            </div>
            
            <div class="col-2"></div>
            <div class="col-3 text-center">
                &copy; 2023 USC KISA
            </div>
        </div>
    </div> <!-- .container-fluid -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>