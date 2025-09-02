<?php
session_start();
include 'connect.php';

// Ambil session_id
$session_id = session_id();

// Query untuk mengambil item keranjang
$sql = "SELECT c.id as cart_id, c.quantity, p.name, p.price, p.image
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.session_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $session_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">Hello Gadget</a>
            <a href="cart.php" class="btn btn-outline-light">Keranjang</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4">Keranjang Belanja</h1>

        <?php if ($result->num_rows > 0): ?>
        <div class="row">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-2">
                            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                                <p class="card-text">Jumlah: <?php echo $row['quantity']; ?></p>
                                <p class="card-text fw-bold">Harga: Rp <?php echo number_format($row['price'] * $row['quantity'], 0, ',', '.'); ?></p>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <a href="remove_from_cart.php?id=<?php echo $row['cart_id']; ?>" class="btn btn-danger">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="text-end">
            <a href="#" class="btn btn-success">Checkout</a>
        </div>
        <?php else: ?>
        <p class="text-muted">Keranjang Anda kosong.</p>
        <?php endif; ?>
    </div>

</body>
</html>
<?php
$conn->close();
?>