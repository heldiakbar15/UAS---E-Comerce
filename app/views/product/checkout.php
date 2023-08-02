<!-- Page Banner -->
<div class="page-banner container-fluid no-padding">
				<!-- Container -->
				<div class="container">
					<div class="banner-content">
						<h3>Checkout</h3>
						<p>our vision is to be Earth's most customer centric company</p>
					</div>
					<ol class="breadcrumb">
						<li><a href="index.html" title="Home">Home</a></li>							
						<li class="active">Checkout</li>
					</ol>
				</div><!-- Container /- -->
			</div><!-- Page Banner /- -->
			<!-- Checkout -->
			<div class="container-fluid no-left-padding no-right-padding woocommerce-checkout">
				<!-- Container -->
				<div class="container">
					<!-- Billing -->
					<div class="checkout-form">
                        <form action="<?= BASEURL; ?>/Product/createTransactionWithPayment" method="post">
                            <!-- Billing Address -->
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <h3>Billing Address</h3>
                                <div class="billing-field">
                                    <div class="col-md-12 form-group">
                                        <label>Name</label>
                                        <input class="form-control" type="text" placeholder="<?= $_SESSION['username'] ?>" readonly>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Address  *</label>
                                        <input class="form-control" type="text" placeholder="<?= $_SESSION['address'] ?>" readonly>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Phone Number*</label>
                                        <input class="form-control" type="text" placeholder="<?= $_SESSION['phone_number'] ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Your Order -->
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <h3>Your Order</h3>
                                <div class="shipping-fields">
                                    <div class="checkout-order-table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Total</th>
                                                    <th>pcs</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="cart_item">
                                                    <td class="product-name"><?= $data['product']['product_name']; ?></td>
                                                    <td>$<?= $data['product']['price']; ?></td>
                                                    <td>
                                                        <input type="hidden" id="productPrice" value="<?= $data['product']['price']; ?>">
                                                        <div data-title="Quantity">
                                                            <input type="hidden" name="buyer_id" value="<?= $_SESSION['id']; ?>">
                                                            <input type="hidden" name="seller_id" value="<?= $data['product']['seller_id']; ?>">
                                                            <input type="hidden" name="product_id" value="<?= $data['product']['id']; ?>">
                                                            <input type="hidden" name="total_price" id="totalPriceInput" value="0">
                                                            <input type="hidden" name="payment_status" id="payment_status" value="success">
                                                            <input type="hidden" name="transaction_date" id="transactionDateInput" value="<?= date('Y-m-d H:i:s'); ?>">
                                                            <input type="button" value="-" class="qtyminus btn" data-field="quantity1">
                                                            <input type="text" name="product_quantity" value="1" class="qty btn" style="width:50px;" id="quantityInput">
                                                            <input type="button" value="+" class="qtyplus btn" data-field="quantity1">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <th>Sub Total</th>
                                                    <td id="subtotalValue">$0.00</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Shipping</th>
                                                    <td>Free Shipping</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Order</th>
                                                    <td id="totalOrderValue">$0.00</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="checkout-payment">
                                        <ul>
                                            <li>
                                                <input value="Paypal" type="radio" name="payment_method" value="paypal">
                                                <label><img src="<?= BASEURL; ?>/front-assets/images/paypal.jpg" alt="Paypal">Paypal </label>
                                            </li>
                                            <!-- Add more payment method options here if needed -->
                                            <li>
                                                <input value="bca" type="radio" name="payment_method" value="bca">
                                                <label> <img src="<?= BASEURL; ?>/front-assets/images/bca.png" alt="Paypal" style="max-width: 60px;"> BCA Virtual Account</label>
                                            </li>
                                            <li>
                                                <input value="mandiri" type="radio" name="payment_method" value="mandiri">
                                                <label> <img src="<?= BASEURL; ?>/front-assets/images/mandiri.png" alt="Paypal" style="max-width: 60px;"> Mandiri Virtual Account</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="place-order">
                                        <input value="PLACE YOUR ORDER" type="submit" name="place_order">
                                    </div>
                                </div>
                            </div>
                        </form>

					</div><!-- Billing /- -->
				</div><!-- Container /- -->
			</div><!-- Checkout /- -->