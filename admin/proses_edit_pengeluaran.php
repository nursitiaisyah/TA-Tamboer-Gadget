<?php
include 'koneksi.php'; // Pastikan file koneksi.php ada di folder yang sama atau sesuaikan path-nya

// Ambil data dari form
$id = $_POST['id_pengeluaran'];
$tanggal = $_POST['tanggal'];
$uraian = $_POST['uraian'];
$jumlah = $_POST['jumlah'];
$satuan = $_POST['satuan'];
$harga_satuan = $_POST['harga_satuan'];
$total_harga = $jumlah * $harga_satuan; // Hitung total_harga di sini

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk memperbarui data
$sql = "UPDATE pengeluaran SET tanggal = ?, uraian = ?, jumlah = ?, satuan = ?, harga_satuan = ?, total_harga = ? WHERE id_pengeluaran = ?";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("ssidsdi", $tanggal, $uraian, $jumlah, $satuan, $harga_satuan, $total_harga, $id);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data berhasil diperbarui."); window.location.href="pengeluaran.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="pengeluaran.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>