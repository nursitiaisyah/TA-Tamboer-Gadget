<?php
include 'koneksi.php'; // Pastikan file koneksi.php ada di folder yang sama atau sesuaikan path-nya

// Ambil data dari form
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
$role = $_POST['role'];

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk menyimpan data akun
$sql = "INSERT INTO users (nama, username, password, role) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("ssss", $nama, $username, $password, $role);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data akun berhasil disimpan."); window.location.href="akun.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="tambah_akun.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>