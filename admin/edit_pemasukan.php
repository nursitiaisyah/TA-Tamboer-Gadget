<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemasukan</title>
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
            max-width: 200px;
            /* Sesuaikan dengan lebar yang diinginkan */
        }

        .form-control-date {
            max-width: 119px;
            /* Sesuaikan dengan lebar yang diinginkan */
        }

        .form-control-amount {
            max-width: 120px;
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

                    <!-- Form Edit Pemasukan -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Pemasukan</h5>
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
                            $sql = "SELECT * FROM pemasukan WHERE id_pemasukan = ?";
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

                            <form action="proses_edit_pemasukan.php" method="POST">
                                <input type="hidden" name="id_pemasukan" value="<?php echo $row['id_pemasukan']; ?>">
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control form-control-sm form-control-date"
                                            id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="ket_pemasukan" class="form-label">Keterangan</label>
                                        <input type="text" class="form-control form-control-sm" id="ket_pemasukan"
                                            name="ket_pemasukan" value="<?php echo $row['ket_pemasukan']; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="sumber" class="form-label">Sumber</label>
                                        <input type="text" class="form-control form-control-sm" id="sumber"
                                            name="sumber" value="<?php echo $row['sumber']; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <input type="number" class="form-control form-control-sm form-control-amount"
                                            id="jumlah" name="jumlah" value="<?php echo $row['jumlah']; ?>" required>
                                    </div>
                                </div>
                                <a href="pemasukan.php" class="btn btn-secondary">Kembali</a>
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
</body>

</html>