<?php
// Cek apakah sesi sudah aktif sebelum memulai sesi
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}




?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
	<meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

	<title>VWX Marketplace</title>

	
	<link rel="icon" type="image/x-icon" href="<?= BASEURL; ?>/front-assets/images//favicon.ico" />
	
	
	<link rel="apple-touch-icon-precomposed" href="<?= BASEURL; ?>/front-assets/<?= BASEURL; ?>/front-assets/images//apple-touch-icon-114x114-precomposed.png">
	
	
	<link rel="apple-touch-icon-precomposed" href="<?= BASEURL; ?>/front-assets/<?= BASEURL; ?>/front-assets/images//apple-touch-icon-72x72-precomposed.png">
	
	
	<link rel="apple-touch-icon-precomposed" href="<?= BASEURL; ?>/front-assets/<?= BASEURL; ?>/front-assets/images//apple-touch-icon-57x57-precomposed.png">	
	
	
	<link href="https://fonts.googleapis.com/css?family=Arizonia|Crimson+Text:400,400i,600,600i,700,700i|Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/front-assets/revolution/css/settings.css">
 
	
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/front-assets/revolution/css/layers.css">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/front-assets/revolution/css/navigation.css">
	
	
    <link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/front-assets/libraries/lib.css">
	
	
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/front-assets/css/plugins.css">			
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/front-assets/css/navigation-menu.css">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/front-assets/css/shortcode.css">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/front-assets/style.css">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/sweetalert/sweetalert2.css">
	<script type="text/javascript" src="<?= BASEURL; ?>/sweetalert/sweetalert2.js"></script>
	<style>
		.swal2-popup .swal2-title {
			font-size: 3.875em;
        }
		.swal2-popup .swal2-content {
			font-size: 2.175em;
        }
		.swal2-popup .swal2-styled.swal2-confirm{
			font-size: 1.0625em;
		}

		.swal2-popup {
			border-radius: 1.3em;
			width: 45em;
		}

		.cart-count {
			position: absolute;
			top: -5px;
			right: 330px;
			background-color: red;
			color: white;
			font-size: 12px;
			line-height: 1;
			padding: 4px 6px;
			border-radius: 50%;
		}
		.btn-add-to-cart1 {
			border: none;
			background-color: #bd866f;
			text-decoration: none;
			color: #fff;
			display: inline-block;
			font-family: "Montserrat",sans-serif;
			font-size: 14px;
			letter-spacing: 0.56px;
			margin-top: 20px;
			padding: 10px;
			left: 15px;
			right: 0;
			margin: 0 auto;
			text-transform: uppercase;
			-webkit-transition: all 1s ease 0s;
			-moz-transition: all 1s ease 0s;
			-o-transition: all 1s ease 0s;
			transition: all 1s ease 0s;
			width: 180px;
			top: 74%;
		}
		.btn-add-to-cart1:hover {
			background-color: #333;
		}
	</style>
	
	
</head>

<body data-offset="200" data-spy="scroll" data-target=".ow-navigation">
	<div class="main-container">
		
		<header class="header-section header-section-1 container-fluid no-padding">
			
			<div class="middel-header">
				
				<div class="container">
					
					<div class="col-md-6 col-sm-6 col-xs-12 logo-block">
						<a href="index.html" class="navbar-brand">VWX<span>Marketplace</span></a>
					</div>

					<div class="col-md-6 col-sm-6 col-xs-6 menu-icon">
						<ul class="cart">
							 <li>
							 <a aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="cart" class="btn dropdown-toggle" title="Add To Cart" href="#">
                                    <i class="icon icon-ShoppingCart"></i>
                                    <?php
                                    $cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                                    ?>
                                    <?php if ($cartCount > 0): ?>
                                        <span class="cart-count"><?= $cartCount; ?></span>
                                    <?php endif; ?>
                                </a>
                                <?php if (isset($_SESSION['cart']) && $cartCount > 0): ?>
                                    <ul class="dropdown-menu no-padding" style="width: 400px;">
                                        <?php foreach ($_SESSION['cart'] as $cartItem) : ?>
                                            <li class="mini_cart_item">
												
												<a href="#" class="shop-thumbnail">
													<?php if (isset($cartItem['product_image'])) : ?>
														
														<img alt="poster_2_up" class="attachment-shop_thumbnail" src="<?= BASEURL; ?>/images/<?= $cartItem['product_image']; ?>" style="max-width:50px;">
														<?php if (isset($cartItem['product_name'])) : ?>
															<?= $cartItem['product_name']; ?>
														<?php endif; ?>
													<?php endif; ?>
												</a>
												<span class="quantity">
													<?php if (isset($cartItem['quantity'])) : ?>
														<?= $cartItem['quantity']; ?>
													<?php endif; ?>
													&#215; 
													<span class="amount">
														<?php if (isset($cartItem['price'])) : ?>
															$<?= number_format($cartItem['price'], 0); ?>
														<?php endif; ?>
													</span>
												</span>
											</li>
                                        <?php endforeach; ?>
                                        <li class="button">
                                            <a href="<?= BASEURL; ?>/Product/Cart" title="View Cart">View Cart</a>
                                        </li>
                                    </ul>
                                <?php else: ?>
                                    <ul class="dropdown-menu no-padding" style="width: 400px;">
                                        <li class="mini_cart_item">Cart is empty</li>
                                        <li class="button">
                                            <a href="<?= BASEURL; ?>/Product" title="View Products">Go to Products</a>
                                        </li>
                                    </ul>
                                <?php endif; ?>
							</li>
                            <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true): ?>
                                <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']): ?>
                                    <li><a href="#" title="Username"><i class="icon icon-User"></i> <?= $_SESSION['username'] ?></a></li>
                                    <li><a href="<?= BASEURL; ?>/Product/Create" title="Logout"><i class="icon icon-unlock"></i>Add Product</a></li>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['isSeller']) && $_SESSION['isSeller']): ?>
                                    <li><a href="#" title="Username"><i class="icon icon-User"></i> <?= $_SESSION['username'] ?></a></li>
                                    <li><a href="<?= BASEURL; ?>/Product/Create" title="Logout"><i class="icon icon-unlock"></i>Add Product</a></li>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['isUser']) && $_SESSION['isUser']): ?>
                                    <li><a href="#" title="Username"><i class="icon icon-User"></i> <?= $_SESSION['username'] ?></a></li>
									<li><a href="<?= BASEURL; ?>/Product/Create" title="Logout"><i class="icon icon-unlock"></i>Add Product</a></li>
                                <?php endif; ?>
                                    <li><a href="<?= BASEURL; ?>/auth/logout" title="Logout"><i class="icon icon-unlock"></i>Logout</a></li>    
                            <?php else: ?>
                                
                                <li><a href="<?= BASEURL; ?>/auth" title="Logout"><i class="icon icon-unlock"></i>Login</a></li>
                            <?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
			
			
			<div class="container-fluid no-padding menu-block">
				
				<div class="container">
					
					<nav class="navbar navbar-default ow-navigation">
						<div class="navbar-header">
							<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a href="index.html" class="navbar-brand">Max <span>shop</span></a>
						</div>
						<div class="navbar-collapse collapse" id="navbar">
							<ul class="nav navbar-nav">
								<li><a href="<?= BASEURL; ?>/" title="About Us">Home</a></li>
								<li><a href="<?= BASEURL; ?>/Product" title="About Us">All Product</a></li>
								<li><a href="<?= BASEURL; ?>/home/about" title="About Us">About Us</a></li>
								<?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true): ?>
									<?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']): ?>
										<li><a href="<?= BASEURL; ?>/Dashboard" title="About Us">Dashboard</a></li>
									<?php endif; ?>
								<?php endif; ?>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</header>
		
		<main>
			