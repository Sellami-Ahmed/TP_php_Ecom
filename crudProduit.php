<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.101.0">
  <title>Starter Template · Bootstrap v5.2</title>

  <link rel="canonical" href="inc/css/starter-template">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="inc/css/bootstrap.min.css" rel="stylesheet">
  <link href="starter-template.css" rel="stylesheet">

  <?php
  include("inc/userHeader.php");
  ?>
</head>

<body>
<style>
	body {
		background: #eeeeee;
		background: -webkit-linear-gradient(to left, #eeeeee, #5c6ac4);
		background: linear-gradient(to left, #eeeeee, #5c6ac4);
		min-height: 100vh;
	}
	input[type=number] {
		max-width: 100px;
	}
  </style>
<div class="px-4 px-lg-0">
	<div class="container text-white py-5 text-center">
		<h1 class="display-4">Shopping Cart</h1>
	</div>
	<div class="pb-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th scope="col" class="border-0 bg-light">
										<div class="p-2 px-3 text-uppercase">Product</div>
									</th>
									<th scope="col" class="border-0 bg-light">
										<div class="py-2 text-uppercase">Price</div>
									</th>
									<th scope="col" class="border-0 bg-light">
										<div class="py-2 text-uppercase">Quantity</div>
									</th>
									<th scope="col" class="border-0 bg-light">
										<div class="py-2 text-uppercase">Remove</div>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$products = array(
									1 => array(
										"name" => "Timex Unisex Originals",
										"category" => "Watches",
										"id" => "50545",
										"price" => 79.00,
										"quantity" => 10,
										"image" => 1
									),
									2 => array(
										"name" => "Lumix camera lense",
										"category" => "Electronics",
										"id" => "50546",
										"price" => 79,
										"quantity" => 9,
										"image" => 3
									),
									3 => array(
										"name" => "Gray Nike running shoe",
										"category" => " Fashion",
										"id" => "50547",
										"price" => 79,
										"quantity" => 8,
										"image" => 2
									)
								);
								foreach ($products as $product => $value) {
								?>
									<tr>
										<th scope="row">
											<div class="p-2">
												<img src="inc/images/product-<?php echo $products[$product]["image"]; ?>.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
												<div class="ml-3 d-inline-block align-middle">
													<h5 class="mb-0"><a href="#" class="text-dark d-inline-block"><?php echo $products[$product]["name"]; ?></a></h5><span class="text-muted font-weight-normal font-italic">Category: <?php echo $products[$product]["category"]; ?></br>ID:<?php echo $products[$product]["id"]; ?></span>
												</div>
											</div>
										</th>
										<td class="align-middle"><strong>$<?php echo $products[$product]["price"]; ?></strong></td>
										
										<td class="align-middle"><input type="number" class="form-control text-center" value=<?php echo $products[$product]["quantity"]; ?>><strong></strong></td>
										<td class="align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php
								}
								?>


							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row py-5 p-4 bg-white rounded shadow-sm">
				<div class="col-lg-6">
					<div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
					<div class="p-4">
						<p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
						<div class="input-group mb-4 border rounded-pill p-2">
							<input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
							<div class="input-group-append border-0">
								<button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Apply coupon</button>
							</div>
						</div>
					</div>
					<div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for seller</div>
					<div class="p-4">
						<p class="font-italic mb-4">If you have some information for the seller you can leave them in the box below</p>
						<textarea name="" cols="30" rows="2" class="form-control"></textarea>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
					<div class="p-4">
						<p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
						<ul class="list-unstyled mb-4">
							<li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong>$390.00</strong></li>
							<li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li>
							<li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong>$0.00</strong></li>
							<li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
								<h5 class="font-weight-bold">$400.00</h5>
							</li>
						</ul><a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
</body>
<footer>
  <?php
  include("inc/footer.php");
  ?>

  </footer>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

</html>