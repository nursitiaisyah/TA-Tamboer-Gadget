<?php
include 'koneksi.php'; // Pastikan file koneksi.php ada di folder yang sama atau sesuaikan path-nya

// Ambil data dari form
$id = $_POST['id_penjualan'];
$tanggal = $_POST['tanggal'];
$jumlah_produksi = $_POST['jumlah_produksi'];
$terjual = $_POST['terjual'];
$harga_perbungkus = $_POST['harga_perbungkus'];
$sisa = $jumlah_produksi - $terjual;
$hasil_pendapatan = $terjual * $harga_perbungkus;

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk memperbarui data
$sql = "UPDATE penjualan SET tanggal = ?, jumlah_produksi = ?, terjual = ?, sisa = ?, harga_perbungkus = ?, hasil_pendapatan = ? WHERE id_penjualan = ?";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("siiiidi", $tanggal, $jumlah_produksi, $terjual, $sisa, $harga_perbungkus, $hasil_pendapatan, $id);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data berhasil diperbarui."); window.location.href="penjualan.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="penjualan.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>