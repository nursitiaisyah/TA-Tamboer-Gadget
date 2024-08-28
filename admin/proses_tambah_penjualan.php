<?php
include 'koneksi.php'; // Pastikan file koneksi.php ada di folder yang sama atau sesuaikan path-nya

// Ambil data dari form
$tanggal = $_POST['tanggal'];
$jumlah_produksi = $_POST['jumlah_produksi'];
$terjual = $_POST['terjual'];
$sisa = $_POST['sisa'];
$harga = $_POST['harga'];
$hasil = $_POST['hasil'];

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk menyimpan data
$sql = "INSERT INTO penjualan (tanggal, jumlah_produksi, terjual, sisa, harga_perbungkus, hasil_pendapatan) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("siiiii", $tanggal, $jumlah_produksi, $terjual, $sisa, $harga, $hasil);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data berhasil disimpan."); window.location.href="penjualan.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="index.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>