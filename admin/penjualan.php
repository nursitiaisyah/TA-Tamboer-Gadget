<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Custom styles for responsive tables */
        @media (max-width: 768px) {
            table.dataTable tbody td {
                font-size: 11px;
            }

            table.dataTable thead th {
                font-size: 11px;
            }
        }

        @media (min-width: 769px) {
            table.dataTable tbody td {
                font-size: 14px;
            }

            table.dataTable thead th {
                font-size: 14px;
            }
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

                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Data Penjualan</h5>
                            <a href="tambah_penjualan.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Jual</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Produksi</th>
                                            <th scope="col">Terjual</th>
                                            <th scope="col" class="d-none d-md-table-cell">Sisa</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Hasil</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'koneksi.php';
                                        $sql = "SELECT * FROM penjualan";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            $no = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                    <th scope='row'>" . $no++ . "</th>
                                                    <td>" . $row['id_penjualan'] . "</td>
                                                    <td>" . $row['tanggal'] . "</td>
                                                    <td>" . $row['jumlah_produksi'] . "</td>
                                                    <td>" . $row['terjual'] . "</td>
                                                    <td class='d-none d-md-table-cell'>" . $row['sisa'] . "</td>
                                                    <td>" . number_format($row['harga_perbungkus'], 0) . "</td>
                                                    <td>" . number_format($row['hasil_pendapatan'], 0) . "</td>
                                                    <td>
                                                        <a href='edit_penjualan.php?id=" . $row['id_penjualan'] . "' class='btn btn-outline-primary btn-sm'>
                                                            <i class='fas fa-pencil-alt'></i>
                                                        </a>
                                                        <button class='btn btn-outline-danger btn-sm' onclick='confirmDelete(" . $row['id_penjualan'] . ")'>
                                                            <i class='fas fa-trash'></i>
                                                        </button>
                                                    </td>
                                                </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='9' class='text-center'>No data available</td></tr>";
                                        }
                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Theme Toggle -->
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-sun"></i>
            </a>
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
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <!-- Custom Scripts -->
    <script src="../js/script.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 75, 100],
                "order": []
            });
        });

        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = 'hapus_penjualan.php?id=' + id;
            }
        }
    </script>
</body>

</html>