<?php
    include 'koneksi.php';

    if(isset($_POST['aksi'])){
        if($_POST['aksi']== 'add'){
            $tanggal = $_POST['tanggal'];
            $id_barang = $_POST['id_barang'];
            $nama_barang = $_POST['nama_barang'];
            $jenis_peralatan = $_POST['jenis_peralatan'];
            $merk = $_POST['merk'];
            $sn = $_POST['sn'];
            $asal_perolehan = $_POST['asal_perolehan'];
            $jumlah_barang = $_POST['jumlah_barang'];
            $harga = $_POST['harga'];
            $keterangan = $_POST['keterangan'];
            $foto = $_POST['foto'];
            
            $query = "INSERT INTO masuk VALUES(null, 'tanggal', 'id_barang', 'nama_barang', 'jenis_peralatan', 'merk', 'sn', 'asal_perolehan','jumlah_barang','harga','keterangan','foto')"; 
            $sql =  mysqli_query($conn, $query);

            if($sql){
                header("location: barangMasuk.php");
            } else {
                echo $query;
            }
        } else if ($_POST["aksi"]== "edit"){
            echo "Edit Data";
        }
    }

    if(isset($_GET['hapus'])){
        $id = $_GET['hapus'];
        $query = "DELETE FROM masuk WHERE id = '$id';";
        $sql = mysqli_query($conn, $query);

        if($sql){
            header("location: barangMasuk.php");
        } else {
            echo $query;
        }
    }
