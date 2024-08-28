<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Menghubungkan Bootstrap CSS untuk styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Mengatur tampilan body agar form login berada di tengah layar secara vertikal dan horizontal */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            /* Tinggi layar penuh */
            background-color: #4d7c8a;
            /* Warna latar belakang */
        }

        /* Mengatur gaya untuk container form login */
        .login-container {
            width: 100%;
            max-width: 380px;
            /* Lebar maksimum container */
            padding: 20px;
            /* Padding dalam container */
            background-color: #f8f9fa;
            /* Warna latar belakang putih */
            border-radius: 10px;
            /* Sudut yang melengkung */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            /* Bayangan pada container */
        }

        /* Mengatur gaya untuk input form ketika difokuskan */
        .login-container .form-control:focus {
            box-shadow: none;
            /* Menghilangkan bayangan saat input difokuskan */
            border-color: #86b7fe;
            /* Warna border saat input difokuskan */
        }

        /* Mengatur warna tombol login */
        .login-container .btn-primary {
            background-color: blue;
            /* Warna tombol */
            border-color: #648a96;
            /* Warna border tombol */
        }

        /* Mengatur gaya tombol saat dihover */
        .login-container .btn-primary:hover {
            background-color: green;
            /* Warna tombol saat dihover */
            border-color: #577c86;
            /* Warna border tombol saat dihover */
        }

        /* Media query untuk ukuran layar kecil */
        @media (max-width: 576px) {
            .login-container {
                padding: 15px;
                /* Mengurangi padding pada layar kecil */
            }

            .login-container img {
                width: 60px;
                height: 60px;
                /* Mengurangi ukuran gambar avatar pada layar kecil */
            }
        }
    </style>
</head>

<body>
    <!-- Container utama untuk form login -->
    <div class="login-container">
        <!-- Gambar avatar di atas form -->
        <div class="text-center mb-4">
            <img src="user4.png" alt="user" class="img-fluid">
            <!-- Menambahkan kelas img-fluid agar gambar bersifat responsif -->
        </div>
        <!-- Form login -->
        <form action="proses_login.php" method="POST">
            <!-- Input username -->
            <div class="mb-1">
                <label for="username" class="form-label"></label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Username">
            </div>
            <!-- Input password -->
            <div class="mb-3">
                <label for="password" class="form-label"></label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <!-- Checkbox untuk remember me -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="rememberMe">
                <label class="form-check-label" for="rememberMe">
                    Remember me
                </label>
            </div>
            <!-- Tombol submit untuk login -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <!-- Link untuk lupa password -->
        <div class="text-center mt-3">
            <a href="#"></a>
        </div>
    </div>
    <!-- Menghubungkan Bootstrap JS dan dependensinya -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>