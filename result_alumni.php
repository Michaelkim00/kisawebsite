<?php

    $host = "303.itpwebdev.com";
    $user = "mkim6056_db_user";
    $pass = "Mk121600!";
    $db = "mkim6056_alumni_db";

	// Establish MySQL Connection.
	$mysqli = new mysqli($host, $user, $pass, $db);

	// Check for any Connection Errors.
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');

	$sql = "SELECT alumni.id, alumni.name, major.major, grad.grad, industry.industry
					FROM alumni
					LEFT JOIN major
						ON alumni.major_id = major.id
					LEFT JOIN industry
						ON alumni.industry_id = industry.id
                    LEFT JOIN grad
						ON alumni.grad_id = grad.id
                    LEFT JOIN location
						ON alumni.location_id = location.id
					WHERE 1 = 1";

	if ( isset($_GET['name']) && trim($_GET['name']) != '' ) {
		$name = $_GET['name'];
		$sql = $sql . " AND alumni.name LIKE '%$name%'";
	}

	if ( isset( $_GET['major_id'] ) && trim( $_GET['major_id'] ) != '' ) {
		$major = $_GET['major_id'];
		$sql = $sql . " AND alumni.major_id = $major";
	}

	if ( isset( $_GET['industry_id'] ) && trim( $_GET['industry_id'] ) != '' ) {
		$industry = $_GET['industry_id'];
		$sql = $sql . " AND alumni.industry_id = $industry";
	}

    if ( isset( $_GET['location_id'] ) && trim( $_GET['location_id'] ) != '' ) {
		$location = $_GET['location_id'];
		$sql = $sql . " AND alumni.location_id = $location";
	}

    if ( isset( $_GET['grad_id'] ) && trim( $_GET['grad_id'] ) != '' ) {
		$grad = $_GET['grad_id'];
		$sql = $sql . " AND alumni.grad_id = $grad";
	}

    if ( isset($_GET['company']) && trim($_GET['company']) != '' ) {
		$company = $_GET['company'];
		$sql = $sql . " AND alumni.company LIKE '%$company%'";
	}

    if ( isset($_GET['position']) && trim($_GET['position']) != '' ) {
		$position = $_GET['position'];
		$sql = $sql . " AND alumni.position LIKE '%$position%'";
	}

	$sql = $sql . ";";

	$results = $mysqli->query($sql);

	if ( !$results ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	$total_results = $results->num_rows;
	$results_per_page = 10;
	$last_page = ceil($total_results / $results_per_page);

	if (isset($_GET['page']) && trim($_GET['page']) != '') {
		$current_page = $_GET['page'];
	} else {
		$current_page = 1;
	}

	// edge cases
	if ( $current_page < 1 || $current_page > $last_page ) {
		$current_page = 1;
	}

	$start_index = ($current_page - 1) * $results_per_page;

	$sql = rtrim($sql, ';');

	$sql = $sql . " LIMIT $start_index, $results_per_page;";

	$results = $mysqli->query($sql);

	if ( !$results ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Close MySQL Connection
	$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Displays results of alumni from alumni search. The details of the results are name, major, industry, and graduation year.">
	<title>USC KISA Alumni Search Results</title>
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
        img {
            width: 100px;
            height: auto;
        }

        #footer {
            line-height: 100px;
            color: white;
        }

        #footer img {
            width: 100px;
            height: auto;
        }

        #main-nav {
            background-color: #e3f2fd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <nav id="main-nav" class="navbar fixed-top navbar-expand-lg navbar-light">
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
			<h1 class="col-12">KISA Alumni Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row">
			<div class="col-12">

					<!-- Showing 1-10 of 100 result(s). -->

				Showing 
				<?php echo $start_index + 1; ?>
				-
				<?php echo $start_index + $results->num_rows ?>
				of
				<?php echo $total_results; ?> 
				result(s).



			</div> <!-- .col -->

			<div class="col-12">
				<table class="table table-hover mt-4">
					<thead>
						<tr>
                            <th></th>
							<th>Name</th>
							<th>Major</th>
							<th>Industry</th>
							<th>Grad Year</th>
						</tr>
					</thead>


                    <tbody>

                        <?php while($row = $results->fetch_assoc() ) : ?>

                            <tr>
                                <td>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>&alumni_name=<?php echo $row['name']; ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this track?');">
                                        Delete
                                    </a>
                                </td>
                                <td> 
                                    <a href="details.php?id=<?php echo $row['id']?>"> 
                                        <?php echo $row["name"] ?>
                                    </a>
                                </td>
                                <td> <?php echo $row["major"] ?></td>
                                <td> <?php echo $row["industry"] ?></td>
                                <td> <?php echo $row["grad"] ?></td>
                            </tr>

                        <?php endwhile; ?>
					</tbody>

				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->

        <div class="col-12">
				<nav aria-label="Page navigation example">
	<ul class="pagination justify-content-center">
		<li class="page-item <?php if ($current_page <= 1) echo 'disabled'; ?>">
			<a class="page-link" href="<?php 
				$_GET['page'] = 1;

				echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
			?>">First</a>
		</li>
		<li class="page-item <?php if ($current_page <= 1) echo 'disabled'; ?>">
			<a class="page-link" href="<?php 
				$_GET['page'] = $current_page - 1;

				echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
			?>">Previous</a>
		</li>
		<li class="page-item active">
			<a class="page-link" href="">
				<?php echo $current_page; ?>
			</a>
		</li>
		<li class="page-item <?php if ($current_page >= $last_page) echo 'disabled'; ?>">
			<a class="page-link" href="<?php 
				$_GET['page'] = $current_page + 1;

				echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
			?>">Next</a>
		</li>
		<li class="page-item <?php if ($current_page >= $last_page) echo 'disabled'; ?>">
			<a class="page-link" href="<?php 
				$_GET['page'] = $last_page;

				echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
			?>">Last</a>
		</li>
	</ul>
</nav>
			</div> <!-- .col -->

		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_alumni.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
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

    <script>

		const bindRemoveBtns = () => {
			const buttons = document.querySelectorAll(".delete-button")

            const message = document.querySelector("#message")

			for (btn of buttons) {
				btn.onclick = function() {
					this.parentNode.parentNode.remove()
                    message.innerHTML = "Successfully Deleted."
				}
			}
		}

        bindRemoveBtns()
    </script>

</body>

</html>