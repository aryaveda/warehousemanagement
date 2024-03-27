<?php
// require_once("includes/dbh.inc.php");
// include("includes/delete.inc.php");
// $query = "select * from masuk";
// $result = $pdo->query($query);
    include 'koneksi.php';
    $query = "SELECT * FROM masuk;";
    $sql = mysqli_query($conn, $query);
    $no = 0;
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Masuk - Warehouse BMKG</title>
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
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Barang Masuk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Barang Masuk</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="kelola.php" type="button" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                    Tambah Barang
                                  </a>
                                </div>
                            </div>
                            <!-- <div class="card-body"> -->
                            <div class="table-responsive">
                                <table class="table align-middle table-bordered table-hover" id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>ID Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Peralatan</th>
                                            <th>Merk</th>
                                            <th>SN</th>
                                            <th>Asal Perolehan</th>
                                            <th>Jumlah Barang</th>
                                            <th>Harga</th>
                                            <th>Keterangan</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        while($result = mysqli_fetch_assoc($sql)) {
                                            ?>
                                            <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo (new DateTime($result['tanggal']))->format('Y-m-d'); ?></td>
                                            <td><?php echo $result['id_barang']; ?></td>
                                            <td><?php echo $result['nama_barang']; ?></td>
                                            <td><?php echo $result['jenis_peralatan']; ?></td>
                                            <td><?php echo $result['merk']; ?></td>
                                            <td><?php echo $result['sn']; ?></td>
                                            <td><?php echo $result['asal_perolehan']; ?></td>
                                            <td><?php echo $result['jumlah_barang']; ?></td>
                                            <td><?php echo $result['harga']; ?></td>
                                            <td><?php echo $result['keterangan']; ?></td>
                                            <td><img src="/uploads/<?php echo $result['foto']; ?>" alt="Photo"></td>
                                            <td>
                                                <a href="kelola.php?ubah=<?php echo $result['id'];?>" type="button" class="btn btn-success btn-sm">
                                                      <i class="fa-solid fa-pencil"></i>
                                                </a>
                                                <a href="proses.php?hapus=<?php echo $result['id'];?>" type="button" class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                            </tr>
                                            <?php
                                        }
                                      ?>
                                      </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener("click", function() {
            var id = this.getAttribute('data-id');
            document.getElementById('delete-link').href = 'includes/delete.inc.php?id=' + id;
        });
    });
</script>

    </body>
    <!-- MODAL BUAT CREATE -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form action="includes/formhandler.inc.php" method="post">
            <div class="modal-body">
                <input type="date" name="tanggal" placeholder="Tanggal Barang Masuk" class="form-control" required>
                <br>
                <input type="text" name="id_barang" placeholder="ID Barang" class="form-control" required>
                <br>
                <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control" required>
                <br>
                <input type="text" name="jenis_peralatan" placeholder="Jenis Peralatan" class="form-control" required>
                <br>
                <input type="text" name="merk" placeholder="Merk" class="form-control" required>
                <br>
                <input type="text" name="sn" placeholder="SN" class="form-control" required>
                <br>
                <input type="text" name="asal_perolehan" placeholder="Asal Perolehan" class="form-control" required>
                <br>
                <input type="number" name="jumlah_barang" placeholder="Jumlah Barang" class="form-control" required>
                <br>
                <input type="number" name="harga" placeholder="Harga Barang" class="form-control" required>
                <br>
                <input type="text" name="keterangan" placeholder="Keterangan" class="form-control" required>
                <br>                     
                <input type="file" name="foto" placeholder="Foto" class="form-control" required>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div> 


<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>Apakah Anda yakin ingin menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <form>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
            <button class="btn btn-danger" ><a id="delete-link" class="btn btn-danger">Ya, Hapus</a> </button>
        </form>
      </div>
    </div>
  </div>
</div>
</html>
