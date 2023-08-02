<!-- Page Banner -->
            <div class="page-banner container-fluid no-padding">
				<!-- Container -->
				<div class="container">
					<div class="banner-content">
						<h3>Cart</h3>
						<p>our vision is to be Earth's most customer centric company</p>
					</div>
					<ol class="breadcrumb">
						<li><a href="index.html" title="Home">Home</a></li>							
						<li class="active">Cart</li>
					</ol>
				</div><!-- Container /- -->
			</div><!-- Page Banner /- -->
			<!-- Cart -->
    <div class="woocommerce-cart container-fluid no-left-padding no-right-padding">
    <!-- Container -->
    <div class="container">
        <!-- Cart Table -->
        <div class="col-md-12 col-sm-12 col-xs-12 cart-table">
            <form>
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th class="product-thumbnail">Item</th>
                            <th class="product-name">Product Name</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-unit-price">Unit Price</th>
                            <th class="product-subtotal">Total</th>
                            <th class="product-checkout">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Iterate through cart items and display them -->
                        <?php foreach ($_SESSION['cart'] as $cartItem) : ?>
                            <tr class="cart_item">
                                <td data-title="Item" class="product-thumbnail">
                                    <?php if (isset($cartItem['product_image'])) : ?>
                                        <a href="#"><img src="<?= BASEURL; ?>/images/<?= $cartItem['product_image']; ?>" alt="Product" /></a>
                                    <?php endif; ?>
                                </td>
                                <td data-title="Product Name" class="product-name">
                                    <?php if (isset($cartItem['product_name'])) : ?>
                                        <a href="#" style="font-family: 'Montserrat', sans-serif; font-size: 26px;">
                                            <?= $cartItem['product_name']; ?>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td data-title="Quantity" class="product-quantity">
                                    <?php if (isset($cartItem['quantity'])) : ?>
                                        <?= $cartItem['quantity']; ?>
                                    <?php endif; ?>
                                </td>
                                <td data-title="Unit Price" class="product-unit-price">
                                    <?php if (isset($cartItem['price'])) : ?>
                                        $<?= number_format($cartItem['price'], 0); ?>
                                    <?php endif; ?>
                                </td>
                                <td data-title="Total" class="product-subtotal">
                                    <?php if (isset($cartItem['price'], $cartItem['quantity'])) : ?>
                                        $<?= $cartItem['price'] * $cartItem['quantity']; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= BASEURL; ?>/Product/Checkout/<?= $cartItem['product_id'] ?>" class="btn-add-to-cart1">Checkout</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- End of cart items loop -->
                    </tbody>
                </table>
            </form>
        </div><!-- Cart Table /- -->

    </div><!-- Container /- -->
</div><!-- Cart /- -->