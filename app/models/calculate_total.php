<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $shippingCost = floatval($_POST['shipping_cost']);

    $subTotal = $price * $quantity;
    $totalOrder = $subTotal + $shippingCost;

    echo json_encode(array('subTotal' => $subTotal, 'totalOrder' => $totalOrder));
}
?>
