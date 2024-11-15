<?php
include 'koneksi.php';  // Pastikan koneksi database sudah ada

// Mengambil data dari form
$tanggal = $_POST['tanggal'];
$id_varian = $_POST['id_varian'];
$jumlah = $_POST['jumlah'];
$metode_pembayaran = $_POST['metode_pembayaran'];
$id_user = $_POST['id_user'];
$harga_jual = floatval(str_replace(['Rp.', ','], '', $_POST['harga_jual'])); // Menghilangkan Rp dan format angka
$total_harga = floatval(str_replace(['Rp.', ','], '', $_POST['total_harga']));

// 1. Mengambil data stok dari tabel varian
$query_stok = "SELECT stok FROM varian WHERE id_varian = ?";
$stmt_stok = $conn->prepare($query_stok);
$stmt_stok->bind_param('i', $id_varian);
$stmt_stok->execute();
$result_stok = $stmt_stok->get_result();
$row_stok = $result_stok->fetch_assoc();

// 2. Periksa apakah stok cukup
if ($row_stok['stok'] >= $jumlah) {
    // 3. Insert data penjualan ke tabel penjualan
    $sql_penjualan = "INSERT INTO penjualan (tanggal, id_varian, harga_jual, jumlah, total_harga, metode_pembayaran, id_user) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_penjualan = $conn->prepare($sql_penjualan);
    $stmt_penjualan->bind_param('siidiss', $tanggal, $id_varian, $harga_jual, $jumlah, $total_harga, $metode_pembayaran, $id_user);

    if ($stmt_penjualan->execute()) {
        // 4. Update stok di tabel varian setelah penjualan
        $new_stok = $row_stok['stok'] - $jumlah;  // Kurangi stok berdasarkan jumlah penjualan
        $sql_update_stok = "UPDATE varian SET stok = ? WHERE id_varian = ?";
        $stmt_update_stok = $conn->prepare($sql_update_stok);
        $stmt_update_stok->bind_param('ii', $new_stok, $id_varian);
        $stmt_update_stok->execute();

        // Pop-up pesan sukses dan redirect
        echo '<script>alert("Data penjualan berhasil ditambahkan."); window.location.href="penjualan.php";</script>';
    } else {
        // Pop-up pesan gagal insert penjualan dan redirect
        echo '<script>alert("Gagal menambahkan data penjualan."); window.location.href="tambah_penjualan.php";</script>';
    }
} else {
    // Pop-up pesan stok tidak mencukupi dan redirect
    echo '<script>alert("Stok tidak mencukupi untuk penjualan ini."); window.location.href="tambah_penjualan.php";</script>';
}

// Tutup koneksi
$conn->close();
?>