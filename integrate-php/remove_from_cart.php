<?php
session_start();
include 'connect.php';

if (isset($_GET['id'])) {
    $cart_id = intval($_GET['id']);
    $session_id = session_id();

    // Delete from cart, but only if session_id matches for security
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND session_id = ?");
    $stmt->bind_param("is", $cart_id, $session_id);
    $stmt->execute();

    // Redirect back to cart
    header('Location: cart.php');
    exit();
} else {
    header('Location: cart.php');
    exit();
}

$conn->close();
?>
