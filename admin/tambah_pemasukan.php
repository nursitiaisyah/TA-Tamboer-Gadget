<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pemasukan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
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
            /* Sesuaikan dengan lebar yang diinginkan untuk kolom tanggal */
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
                    </div>
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-1">Tambah Pemasukan</h5>
                        </div>
                        <!-- Form Element -->
                        <div class="card border-0">
                            <div class="card-body">
                                <form action="proses_tambah_pemasukan.php" method="POST">
                                    <div class="row mb-3">
                                        <div class="col-12 d-flex align-items-center">
                                            <label for="tanggal" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control form-control-sm form-control-date"
                                                id="tanggal" name="tanggal" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12 d-flex align-items-center">
                                            <label for="ket_pemasukan" class="form-label">Ket. Pemasukan</label>
                                            <input type="text" class="form-control form-control-sm" id="ket_pemasukan"
                                                name="ket_pemasukan" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12 d-flex align-items-center">
                                            <label for="sumber" class="form-label">Sumber</label>
                                            <input type="text" class="form-control form-control-sm" id="sumber"
                                                name="sumber" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12 d-flex align-items-center">
                                            <label for="jumlah" class="form-label">Jumlah</label>
                                            <input type="number"
                                                class="form-control form-control-sm form-control-amount" id="jumlah"
                                                name="jumlah" required>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary"
                                        onclick="window.history.back()">Kembali</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
</body>

</html>