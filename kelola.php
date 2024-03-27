<?php
include('function.php'); // Include the function.php file
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Warehouse BMKG</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="dashboard.php"><img src="assets/img/logo.png"></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="pelaporan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Pelaporan
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Data Barang
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="barangMasuk.php">Barang Masuk</a>
                                    <a class="nav-link" href="barangKeluar.php">Barang Keluar</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container mt-4 ml-30 pl-10">
                        <form method="POST" action="proses.php">
                            <div class="mb-3 row">
                                <label for="tanggal" class="form-label">Tanggal Masuk</label>
                                <div class="col-sm-10">
                                <input type="date" name="tanggal" class="form-control" id="tanggal">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="id_barang" class="form-label">ID Barang</label>
                                <div class="col-sm-10">
                                <input type="text" name="id_barang" class="form-control" id="id_barang" placeholder="Ex: 12345">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                <input type="text" name="nama_barang" class="form-control" id="nama_barang" placeholder="Ex: Proyektor Infocus">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jenis_peralatan" class="form-label">Jenis Peralatan</label>
                                <div class="col-sm-10">
                                <input type="text" name="jenis_peralatan" class="form-control" id="jenis_peralatan" placeholder="Ex: Sensor">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="merk" class="form-label">Merk</label>
                                <div class="col-sm-10">
                                <input type="text" name="merk" class="form-control" id="merk" placeholder="Ex: Toyota">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="sn" class="form-label">Serial Number</label>
                                <div class="col-sm-10">
                                <input type="text" name="sn" class="form-control" id="sn" placeholder="Ex: RD800">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="asal_perolehan" class="form-label">Asal Perolehan</label>
                                <div class="col-sm-10">
                                <input type="text" name="asal_perolehan" class="form-control" id="asal_perolehan" placeholder="Ex: Hibah">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jumlah_barang class="form-label">Jumlah Barang</label>
                                <div class="col-sm-10">
                                <input type="number" name="jumlah_barang" class="form-control" id="jumlah_barang" placeholder="Ex: 10">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="harga class="form-label">Harga Barang</label>
                                <div class="col-sm-10">
                                <input type="number" name="harga" class="form-control" id="harga" placeholder="Ex: 100000">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keterangan class="form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto Gambar</label>
                                    <input class="form-control" name="foto" type="file" id="foto">
                                </div>
                            </div>
                        

                        <!-- TAMBAH DAN BATAL -->
                        <div class="mb-3 row mt-4">
                            <div class="col">
                                <?php
                                    if(isset($_GET['ubah'])){
                                ?>
                                    <button type="submit" name="aksi" value="edit" class="btn btn-primary" id="tambah">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                        Simpan Perubahan
                                    </button>
                                <?php
                                    } else {
                                ?>
                                    <button type="submit" name="aksi" value="add" class="btn btn-primary" id="tambah">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                        Tambahkan
                                    </button>
                                <?php
                                    }
                                ?>
                                <a href="barangMasuk.php" type="button" class="btn btn-danger" id="batal">
                                <i class="fa-solid fa-reply"></i>
                                    Batal
                                </a>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- END TAMBAH DAN BATAL -->
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; MBKM BMKG 2024</div>
        
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
