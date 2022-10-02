<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Bootstrap Sign in Form with Circular Social Buttons</title>
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
		}

		.signin-form .small {
			font-size: 13px;
		}

		.btn-success {
			--bs-btn-color: #fff;
			--bs-btn-bg: #5c6ac4;
			--bs-btn-border-color: #5c6ac4;
			--bs-btn-hover-color: #fff;
			--bs-btn-hover-bg: #5c6ac4;
			--bs-btn-hover-border-color: #5c6ac4;
			--bs-btn-focus-shadow-rgb: 60, 153, 110;
			--bs-btn-active-color: #fff;
			--bs-btn-active-bg: #5c6ac4;
			--bs-btn-active-border-color: #5c6ac4;
			--bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
			--bs-btn-disabled-color: #fff;
			--bs-btn-disabled-bg: #5c6ac4;
			--bs-btn-disabled-border-color: #5c6ac4;
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
</head>

<body>
	<div class="signin-form">
		<form action="/examples/actions/confirmation.php" method="post">
			<h2>Sign in</h2>
			<p class="hint-text">Sign in with your social media account</p>
			<div class="social-btn text-center">
				<a href="#" class="btn btn-primary btn-lg" title="Facebook"><i class="fa fa-facebook"></i></a>
				<a href="#" class="btn btn-info btn-lg" title="Twitter"><i class="fa fa-twitter"></i></a>
				<a href="#" class="btn btn-danger btn-lg" title="Google"><i class="fa fa-google"></i></a>
			</div>
			<div class="or-seperator"><b>or</b></div>
			<div class="form-group">
				<input type="text" class="form-control input-lg" name="username" placeholder="Username" required="required">
			</div>
			<div class="form-group">
				<input type="password" class="form-control input-lg" name="password" placeholder="Password" required="required">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success btn-lg btn-block signin-btn">Sign in</button>
			</div>
			<div class="text-center small"><a href="#">Forgot Your password?</a></div>
		</form>
		<div class="text-center small">Don't have an account? <a href="#">Sign up</a></div>
	</div>
</body>

</html>