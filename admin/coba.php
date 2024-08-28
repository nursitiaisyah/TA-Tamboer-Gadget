<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <!-- Row for Total Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-shopping-cart fa-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title">Total Penjualan</h5>
                                        <p class="card-text" id="totalPenjualan">Loading...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-money-bill-wave fa-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title">Total Pemasukan</h5>
                                        <p class="card-text" id="totalPemasukan">Loading...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-money-check-alt fa-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title">Total Pengeluaran</h5>
                                        <p class="card-text" id="totalPengeluaran">Loading...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-dark">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-coins fa-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title">Total Keuntungan</h5>
                                        <p class="card-text" id="totalKeuntungan">Loading...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row for Charts -->
                    <div class="row">
                        <!-- Card Penjualan -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Penjualan Harian
                                </div>
                                <div class="card-body">
                                    <canvas id="penjualanChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Card Pengeluaran -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Pengeluaran Harian
                                </div>
                                <div class="card-body">
                                    <canvas id="pengeluaranChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Card Pemasukan -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Pemasukan Harian
                                </div>
                                <div class="card-body">
                                    <canvas id="pemasukanChart"></canvas>
                                </div>
                            </div>
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
    <!-- Custom Scripts -->
    <script src="../js/script.js"></script>
    <script>
        <?php
        include 'koneksi.php';

        // Queries to fetch data for the charts
        $penjualanQuery = "SELECT tanggal, SUM(terjual) as total_penjualan FROM penjualan GROUP BY tanggal";
        $penjualanResult = $conn->query($penjualanQuery);
        $penjualanData = [];
        while ($row = $penjualanResult->fetch_assoc()) {
            $penjualanData[] = $row;
        }

        $pengeluaranQuery = "SELECT tanggal, SUM(total_harga) as total_pengeluaran FROM pengeluaran GROUP BY tanggal";
        $pengeluaranResult = $conn->query($pengeluaranQuery);
        $pengeluaranData = [];
        while ($row = $pengeluaranResult->fetch_assoc()) {
            $pengeluaranData[] = $row;
        }

        $pemasukanQuery = "SELECT tanggal, SUM(jumlah) as total_pemasukan FROM pemasukan GROUP BY tanggal";
        $pemasukanResult = $conn->query($pemasukanQuery);
        $pemasukanData = [];
        while ($row = $pemasukanResult->fetch_assoc()) {
            $pemasukanData[] = $row;
        }

        // Queries to fetch total values for the cards
        $totalPenjualanQuery = "SELECT SUM(terjual) as total_penjualan FROM penjualan";
        $totalPengeluaranQuery = "SELECT SUM(total_harga) as total_pengeluaran FROM pengeluaran";
        $totalPemasukanQuery = "SELECT SUM(jumlah) as total_pemasukan FROM pemasukan";

        $totalPenjualanResult = $conn->query($totalPenjualanQuery);
        $totalPengeluaranResult = $conn->query($totalPengeluaranQuery);
        $totalPemasukanResult = $conn->query($totalPemasukanQuery);

        $totalPenjualan = $totalPenjualanResult->fetch_assoc()['total_penjualan'];
        $totalPengeluaran = $totalPengeluaranResult->fetch_assoc()['total_pengeluaran'];
        $totalPemasukan = $totalPemasukanResult->fetch_assoc()['total_pemasukan'];

        // Calculate total keuntungan
        $totalKeuntungan = $totalPemasukan - $totalPengeluaran;

        $conn->close();
        ?>

        // JavaScript for displaying total values in cards
        document.getElementById('totalPenjualan').innerText = "<?php echo number_format($totalPenjualan, 0); ?>";
        document.getElementById('totalPengeluaran').innerText = "<?php echo number_format($totalPengeluaran, 0); ?>";
        document.getElementById('totalPemasukan').innerText = "<?php echo number_format($totalPemasukan, 0); ?>";
        document.getElementById('totalKeuntungan').innerText = "<?php echo number_format($totalKeuntungan, 0); ?>";

        const penjualanData = <?php echo json_encode($penjualanData); ?>;
        const pengeluaranData = <?php echo json_encode($pengeluaranData); ?>;
        const pemasukanData = <?php echo json_encode($pemasukanData); ?>;

        const formatChartData = (data, label) => {
            return {
                labels: data.map(item => item.tanggal),
                datasets: [{
                    label: label,
                    data: data.map(item => item.total_penjualan || item.total_pengeluaran || item.total_pemasukan),
                    fill: true,
                    backgroundColor: (ctx) => {
                        const gradient = ctx.chart.ctx.createLinearGradient(0, 0, 0, 400);
                        gradient.addColorStop(0, 'rgba(75, 192, 192, 0.4)');
                        gradient.addColorStop(1, 'rgba(75, 192, 192, 0)');
                        return gradient;
                    },
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(255, 255, 255, 1)',
                    pointBorderColor: 'rgba(75, 192, 192, 1)',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointHoverBorderColor: 'rgba(220, 220, 220, 1)',
                    pointHoverBorderWidth: 2,
                }]
            };
        };

        const commonOptions = {
            responsive: true,
            scales: {
                x: { title: { display: true, text: 'Tanggal' } },
                y: { title: { display: true, text: 'Jumlah' }, beginAtZero: true }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    titleFont: { size: 16 },
                    bodyFont: { size: 14 },
                    bodySpacing: 4,
                    mode: 'nearest',
                    intersect: false,
                    caretPadding: 10,
                    displayColors: false,
                }
            }
        };

        const penjualanCtx = document.getElementById('penjualanChart').getContext('2d');
        new Chart(penjualanCtx, {
            type: 'line',
            data: formatChartData(penjualanData, 'Jumlah Penjualan'),
            options: commonOptions
        });

        const pengeluaranCtx = document.getElementById('pengeluaranChart').getContext('2d');
        new Chart(pengeluaranCtx, {
            type: 'line',
            data: formatChartData(pengeluaranData, 'Jumlah Pengeluaran'),
            options: commonOptions
        });

        const pemasukanCtx = document.getElementById('pemasukanChart').getContext('2d');
        new Chart(pemasukanCtx, {
            type: 'line',
            data: formatChartData(pemasukanData, 'Jumlah Pemasukan'),
            options: commonOptions
        });
    </script>
</body>

</html>