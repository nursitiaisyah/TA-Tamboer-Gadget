<?php
include 'koneksi.php'; // Pastikan file koneksi.php ada di folder yang sama atau sesuaikan path-nya

// Ambil data dari form
$id = $_POST['id_pemasukan'];
$tanggal = $_POST['tanggal'];
$ket_pemasukan = $_POST['ket_pemasukan'];
$sumber = $_POST['sumber'];
$jumlah = $_POST['jumlah'];

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk memperbarui data
$sql = "UPDATE pemasukan SET tanggal = ?, ket_pemasukan = ?, sumber = ?, jumlah = ? WHERE id_pemasukan = ?";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("sssii", $tanggal, $ket_pemasukan, $sumber, $jumlah, $id);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data berhasil diperbarui."); window.location.href="pemasukan.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="pemasukan.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>