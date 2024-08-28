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
        .form-label {
            min-width: 150px;
            /* Sesuaikan dengan lebar yang diinginkan */
        }

        .form-control-sm {
            max-width: 100px;
            /* Sesuaikan dengan lebar yang diinginkan */
        }

        .form-control-date {
            max-width: 119px;
            /* Sesuaikan dengan lebar yang diinginkan */
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
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                        </div>
                    </div>

                    <!-- Form Edit Penjualan -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Penjualan</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            include 'koneksi.php';

                            // Ambil ID dari URL
                            $id = $_GET['id'];

                            // Cek koneksi
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Ambil data untuk ditampilkan di form
                            $sql = "SELECT * FROM penjualan WHERE id_penjualan = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                            } else {
                                die("Data tidak ditemukan.");
                            }

                            $stmt->close();
                            $conn->close();
                            ?>

                            <form action="proses_edit_penjualan.php" method="POST">
                                <input type="hidden" name="id_penjualan" value="<?php echo $row['id_penjualan']; ?>">
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control form-control-sm form-control-date"
                                            id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="jumlah_produksi" class="form-label">Jumlah Produksi</label>
                                        <input type="number" class="form-control form-control-sm" id="jumlah_produksi"
                                            name="jumlah_produksi" value="<?php echo $row['jumlah_produksi']; ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="terjual" class="form-label">Terjual</label>
                                        <input type="number" class="form-control form-control-sm" id="terjual"
                                            name="terjual" value="<?php echo $row['terjual']; ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="harga_perbungkus" class="form-label">Harga Per Bungkus</label>
                                        <input type="number" class="form-control form-control-sm" id="harga_perbungkus"
                                            name="harga_perbungkus" value="<?php echo $row['harga_perbungkus']; ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="sisa" class="form-label">Sisa</label>
                                        <input type="number" class="form-control form-control-sm" id="sisa" name="sisa"
                                            readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="hasil" class="form-label">Hasil</label>
                                        <input type="number" class="form-control form-control-sm" id="hasil"
                                            name="hasil" readonly>
                                    </div>
                                </div>
                                <a href="penjualan.php" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom Scripts -->
    <script src="../js/script.js"></script>
    <script>
        document.getElementById('jumlah_produksi').addEventListener('input', updateValues);
        document.getElementById('terjual').addEventListener('input', updateValues);
        document.getElementById('harga_perbungkus').addEventListener('input', updateValues);

        function updateValues() {
            const produksi = parseInt(document.getElementById('jumlah_produksi').value) || 0;
            const terjual = parseInt(document.getElementById('terjual').value) || 0;
            const harga = parseInt(document.getElementById('harga_perbungkus').value) || 0;

            const sisa = produksi - terjual;
            const hasil = terjual * harga;

            document.getElementById('sisa').value = sisa;
            document.getElementById('hasil').value = hasil;
        }

        // Initialize the values on page load
        window.onload = updateValues;
    </script>
</body>

</html>