<?php
include "koneksi.php";
include "auth.php";


$data = [];
$categories = [];

$barang_masuk_query = "SELECT COUNT(*) AS total FROM masuk WHERE `status` = 'masuk'";
$barang_keluar_query = "SELECT COUNT(*) AS total FROM masuk WHERE `status` = 'keluar'";

$result_masuk = mysqli_query($conn, $barang_masuk_query);
$result_keluar = mysqli_query($conn, $barang_keluar_query);

$row_masuk = mysqli_fetch_assoc($result_masuk);
$row_keluar = mysqli_fetch_assoc($result_keluar);

$barang_masuk = $row_masuk['total'];
$barang_keluar = $row_keluar['total'];

mysqli_close($conn);

$data_pie = [$barang_masuk, $barang_keluar];
$labels_pie = ['Barang Masuk', 'Barang Keluar'];

$data_pie_json = json_encode($data_pie);
$labels_pie_json = json_encode($labels_pie);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./assets/compiled/png/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="./assets/compiled/css/iconly.css">
</head>

<body>

    <script src="assets/static/js/initTheme.js"></script>

    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper">
                <div class="sidebar-header position-relative m-0">
                    <div class="justify-content-between align-items-center">
                        <div class="logoBMKG">
                            <a href="index.html"><img src="./assets/compiled/png/logo.png" alt="Logo" style="width: 240px; height: auto;" srcset=""></a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                role="img" class="iconify iconify--system-uicons" width="20" height="20"
                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <!-- Theme toggle SVG -->
                            </svg>
                            <!-- Sidebar toggler SVG -->
                        </div>
                    </div>
                </div>
                <!-- Sidebar menu -->
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item active ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                <span>Tabel Data</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item ">
                                    <a href="barangMasuk.php" class="submenu-link">Barang Masuk</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="barangKeluar.php" class="submenu-link">Barang Keluar</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="semuaBarang.php" class="submenu-link">Semua Barang</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a id="background" href="logout.php" class="btn btn-outline-danger btn-block">
                                <i class="bi bi-box-arrow-left"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End sidebar menu -->
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Warehouse Management BMKG</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="row">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Data Barang Keluar Masuk</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center"> <!-- Center the chartPie horizontally -->
                                    <div id="chartPie"></div>
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
                        <p><a href="#"> Tim MBKM BMKG Stasiun Geofisika Sleman</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>
    <script src="assets/extensions/dayjs/dayjs.min.js"></script>
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/ui-apexchart.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="assets/static/js/pages/toastify.js"></script>
    <script>
        window.onload = function() {
            document.getElementById('toggle-dark').addEventListener('click', function() {
                var logo = document.querySelector('.logoBMKG img');
                if (this.checked) {
                    logo.src = './assets/compiled/png/logo.png'; // Change to your dark logo path
                } else {
                    logo.src = './assets/compiled/png/logoblack.png'; // Change to your light logo path
                }
            });
            
            var optionsPie = {
                series: [{
                    name: 'Jumlah Barang',
                    data: <?php echo $data_pie_json; ?>
                }],
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: <?php echo $labels_pie_json; ?>,
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };
            
            var chartPie = new ApexCharts(document.querySelector("#chartPie"), optionsPie);
            chartPie.render();
        }
    </script>
</body>

</html>
