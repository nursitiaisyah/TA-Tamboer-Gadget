<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penjualan</title>
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
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-1">Tambah Penjualan</h5>
                        </div>
                        <div class="card-body">
                            <form action="proses_tambah_penjualan.php" method="POST">

                                <!-- Tanggal -->
                                <div class="form-group">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control form-control-sm" id="tanggal" name="tanggal"
                                        required style="max-width: 110px;">
                                </div>

                                <!-- Kategori HP -->
                                <div class="form-group">
                                    <label for="kategori_hp" class="form-label">Kategori HP</label>
                                    <select name="kategori_hp" id="kategori_hp" class="form-control form-control-sm"
                                        required>
                                        <option value="">Pilih Kategori</option>
                                        <?php
                                        include 'koneksi.php';
                                        $sql_merek = "SELECT DISTINCT merek FROM produk";
                                        $result_merek = $conn->query($sql_merek);
                                        if ($result_merek->num_rows > 0) {
                                            while ($row_merek = $result_merek->fetch_assoc()) {
                                                echo "<option value='" . $row_merek['merek'] . "'>" . $row_merek['merek'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Varian Produk -->
                                <div class="form-group">
                                    <label for="id_varian" class="form-label">Varian</label>
                                    <select name="id_varian" id="id_varian" class="form-control form-control-sm"
                                        required>
                                        <option value="">Pilih Varian</option>
                                    </select>
                                </div>

                                <!-- Harga Jual -->
                                <div class="form-group">
                                    <label for="harga_jual" class="form-label">Harga Jual</label>
                                    <input type="text" name="harga_jual" id="harga_jual"
                                        class="form-control form-control-sm" readonly
                                        style="max-width: 140px; background-color: #e9ecef; cursor: not-allowed;">
                                </div>


                                <!-- Jumlah -->
                                <div class="form-group">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm"
                                        min="1" required style="max-width: 70px;">
                                </div>

                                <!-- Total Harga -->
                                <div class="form-group">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="text" name="total_harga" id="total_harga"
                                        class="form-control form-control-sm" readonly
                                        style="max-width: 140px; background-color: #e9ecef; cursor: not-allowed;">
                                </div>


                                <!-- Metode Pembayaran -->
                                <div class="form-group">
                                    <label for="metode_pembayaran" class="form-label">Pembayaran</label>
                                    <select name="metode_pembayaran" id="metode_pembayaran"
                                        class="form-control form-control-sm" required>
                                        <option value="">Pilih Metode Pembayaran</option>
                                        <option value="Tunai">Tunai</option>
                                        <option value="Transfer">Transfer</option>
                                    </select>
                                </div>

                                <!-- Pengguna -->
                                <div class="form-group">
                                    <label for="id_user" class="form-label">Pengguna</label>
                                    <select name="id_user" id="id_user" class="form-control form-control-sm" required>
                                        <option value="">Pilih Pengguna</option>
                                        <?php
                                        $sql_user = "SELECT * FROM users";
                                        $result_user = $conn->query($sql_user);
                                        if ($result_user->num_rows > 0) {
                                            while ($row_user = $result_user->fetch_assoc()) {
                                                echo "<option value='" . $row_user['id_user'] . "'>" . $row_user['nama'] . "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>Tidak ada pengguna</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-start">
                                    <button type="button" class="btn btn-secondary me-2" onclick="window.history.back()"
                                        style="font-size: 14px;">
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
            // Mengisi varian berdasarkan merek yang dipilih
            $('#kategori_hp').change(function () {
                var merek = $(this).val();
                $('#id_varian').html('<option value="">Pilih Varian</option>'); // Reset varian

                if (merek) {
                    $.ajax({
                        url: 'get_varian_by_merek.php', // Skrip untuk mengambil varian
                        method: 'POST',
                        data: { merek: merek },
                        success: function (data) {
                            $('#id_varian').append(data); // Tambahkan opsi varian
                        }
                    });
                }
            });

            // Mengisi harga jual otomatis saat varian dipilih
            $('#id_varian').change(function () {
                var harga = $('#id_varian option:selected').data('harga');
                var stok = $('#id_varian option:selected').data('stok');

                if (harga && stok >= 1) {
                    $('#harga_jual').val('Rp. ' + harga.toLocaleString('id-ID', { minimumFractionDigits: 0 }));
                    $('#jumlah').attr('max', stok); // Batas jumlah sesuai stok
                } else {
                    $('#harga_jual').val('');
                    $('#total_harga').val('');
                    $('#jumlah').attr('max', 0);
                }
            });

            // Menghitung total harga saat jumlah diisi
            $('#jumlah').change(function () {
                var jumlah = $(this).val();
                var harga = $('#id_varian option:selected').data('harga');

                if (jumlah > 0 && harga > 0) {
                    var total = jumlah * harga;
                    $('#total_harga').val(total); // Menyimpan total harga
                }
            });
        });
    </script>
</body>

</html>