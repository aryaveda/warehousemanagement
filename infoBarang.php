<?php
// include "auth.php";
include "koneksi.php";
session_start();
$userLoggedIn = isset($_SESSION['session_username']);
$rememberMe = isset($_COOKIE['cookie_username']) && isset($_COOKIE['cookie_password']);

// If user is not logged in and not remembered, disable sidebar menu
$sidebarDisabled = !($userLoggedIn || $rememberMe);
require "vendor/autoload.php";
// $query = "SELECT * FROM masuk;";
// $sql = mysqli_query($conn, $query);
$no = 0;
$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Barang - BMKG Warehouse Management</title>
    
    <link rel="shortcut icon" href="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2033%2034'%20fill-rule='evenodd'%20stroke-linejoin='round'%20stroke-miterlimit='2'%20xmlns:v='https://vecta.io/nano'%3e%3cpath%20d='M3%2027.472c0%204.409%206.18%205.552%2013.5%205.552%207.281%200%2013.5-1.103%2013.5-5.513s-6.179-5.552-13.5-5.552c-7.281%200-13.5%201.103-13.5%205.513z'%20fill='%23435ebe'%20fill-rule='nonzero'/%3e%3ccircle%20cx='16.5'%20cy='8.8'%20r='8.8'%20fill='%2341bbdd'/%3e%3c/svg%3e" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    
  <link rel="stylesheet" crossorigin href="./assets/compiled/css/app.css">
  <link rel="stylesheet" crossorigin href="./assets/compiled/css/app-dark.css">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
            <a href="index.php"><img src="./assets/compiled/png/logo.png" alt="Logo" style="width: 240px; height: auto;" srcset=""></a>
            </div>
            <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="iconify iconify--system-uicons" width="20" height="20"
                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                    <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                            opacity=".3"></path>
                        <g transform="translate(-210 -1)">
                            <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                            <circle cx="220.5" cy="11.5" r="4"></circle>
                            <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                        </g>
                    </g>
                </svg>
                <div class="form-check form-switch fs-6">
                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                    <label class="form-check-label"></label>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                    </path>
                </svg>
            </div>
            <div class="sidebar-toggler  x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <?php if ($userLoggedIn || $rememberMe) { ?>
                <li class="sidebar-item">
                    <a href="index.php" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            <?php } ?>

            <!-- Tabel Data -->
            <?php if ($userLoggedIn || $rememberMe) { ?>
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Tabel Data</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="barangMasuk.php" class="submenu-link">Barang Masuk</a>
                        </li>
                        <li class="submenu-item">
                            <a href="barangKeluar.php" class="submenu-link">Barang Keluar</a>
                        </li>
                        <li class="submenu-item">
                            <a href="semuaBarang.php" class="submenu-link">Semua Barang</a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($userLoggedIn || $rememberMe) { ?>
                <li class="sidebar-item">
                    <a href="logout.php" class="btn btn-outline-danger btn-block">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>
            <?php } else { ?>
                <li class="sidebar-item">
                    <a href="login.php" class="btn btn-outline-info btn-block">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Login untuk melanjutkan</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Informasi Barang</h3>
                
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Informasi Barang</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
<?php
    // Check if id_barang is set in the URL parameters
    if(isset($_GET['id_barang'])) {
        // Get the id_barang from the URL parameters
        $id_barang = $_GET['id_barang'];
        
        // Your database connection code here
        
        // Prepare your SQL query with a WHERE clause to fetch only the item with the matching id_barang
        $query = "SELECT * FROM masuk WHERE id_barang = '$id_barang'";
        
        // Execute the query
        $sql = mysqli_query($conn, $query);
        
        // Loop through the results
        while ($result = mysqli_fetch_assoc($sql)) {
?>
    <section class="section">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="">
    <img src="./uploads/<?php echo $result["foto"]; ?>" style="max-width: 300px; border-radius: 10px;">
</div>

                            <h3 class="mt-3"><?php echo $result["nama_barang"]; ?></h3>
                            <p class="text-small"><?php echo $result["id_barang"]; ?></p>
                            <p class="text-small">Status Barang: <?php if ($result["status"] == "masuk") {
            echo '<span class="badge bg-success">Masuk</span>';
        } elseif ($result["status"] == "keluar") {
            echo '<span class="badge bg-danger">Keluar</span>';
        } else {
            echo $result["status"]; // Display status as it is if neither "masuk" nor "keluar"
        } ?></p>

                            

                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <!-- FORM READ ONLY -->
                    <form action="#" method="get">
    <div class="form-group">
        <label for="tanggal" class="form-label">Tanggal Masuk</label>
        <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="-" value="<?php echo $result["tanggal"]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="tanggal" class="form-label">Tanggal Keluar</label>
        <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control" placeholder="-" value="<?php echo $result["tanggal_keluar"]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="email" class="form-label">ID Barang</label>
        <input type="text" name="id_barang" id="id_barang" class="form-control" placeholder="-" value="<?php echo $result["id_barang"]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="nama_barang" class="form-label">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="-" value="<?php echo $result["nama_barang"]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="jenis_peralatan" class="form-label">Jenis Peralatan</label>
        <input type="text" name="jenis_peralatan" id="jenis_peralatan" class="form-control" placeholder="-" value="<?php echo $result["jenis_peralatan"]; ?>"readonly>
    </div>
    <div class="form-group">
        <label for="merk" class="form-label">Merk</label>
        <input type="text" name="merk" id="merk" class="form-control" placeholder="-" value="<?php echo $result["merk"]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="sn" class="form-label">Serial Number</label>
        <input type="text" name="sn" id="sn" class="form-control" placeholder="-" value="<?php echo $result["sn"]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="asal_perolehan" class="form-label">Asal Perolehan</label>
        <input type="text" name="asal_perolehan" id="asal_perolehan" class="form-control" placeholder="-" value="<?php echo $result["asal_perolehan"]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="harga" class="form-label">Harga</label>
        <input type="text" name="harga" id="harga" class="form-control" placeholder="-" value="<?php echo $result["harga"]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="harga" class="form-label">Lokasi</label>
        <input type="text" name="harga" id="harga" class="form-control" placeholder="-" value="<?php echo $result["lokasi"]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="harga" class="form-label">Teknisi Penanggungjawab</label>
        <input type="text" name="harga" id="harga" class="form-control" placeholder="-" value="<?php echo $result["teknisi"]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="keterangan" class="form-label">Keterangan</label>
        <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="-" value="<?php echo $result["keterangan"]; ?>" readonly>
    </div>
    <!-- No submit button for an uneditable form -->
</form>
<?php
        }
    }
    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    
<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2024 &copy; Stasiun Geofisika Sleman</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                by <a href="#"> Tim MBKM BMKG Stasiun Geofisika Sleman</a></p>
        </div>
    </div>
</footer>
        </div>
    </div>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    
    
    <script src="assets/compiled/js/app.js"></script>
    

    
</body>

</html>