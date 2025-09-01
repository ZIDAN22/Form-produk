<?php
include 'connect.php';

// Tangkap filter kategori (jika ada)
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

// Query untuk mengambil kategori unik
$categoryQuery = "SELECT DISTINCT category FROM products";
$categoryResult = $conn->query($categoryQuery);

// Query produk sesuai filter
if (!empty($categoryFilter)) {
    $stmt = $conn->prepare("SELECT id, name, price, image, category FROM products WHERE category = ?");
    $stmt->bind_param("s", $categoryFilter);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql    = "SELECT id, name, price, image, category FROM products";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Katalog Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Hello Gadget</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4">Katalog Produk</h1>

        <!-- Filter Kategori -->
        <form method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <select name="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php if ($categoryResult->num_rows > 0): ?>
                        <?php while($cat = $categoryResult->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($cat['category']); ?>"
                            <?php echo ($cat['category'] === $categoryFilter) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['category']); ?>
                        </option>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Produk -->
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-3 mb-4">
                <div class="card product-card shadow-sm">
                    <img src="<?php echo htmlspecialchars($row['image']); ?>"
                        alt="<?php echo htmlspecialchars($row['name']); ?>" class="card-img-top product-image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                        <p class="card-text text-muted"><?php echo htmlspecialchars($row['category']); ?></p>
                        <p class="card-text fw-bold">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                        <a href="#" class="btn btn-sm btn-success">Beli Sekarang</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <p class="text-muted">Tidak ada produk ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>