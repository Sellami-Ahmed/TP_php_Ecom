<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	echo (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true);
	header("location: ../index.php");
	exit;
}
require_once "DBconnect.php";
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Check if username is empty
	if (empty(trim($_POST["username"]))) {
		$username_err = "Please enter username.";
	} else {
		$username = trim($_POST["username"]);
	}

	// Check if password is empty
	if (empty(trim($_POST["password"]))) {
		$password_err = "Please enter your password.";
	} else {
		$password = trim($_POST["password"]);
	}

	// Validate credentials
	if (empty($username_err) && empty($password_err)) {
		// Prepare a select statement
		$sql = "SELECT id, username, password FROM users WHERE username = :username";

		if ($stmt = $pdo->prepare($sql)) {
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

			// Set parameters
			$param_username = trim($_POST["username"]);

			// Attempt to execute the prepared statement
			if ($stmt->execute()) {
				// Check if username exists, if yes then verify password
				if ($stmt->rowCount() == 1) {
					if ($row = $stmt->fetch()) {
						$id = $row["id"];
						$username = $row["username"];
						$Rpassword = $row["password"];
						if ($password == $Rpassword) {
							// Password is correct, so start a new session
							

							// Store data in session variables
							$_SESSION["loggedin"] = true;
							$_SESSION["id"] = $id;
							$_SESSION["username"] = $username;
							if (!empty($_POST["remember"])) {
								setcookie("username", $username, time() + 3600);
								setcookie("password", $password, time() + 3600);
							} else {
								setcookie("username", "");
								setcookie("password", "");
							}
							// Redirect user to welcome page
							header("location:../index.php");
						} else {
							// Password is not valid, display a generic error message
							$login_err = "Invalid username or password.";
						}
					}
				} else {
					// Username doesn't exist, display a generic error message
					$login_err = "Invalid username or password.";
				}
			} else {
				echo "Oops! Something went wrong. Please try again later.";
			}

			// Close statement
			unset($stmt);
		}
	}

	// Close connection
	unset($pdo);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login page</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<style>
		body {

			background: #eeeeee;

			font-family: 'Varela Round', sans-serif;
		}

		.form-control {
			font-size: 16px;
			transition: all 0.4s;
			box-shadow: none;
		}

		.form-control:focus {
			border-color: #5c6ac4;
		}

		.form-control,
		.btn {
			border-radius: 50px;
			outline: none !important;
		}

		.signin-form {
			width: 400px;
			margin: 0 auto;
			padding: 30px 0;
		}



		.signin-form h2 {
			text-align: center;
			font-size: 34px;
			margin: 10px 0 15px;

		}

		.signin-form .hint-text {
			color: #999;
			text-align: center;
			margin-bottom: 20px;
		}

		.signin-form .form-group {
			margin-bottom: 20px;

		}

		.signin-form .btn {
			font-size: 18px;
			line-height: 26px;
			font-weight: bold;
			text-align: center;
			background: #5c6ac4;
			border-color: #507cc0;

		}

		.signin-form .btn:hover {
			background-color: #507cc0;
		}

		.signin-form .small {
			font-size: 13px;
		}

		.signin-btn:hover {
			background: #5c6ac4;
			opacity: 0.8;
		}

		.or-seperator {
			margin: 50px 0 15px;
			text-align: center;
			border-top: 1px solid #e0e0e0;
		}

		.or-seperator b {
			padding: 0 10px;
			width: 40px;
			height: 40px;
			font-size: 16px;
			text-align: center;
			line-height: 40px;
			background: #fff;
			display: inline-block;
			border: 1px solid #e0e0e0;
			border-radius: 50%;
			position: relative;
			top: -22px;
			z-index: 1;
		}

		.social-btn .btn {
			color: #fff;
			margin: 10px 0 0 30px;
			font-size: 15px;
			width: 55px;
			height: 55px;
			line-height: 45px;
			border-radius: 50%;
			font-weight: normal;
			text-align: center;
			border: none;
			transition: all 0.4s;
		}

		.social-btn .btn:first-child {
			margin-left: 0;
		}

		.social-btn .btn:hover {
			opacity: 0.8;
		}

		.social-btn .btn-primary {
			background: #507cc0;
		}

		.social-btn .btn-info {
			background: #64ccf1;
		}

		.social-btn .btn-danger {
			background: #df4930;
		}

		.social-btn .btn i {
			font-size: 20px;
		}
	</style>
	<?php
	include("loginHeader.php");
	?>
</head>

<body>
	<div class="signin-form">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<h2>Sign in</h2>
			<p class="hint-text">Sign in with your social media account</p>
			<div class="social-btn text-center">
				<a href="#" class="btn btn-primary btn-lg" title="Facebook"><i class="fa fa-facebook"></i></a>
				<a href="#" class="btn btn-info btn-lg" title="Twitter"><i class="fa fa-twitter"></i></a>
				<a href="#" class="btn btn-danger btn-lg" title="Google"><i class="fa fa-google"></i></a>
			</div>
			<div class="or-seperator"><b>or</b></div>
			<?php if (!empty($login_err)) {
				echo '<div class="alert alert-danger">' . $login_err . '</div>';
			}
			if (isset($_SESSION['alert'])) {
				echo $_SESSION['alert'];
				unset($_SESSION['alert']);
			} ?>
			<div class="form-group">
				<input type="text" value="<?php if (isset($_COOKIE["username"])) {
												echo $_COOKIE["username"];
											} ?>" name="username" placeholder="Username" required="required" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
				<span class="invalid-feedback"><?php echo $username_err; ?></span>
			</div>
			<div class="form-group">
				<input type="password" value="<?php if (isset($_COOKIE["password"])) {
													echo $_COOKIE["password"];
												} ?>" name="password" placeholder="Password" required="required" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
				<span class="invalid-feedback"><?php echo $password_err; ?></span>
			</div>

			<label>
				<input type="checkbox" name="remember" checked> Remember me
			</label>

			<div class="form-group">
				<button type="submit" class="btn btn-success btn-lg btn-block signin-btn">Sign in</button>
			</div>
			<div class="text-center small"><a href="#">Forgot Your password?</a></div>
		</form>
		<div class="text-center small">Don't have an account? <a href="./singupPage.php">Sign up</a></div>
	</div>
	<footer>
		<?php
		include("footer.php");
		?>
	</footer>
</body>

</html>