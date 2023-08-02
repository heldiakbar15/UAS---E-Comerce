</main>
		
		<!-- Footer Main 1 -->
		<footer id="footer-main" class="footer-main footer-main-1 services-section container-fluid">
			<!-- Container -->
			<div class="container">
				<div class="services-item">
					<div class="col-md-4 col-sm-6 col-xs-6">
						<div class="srv-box">
							<i class="icon icon-Truck"></i><h5>Free delivery</h5><i class="icon icon-Dollar"></i>
							<span class="icon_close"></span>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-6">
						<div class="srv-box">
							<i class="icon icon-Goto"></i><h5>Money Back</h5><i class="icon icon-Dollars"></i>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-6">
						<div class="srv-box">
							<i class="icon icon-Headset"></i><h5>24/7 support</h5><i class="icon icon-Timer"></i>
						</div>
					</div>
				</div>
				<div class="copyright-section">
					<div class="coyright-content">
						<p>&copy; VWX Marketplace</p>
					</div>	
					<ul>
						<li><a href="#" title="Delivery Information">Delivery Information</a></li>
						<li><a href="#" title="Privacy Policy">Privacy Policy</a></li>
						<li><a href="#" title="Terms & Condition">Terms & Condition</a></li>
					</ul>
				</div>
			</div><!-- Container /- -->
		</footer><!-- Footer Main 1 -->

	</div>
	
	<!-- JQuery v1.12.4 -->
	<script src="<?= BASEURL; ?>/front-assets/js/jquery.min.js"></script>

	<!-- Library - Js -->
	<script src="<?= BASEURL; ?>/front-assets/libraries/lib.js"></script>
	
	<script src="<?= BASEURL; ?>/front-assets/libraries/jquery.countdown.min.js"></script>
	
	<!-- RS5.0 Core JS Files -->
	<script type="text/javascript" src="<?= BASEURL; ?>/front-assets/revolution/js/jquery.themepunch.tools.min.js?rev=5.0"></script>
	<script type="text/javascript" src="<?= BASEURL; ?>/front-assets/revolution/js/jquery.themepunch.revolution.min.js?rev=5.0"></script>
	<script type="text/javascript" src="<?= BASEURL; ?>/front-assets/revolution/js/extensions/revolution.extension.video.min.js"></script>
	<script type="text/javascript" src="<?= BASEURL; ?>/front-assets/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
	<script type="text/javascript" src="<?= BASEURL; ?>/front-assets/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
	<script type="text/javascript" src="<?= BASEURL; ?>/front-assets/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
	<script type="text/javascript" src="<?= BASEURL; ?>/front-assets/revolution/js/extensions/revolution.extension.actions.min.js"></script>
	
	<!-- Library - Theme JS -->
	<script src="<?= BASEURL; ?>/front-assets/js/functions.js"></script>

	<script>
    // Function to update sub total and total order using AJAX
		function updateTotal() {
			const productPrice = parseFloat(document.getElementById('productPrice').value);
			const quantity = parseInt(document.getElementById('quantityInput').value);
			const shippingCost = 0; // Set your shipping cost here

			// Make an AJAX request to the PHP script to calculate the total
			const xhr = new XMLHttpRequest();
			xhr.open('POST', '<?= BASEURL; ?>/calculate_total.php', true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.onreadystatechange = function () {
				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					const response = JSON.parse(xhr.responseText);
					document.getElementById('subtotalValue').innerText = '$' + response.subTotal.toFixed(2);
					document.getElementById('totalOrderValue').innerText = '$' + response.totalOrder.toFixed(2);
				}
			};
			xhr.send(`price=${productPrice}&quantity=${quantity}&shipping_cost=${shippingCost}`);
		}

		// Event listeners for quantity input
		document.getElementById('quantityInput').addEventListener('change', updateTotal);
		document.getElementById('quantityInput').addEventListener('input', updateTotal);

		// Event listener for "+" and "-" buttons
		document.querySelectorAll('.qtyminus, .qtyplus').forEach(button => {
			button.addEventListener('click', () => {
				const quantityInput = document.getElementById('quantityInput');
				let currentValue = parseInt(quantityInput.value);
				if (button.classList.contains('qtyminus')) {
					quantityInput.value = currentValue > 0 ? currentValue - 1 : 0;
				} else if (button.classList.contains('qtyplus')) {
					quantityInput.value = currentValue + 1;
				}
				updateTotal();
			});
		});
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function () {
			// Get the "Total Order" cell element
			var totalOrderCell = document.getElementById("totalOrderValue");

			// Get the total_price value from the cell (remove the "$" and convert to a number)
			var total_price = parseFloat(totalOrderCell.textContent.replace("$", ""));

			// Update the hidden input field
			document.getElementById("totalPriceInput").value = total_price.toFixed(2); // Convert to 2 decimal places
		});
	</script>
	<!-- Add this script inside the <head> or at the end of the <body> tag -->
	<script>
		function showPreviewImage(event) {
			var output = document.getElementById('previewImage');
			output.src = URL.createObjectURL(event.target.files[0]);
		}

		// Attach the event listener to the file input element
		var fileInput = document.getElementById('images');
		fileInput.addEventListener('change', showPreviewImage);
	</script>
	<script>
        // Function to display the SweetAlert based on the flash message
        function showFlashMessage(messageData) {
            if (messageData) {
                Swal.fire({
                    title: "Congrats!",
                    text: messageData.pesan + ' ' + messageData.aksi,
                    icon: messageData.tipe,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK",
                });
            }
        }

        // Get the flash message data from PHP
        var flashData = <?php echo Flasher::flash(); ?>;

        // Show the SweetAlert based on the flash message data
        showFlashMessage(flashData);
    </script>
	<!-- ... Your previous HTML code ... -->

	<script>
		const quantityInput = document.getElementById('quantity');
		const qtyMinusButton = document.querySelector('.qtyminus');
		const qtyPlusButton = document.querySelector('.qtyplus');

		// Function to increase quantity
		function increaseQuantity() {
			let currentQty = parseInt(quantityInput.value);
			if (!isNaN(currentQty)) {
				quantityInput.value = currentQty ++;
			}
		}

		// Function to decrease quantity
		function decreaseQuantity() {
			let currentQty = parseInt(quantityInput.value);
			if (!isNaN(currentQty) && currentQty > 1) {
				quantityInput.value = currentQty --;
			}
		}

		// Event listeners for the buttons
		qtyMinusButton.addEventListener('click', decreaseQuantity);
		qtyPlusButton.addEventListener('click', increaseQuantity);
	</script>

	<!-- ... Your remaining HTML code ... -->



	
</body>
</html>
	
