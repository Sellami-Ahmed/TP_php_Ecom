<?php
session_start();
// Include config file
require_once "DBconnect.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = $username;
            $param_password =$password; // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
				$_SESSION['alert']='<div class="alert alert-success text-center"" role="alert">
Successeful Sign Up
</div>';
                header("location: loginPage.php");
				
            } else{
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
	<title>SignUp page</title>
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
	include("inc/loginHeader.php");
	?>
</head>

<body>
	<div class="signin-form">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<h2>Sign Up</h2>
			<p class="hint-text">Sign Up with your social media account</p>
			<div class="social-btn text-center">
				<a href="#" class="btn btn-primary btn-lg" title="Facebook"><i class="fa fa-facebook"></i></a>
				<a href="#" class="btn btn-info btn-lg" title="Twitter"><i class="fa fa-twitter"></i></a>
				<a href="#" class="btn btn-danger btn-lg" title="Google"><i class="fa fa-google"></i></a>
			</div>
			<div class="or-seperator"><b>or</b></div>

			<div class="form-group">
				<input type="text"  name="username" placeholder="Username" required="required"
				class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
			</div>
			<div class="form-group">
				<input type="password"
				name="password"
				placeholder="Password" required="required"
				 class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
			</div>
			<div class="form-group">
				<input type="password"
				  name="confirm_password" placeholder="Confirm Password" required="required"
				  class="form-control  <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
			</div>
			

			
			<div class="form-group">
				<button type="submit" class="btn btn-success btn-lg btn-block signin-btn">submit</button>
			</div>

		</form>
		<div class="text-center small">Already have an account? <a href="loginPage.php">Login here</a></div>
	</div>
	<footer>
		<?php
		include("inc/footer.php");
		?>
	</footer>
</body>

</html>