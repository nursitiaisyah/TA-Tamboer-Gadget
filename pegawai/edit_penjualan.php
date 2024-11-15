<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penjualan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-label {
            min-width: 110px;
        }

        .form-control-sm {
            max-width: 300px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main">
            <!-- Navbar -->
            <?php include 'navbar.php'; ?>

            <!-- Main Content Area -->
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="row"></div>
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-1">Edit Penjualan</h5>
                        </div>
                        <!-- Form Element -->
                        <div class="card border-0">
                            <div class="card-body">
                                <?php
                                // Include koneksi database
                                include 'koneksi.php';
                                // Ambil id_penjualan dari URL
                                $id_penjualan = $_GET['id'];

                                // Ambil data penjualan dari database
                                $query = "SELECT * FROM penjualan WHERE id_penjualan = '$id_penjualan'";
                                $result = mysqli_query($conn, $query);
                                $penjualan = mysqli_fetch_assoc($result);
                                ?>
                                <form action="proses_edit_penjualan.php" method="POST">
                                    <input type="hidden" name="id_penjualan"
                                        value="<?php echo $penjualan['id_penjualan']; ?>">

                                    <!-- Tanggal -->
                                    <div class="form-group">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control form-control-sm" id="tanggal"
                                            name="tanggal" value="<?php echo $penjualan['tanggal']; ?>" required
                                            style="max-width: 110px;">
                                    </div>

                                    <!-- Varian (Dropdown) -->
                                    <div class="form-group">
                                        <label for="id_varian" class="form-label">Varian</label>
                                        <select class="form-control form-control-sm" id="id_varian" name="id_varian"
                                            required>
                                            <option value="" disabled>Pilih Varian</option>
                                            <?php
                                            // Ambil data varian dari database
                                            $query = "SELECT v.id_varian, prod.nama_hp, v.ram, v.warna, v.penyimpanan, v.kondisi 
                                                      FROM varian v 
                                                      JOIN produk prod ON v.id_produk = prod.id_produk";
                                            $result = mysqli_query($conn, $query);

                                            // Cek jika ada data varian
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $selected = ($row['id_varian'] == $penjualan['id_varian']) ? 'selected' : '';
                                                    echo "<option value='" . $row['id_varian'] . "' $selected>" .
                                                        $row['nama_hp'] . " / " . $row['ram'] . " / " . $row['penyimpanan'] . " / " . $row['warna'] . " / " . ucfirst($row['kondisi']) .
                                                        "</option>";
                                                }
                                            } else {
                                                echo "<option value='' disabled>Tidak ada data varian</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Pengguna (Dropdown) -->
                                    <div class="form-group">
                                        <label for="id_user" class="form-label">Pengguna</label>
                                        <select class="form-control form-control-sm" id="id_user" name="id_user"
                                            required>
                                            <option value="" disabled>Pilih Pengguna</option>
                                            <?php
                                            // Ambil data pengguna dari database
                                            $query = "SELECT id_user, nama FROM users";
                                            $result = mysqli_query($conn, $query);

                                            // Cek jika ada data pengguna
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $selected = ($row['id_user'] == $penjualan['id_user']) ? 'selected' : '';
                                                    echo "<option value='" . $row['id_user'] . "' $selected>" . $row['nama'] . "</option>";
                                                }
                                            } else {
                                                echo "<option value='' disabled>Tidak ada data pengguna</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Harga Jual -->
                                    <div class="form-group">
                                        <label for="harga_jual" class="form-label">Harga Jual</label>
                                        <input type="number" class="form-control form-control-sm" id="harga_jual"
                                            name="harga_jual" value="<?php echo $penjualan['harga_jual']; ?>" required
                                            style="max-width: 140px;">
                                    </div>

                                    <!-- Jumlah -->
                                    <div class="form-group">
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <input type="number" class="form-control form-control-sm" id="jumlah"
                                            name="jumlah" value="<?php echo $penjualan['jumlah']; ?>" required
                                            style="max-width: 70px;">
                                    </div>

                                    <!-- Total Harga -->
                                    <div class="form-group">
                                        <label for="total_harga" class="form-label">Total Harga</label>
                                        <input type="number" class="form-control form-control-sm" id="total_harga"
                                            name="total_harga" value="<?php echo $penjualan['total_harga']; ?>" readonly
                                            style="max-width: 140px; background-color: #e9ecef; cursor: not-allowed;">
                                    </div>

                                    <!-- Metode Pembayaran -->
                                    <div class="form-group">
                                        <label for="metode_pembayaran" class="form-label">Pembayaran</label>
                                        <select class="form-control form-control-sm" id="metode_pembayaran"
                                            name="metode_pembayaran" required>
                                            <option value="tunai" <?php echo ($penjualan['metode_pembayaran'] == 'tunai') ? 'selected' : ''; ?>>Tunai</option>
                                            <option value="transfer" <?php echo ($penjualan['metode_pembayaran'] == 'transfer') ? 'selected' : ''; ?>>
                                                Transfer</option>
                                        </select>
                                    </div>

                                    <!-- Tombol Aksi -->
                                    <div class="d-flex justify-content-start">
                                        <button type="button" class="btn btn-secondary me-2"
                                            onclick="window.history.back()" style="font-size: 14px;">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </button>
                                        <button type="submit" class="btn btn-primary" style="font-size: 14px;">
                                            <i class="fas fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/script.js"></script>
    <script>
        $(document).ready(function () {
            // Function to update total_harga based on harga_jual and jumlah
            function updateTotalHarga() {
                var hargaJual = parseFloat($('#harga_jual').val());
                var jumlah = parseInt($('#jumlah').val());
                if (!isNaN(hargaJual) && !isNaN(jumlah)) {
                    var totalHarga = hargaJual * jumlah;
                    $('#total_harga').val(totalHarga);
                }
            }

            // Update total harga when harga_jual or jumlah is changed
            $('#harga_jual, #jumlah').on('input', updateTotalHarga);
        });
    </script>
</body>

</html>