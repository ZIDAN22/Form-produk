<?php
session_start();
include 'connect.php';

// Ambil product_id dari URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id > 0) {  
    $session_id = session_id();
    
    // Cek apakah produk sudah ada di keranjang
    $check_sql = "SELECT id, quantity FROM cart WHERE session_id = ? AND product_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("si", $session_id, $product_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        // Update quantity jika sudah ada
        $row = $check_result->fetch_assoc();
        $new_quantity = $row['quantity'] + 1;
        $update_sql = "UPDATE cart SET quantity = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $new_quantity, $row['id']);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        // Insert baru jika belum ada
        $insert_sql = "INSERT INTO cart (session_id, product_id, quantity) VALUES (?, ?, 1)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("si", $session_id, $product_id);
        $insert_stmt->execute();
        $insert_stmt->close();
    }
    
    $check_stmt->close();

    // **Set flash message sebelum redirect**
    $_SESSION['flash_message'] = "Produk berhasil ditambahkan ke keranjang!";
}

// Redirect ke halaman katalog
header("Location: index.php");
exit();
?>
