# Katalog Produk PHP

Proyek sederhana untuk menampilkan katalog produk menggunakan PHP dan MySQL. Aplikasi ini memungkinkan pengguna untuk melihat daftar produk, memfilter berdasarkan kategori, dan menampilkan informasi produk seperti nama, harga, gambar, dan kategori.

## Fitur

- **Tampilan Katalog Produk**: Menampilkan produk dalam grid responsif menggunakan Bootstrap.
- **Filter Kategori**: Pengguna dapat memfilter produk berdasarkan kategori yang tersedia.
- **Koneksi Database**: Menggunakan MySQL untuk menyimpan dan mengambil data produk.
- **Styling Responsif**: Menggunakan Bootstrap untuk layout responsif dan CSS kustom untuk efek hover pada kartu produk.

## Teknologi yang Digunakan

- **PHP**: Bahasa pemrograman utama untuk logika backend.
- **MySQL**: Database untuk menyimpan data produk.
- **Bootstrap 5**: Framework CSS untuk styling dan layout responsif.
- **HTML**: Struktur halaman web.
- **CSS**: Styling tambahan untuk efek visual.

## Prasyarat

Sebelum menjalankan proyek ini, pastikan Anda memiliki:

- **PHP** versi 7.4 atau lebih tinggi.
- **MySQL** atau server database yang kompatibel.
- **Web Server** seperti Apache (disarankan menggunakan XAMPP untuk kemudahan).
- **Browser** untuk mengakses aplikasi.

## Instalasi

1. **Clone atau Download Proyek**:
   - Salin file-file proyek ke direktori root web server Anda (misalnya, `htdocs` jika menggunakan XAMPP).

2. **Setup Database**:
   - Buat database baru di MySQL dengan nama `store_db`.
   - Buat tabel `products` dengan struktur berikut:
     ```sql
     CREATE TABLE products (
         id INT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(255) NOT NULL,
         price DECIMAL(10, 2) NOT NULL,
         image VARCHAR(255),
         category VARCHAR(100)
     );
     ```
   - Masukkan data contoh ke tabel `products`:
     ```sql
     INSERT INTO products (name, price, image, category) VALUES
     ('Produk 1', 100000, 'path/to/image1.jpg', 'Kategori A'),
     ('Produk 2', 150000, 'path/to/image2.jpg', 'Kategori B');
     ```

3. **Konfigurasi Koneksi Database**:
   - Buka file `connect.php`.
   - Pastikan variabel `$host`, `$username`, `$password`, dan `$dbname` sesuai dengan konfigurasi MySQL Anda.
     - Default: host = "localhost", username = "root", password = "", dbname = "store_db".

4. **Jalankan Server**:
   - Jika menggunakan XAMPP, start Apache dan MySQL.
   - Akses aplikasi melalui browser di `http://localhost/index.php`.

## Struktur File

```
/
├── connect.php      # Koneksi ke database MySQL
├── index.php        # Halaman utama katalog produk
├── style.css        # Styling CSS kustom
└── README.md        # Dokumentasi proyek (file ini)
```

## Penggunaan

1. Buka `index.php` di browser.
2. Lihat daftar produk yang ditampilkan.
3. Gunakan dropdown filter untuk memilih kategori dan klik "Filter" untuk menyaring produk.
4. Klik tombol "Beli Sekarang" pada kartu produk (fungsi ini belum diimplementasikan, hanya placeholder).

## Catatan

- Pastikan path gambar produk di kolom `image` tabel `products` valid dan dapat diakses.
- Jika terjadi error koneksi database, periksa konfigurasi di `connect.php` dan pastikan MySQL server berjalan.
- Aplikasi ini menggunakan prepared statements untuk mencegah SQL injection pada filter kategori.

## Kontribusi

Jika Anda ingin berkontribusi, silakan fork repositori ini dan buat pull request dengan perubahan yang diusulkan.

## Lisensi

Proyek ini dibuat untuk tujuan edukasi dan tidak memiliki lisensi khusus.
