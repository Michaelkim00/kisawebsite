<?php
	if ( !isset($_GET['id']) || empty($_GET['id'])) {
		echo "Invalid URL";
        exit();
	}

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

	$mysqli->set_charset('utf-8');

	$sql_major = "SELECT * FROM major;";
	$results_major = $mysqli->query( $sql_major );
	if ( !$results_major ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Retrieve all media types from the DB.
	$sql_industry = "SELECT * FROM industry;";
	$results_industry = $mysqli->query( $sql_industry );
	// Check for SQL Errors.
	if ( !$results_industry ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	$sql_grad = "SELECT * FROM grad;";
	$results_grad = $mysqli->query( $sql_grad );
	// Check for SQL Errors.
	if ( !$results_grad ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	$sql_location = "SELECT * FROM location;";
	$results_location = $mysqli->query( $sql_location );
	// Check for SQL Errors.
	if ( !$results_location ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Details of the title
	$sql = "SELECT * FROM alumni 
					WHERE id = " . $_GET["id"] . ";";

	$results = $mysqli->query($sql);
	
	if(!$results) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	$row_name = $results->fetch_assoc();

	$mysqli->close();
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Alumni | Alumni Database</title>
	<meta name="description" content="Allows editing of an alumni for his/her detail. Must provide name, major, graduation year, industry, company, position, and location.">
	<link rel="icon" type="image/png" href="img/kisa_logo.png">
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
			<h1 class="col-12 mt-4 mb-4">Edit an Alumni</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

			<?php if ( isset($error) && !empty($error) ) : ?>
				<div class="col-12 text-danger">
					<?php echo $error; ?>
				</div>
			<?php endif; ?>

			<form action="edit_confirmation.php" method="POST">

				<div class="form-group row">
					<label for="name-id" class="col-3 col-form-label text-right">
						Name: <span class="text-danger">*</span>
					</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="name-id" name="name" value="<?php echo $row_name['name']; ?>">
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="major-id" class="col-3 col-form-label text-right">Major: <span class="text-danger">*</span></label>
					<div class="col-9">
						<select name="major_id" id="major-id" class="form-control">
							<option value="" selected disabled>-- Select One --</option>

							<?php while( $row = $results_major->fetch_assoc() ): ?>

								<?php if( $row['id'] == $row_name['major_id']) : ?>
									
									<option value="<?php echo $row['id']; ?>" selected>
										<?php echo $row['major']; ?>
									</option>

								<?php else : ?>
								
									<option value="<?php echo $row['id']; ?>">
										<?php echo $row['major']; ?>
									</option>
								<?php endif; ?>

							<?php endwhile; ?>

						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="industry-id" class="col-sm-3 col-form-label text-sm-right">Industry: <span class="text-danger">*</span></label>
					<div class="col-sm-9">
						<select name="industry_id" id="industry-id" class="form-control">
							<option value="" selected disabled>-- Select One --</option>

							<?php while( $row = $results_industry->fetch_assoc() ): ?>

								<?php if( $row["id"] == $row_name["industry_id"]) : ?>
									
									<option selected value="<?php echo $row['id']; ?>" selected>
										<?php echo $row['industry']; ?>
									</option>

								<?php else : ?>
									
									<option value="<?php echo $row['id']; ?>">
										<?php echo $row['industry']; ?>
									</option>
								<?php endif; ?>

							<?php endwhile; ?>

						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="location-id" class="col-sm-3 col-form-label text-sm-right">Location: <span class="text-danger">*</span></label>
					<div class="col-sm-9">
						<select name="location_id" id="location-id" class="form-control">
							<option value="" selected disabled>-- Select One --</option>

							<?php while( $row = $results_location->fetch_assoc() ): ?>

								<?php if( $row["id"] == $row_name["location_id"]) : ?>
									
									<option selected value="<?php echo $row['id']; ?>" selected>
										<?php echo $row['location']; ?>
									</option>

								<?php else : ?>
									
									<option value="<?php echo $row['id']; ?>">
										<?php echo $row['location']; ?>
									</option>
								<?php endif; ?>

							<?php endwhile; ?>

						</select>
					</div>
				</div> <!-- .form-group -->

                <div class="form-group row">
					<label for="company-id" class="col-sm-3 col-form-label text-sm-right">
						Company: <span class="text-danger">*</span>
					</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="company-id" name="company" value="<?php echo $row_name['company']; ?>">
					</div>
				</div> <!-- .form-group -->

                <div class="form-group row">
					<label for="position-id" class="col-sm-3 col-form-label text-sm-right">
						Position: <span class="text-danger">*</span>
					</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="position-id" name="position" value="<?php echo $row_name['position']; ?>">
					</div>
				</div> <!-- .form-group -->

                <div class="form-group row">
					<label for="grad-id" class="col-sm-3 col-form-label text-sm-right">Grad Year: <span class="text-danger">*</span></label>
					<div class="col-sm-9">
						<select name="grad_id" id="grad-id" class="form-control">
							<option value="" selected disabled>-- Select One --</option>

							<?php while( $row = $results_grad->fetch_assoc() ): ?>

								<?php if( $row["id"] == $row_name["grad_id"]) : ?>
									
									<option value="<?php echo $row['id']; ?>" selected>
										<?php echo $row['grad']; ?>
									</option>

								<?php else : ?>
									
									<option value="<?php echo $row['id']; ?>">
										<?php echo $row['grad']; ?>
									</option>
								<?php endif; ?>

							<?php endwhile; ?>

						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<div class="ml-auto col-sm-9">
						<span class="text-danger font-italic">* Required</span>
					</div>
				</div> <!-- .form-group -->

				<input type="hidden" name="id" value="<?php echo $row_name['id']; ?>"/>

				<div class="form-group row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 mt-2">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="reset" class="btn btn-light">Reset</button>
					</div>
				</div> <!-- .form-group -->

			</form>

	</div> <!-- .container -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>