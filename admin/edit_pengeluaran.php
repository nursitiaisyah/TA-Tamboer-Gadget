<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengeluaran</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .form-label {
            min-width: 150px;
        }

        .form-control-sm {
            max-width: 100px;
        }

        .form-control-date {
            max-width: 119px;
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

                    <!-- Form Edit Pengeluaran -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Pengeluaran</h5>
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
                            $sql = "SELECT * FROM pengeluaran WHERE id_pengeluaran = ?";
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

                            <form action="proses_edit_pengeluaran.php" method="POST">
                                <input type="hidden" name="id_pengeluaran"
                                    value="<?php echo htmlspecialchars($row['id_pengeluaran']); ?>">
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control form-control-sm form-control-date"
                                            id="tanggal" name="tanggal"
                                            value="<?php echo htmlspecialchars($row['tanggal']); ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="uraian" class="form-label">Uraian</label>
                                        <input type="text" class="form-control form-control-sm" id="uraian"
                                            name="uraian" value="<?php echo htmlspecialchars($row['uraian']); ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <input type="number" class="form-control form-control-sm" id="jumlah"
                                            name="jumlah" value="<?php echo htmlspecialchars($row['jumlah']); ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="satuan" class="form-label">Satuan</label>
                                        <input type="text" class="form-control form-control-sm" id="satuan"
                                            name="satuan" value="<?php echo htmlspecialchars($row['satuan']); ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                        <input type="number" class="form-control form-control-sm" id="harga_satuan"
                                            name="harga_satuan"
                                            value="<?php echo htmlspecialchars($row['harga_satuan']); ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="total_harga" class="form-label">Total Harga</label>
                                        <input type="number" class="form-control form-control-sm" id="total_harga"
                                            name="total_harga" readonly>
                                    </div>
                                </div>
                                <a href="pengeluaran.php" class="btn btn-secondary">Kembali</a>
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
                            <p class="mb-0"></p>
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
        document.getElementById('jumlah').addEventListener('input', updateTotalHarga);
        document.getElementById('harga_satuan').addEventListener('input', updateTotalHarga);

        function updateTotalHarga() {
            const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
            const hargaSatuan = parseInt(document.getElementById('harga_satuan').value) || 0;

            const totalHarga = jumlah * hargaSatuan;
            document.getElementById('total_harga').value = totalHarga;
        }

        // Initialize the values on page load
        window.onload = updateTotalHarga;
    </script>
</body>

</html>