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
            $foto = $_FILES['foto']['name'];
            $keterangan = $_POST['keterangan'];
          
            $dir = "../uploads/";
            $tmpFile = $_FILES['foto']['tmp_name'];

            move_uploaded_file($tmpFile, $dir.$foto);

            // echo $tanggal.''.$id_barang.''.$nama_barang.''.$jenis_peralatan.''.$merk.''.$sn.''.$asal_perolehan.''.$jumlah_barang.''.$harga.''.$keterangan.'';
            $query = "INSERT INTO masuk VALUES(null, '$tanggal', '$id_barang', '$nama_barang', '$jenis_peralatan', '$merk', '$sn', '$asal_perolehan','$jumlah_barang','$harga','$foto','$keterangan')"; 
            $sql =  mysqli_query($conn, $query);

            if($sql){
                // echo $tanggal.''.$id_barang.''.$nama_barang.''.$jenis_peralatan.''.$merk.''.$sn.''.$asal_perolehan.''.$jumlah_barang.''.$harga.''.$keterangan.'';
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

        $queryShow = "SELECT * from masuk WHERE id = '$id';";
        $sqlShow = mysqli_query($conn, $queryShow);
        $result = mysqli_fetch_assoc($sqlShow);

        unlink("../uploads".$result['foto']);

        $query = "DELETE FROM masuk WHERE id = '$id';";
        $sql = mysqli_query($conn, $query);

        if($sql){
            header("location: barangMasuk.php");
        } else {
            echo $query;
        }
    }
