<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    if ($user['role'] == 'pemilik') {
        header("Location: admin/halaman_admin.php");
    } elseif ($user['role'] == 'pegawai') {
        header("Location: pegawai/halaman_pegawai.php");
    }
} else {
    echo "Login failed. Invalid username or password.";
}

$conn->close();
?>