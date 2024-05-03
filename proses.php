<?php
include "koneksi.php";
include "auth.php";


if (isset($_POST["aksi"])) {
    if ($_POST["aksi"] == "add") {
        $tanggal = $_POST["tanggal"];
        $tanggal_keluar = $_POST["tanggal_keluar"];
        $id_barang = $_POST["id_barang"];
        $nama_barang = $_POST["nama_barang"];
        $jenis_peralatan = $_POST["jenis_peralatan"];
        $merk = $_POST["merk"];
        $sn = $_POST["sn"];
        $asal_perolehan = $_POST["asal_perolehan"];
        $harga = $_POST["harga"];
        $status = $_POST["status"];
        $lokasi = $_POST["lokasi"]; // Added lokasi
        $teknisi = $_POST["teknisi"]; // Added teknisi
        $foto = $_FILES["foto"]["name"];
        $file = $_FILES["file"]["name"];
        $keterangan = $_POST["keterangan"];
        $dir = "./uploads/";
        $tmpFile = $_FILES["foto"]["tmp_name"];
        $tmpFile2 = $_FILES["file"]["tmp_name2"];


        move_uploaded_file($tmpFile, $dir . $foto);
        move_uploaded_file($tmpFile, $dir . $file);


        $query = "INSERT INTO masuk VALUES(null, '$tanggal','$tanggal_keluar', '$id_barang', '$nama_barang', '$jenis_peralatan', '$merk', '$sn', '$asal_perolehan','$harga','$status','$lokasi','$teknisi','$foto',$file,'$keterangan')"; // Modified query with lokasi and teknisi
        $sql = mysqli_query($conn, $query);

        if ($sql) {
            if ($status == "masuk") {
                header("location: barangMasuk.php");
            } elseif ($status == "keluar") {
                header("location: barangKeluar.php");
            }
        } else {
            echo $query;
        }
    } elseif ($_POST["aksi"] == "edit") {
        // For edit action, don't change status, lokasi, and teknisi
        $id = $_POST["id"];
        $tanggal = $_POST["tanggal"];
        $tanggal_keluar = $_POST["tanggal_keluar"];

        $nama_barang = $_POST["nama_barang"];
        $jenis_peralatan = $_POST["jenis_peralatan"];
        $merk = $_POST["merk"];
        $sn = $_POST["sn"];
        $asal_perolehan = $_POST["asal_perolehan"];
        $harga = $_POST["harga"];
        
        $lokasi = $_POST["lokasi"];
        $teknisi = $_POST["teknisi"];
        $foto = $_FILES["foto"]["name"];
        $file = $_FILES["file"]["name"];
        $keterangan = $_POST["keterangan"];
    
        $queryShow = "SELECT * FROM masuk WHERE id = '$id'";
        $sqlShow = mysqli_query($conn, $queryShow);
        $result = mysqli_fetch_assoc($sqlShow);
        $status = $result["status"]; // Retrieve the existing status
    
        if ($_FILES["foto"]["name"] == "") {
            $foto = $result["foto"];
        } else {
            $foto = $_FILES["foto"]["name"];
            unlink("./uploads/" . $result["foto"]);
            move_uploaded_file(
                $_FILES["foto"]["tmp_name"],
                "./uploads/" . $_FILES["foto"]["name"]
            );
        }

        if ($_FILES["file"]["name"] == "") {
            $foto = $result["file"];
        } else {
            $foto = $_FILES["file"]["name"];
            unlink("./uploads/" . $result["file"]);
            move_uploaded_file(
                $_FILES["file"]["tmp_name2"],
                "./uploads/" . $_FILES["file"]["name"]
            );
        }
    
        $query = "UPDATE masuk SET tanggal='$tanggal',tanggal_keluar='$tanggal_keluar', nama_barang='$nama_barang',jenis_peralatan='$jenis_peralatan',merk='$merk',sn='$sn',asal_perolehan='$asal_perolehan',harga='$harga',keterangan='$keterangan', foto='$foto', file='$file', status='$status', lokasi='$lokasi', teknisi='$teknisi' WHERE id='$id';";
        $sql = mysqli_query($conn, $query);
    
        if ($sql) {
            if ($status == "masuk") {
                header("location: barangMasuk.php");
            } elseif ($status == "keluar") {
                header("location: barangKeluar.php");
            }
        } else {
            echo $query;
        }
    } elseif ($_POST["aksi"] == "keluar") {
        // For keluar action, only change tanggal, lokasi, teknisi, and keterangan
        $id = $_POST["id"];
        $tanggal_keluar = $_POST["tanggal_keluar"];
        $lokasi = $_POST["lokasi"];
        $teknisi = $_POST["teknisi"];
        $keterangan = $_POST["keterangan"];
        $status = "keluar"; // Set status to "keluar"
    
        $query = "UPDATE masuk SET tanggal_keluar='$tanggal_keluar', lokasi='$lokasi', teknisi='$teknisi', keterangan='$keterangan', status='$status' WHERE id ='$id';";
        $sql = mysqli_query($conn, $query);
    
        if ($sql) {
            header("location: barangKeluar.php");
        } else {
            echo $query;
        }
    }
}

if (isset($_GET["hapus"])) {
    $id = $_GET["hapus"];
    $origin = isset($_GET["origin"]) ? $_GET["origin"] : "barangMasuk.php";

    $queryShow = "SELECT * FROM masuk WHERE id = '$id';";
    $sqlShow = mysqli_query($conn, $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    unlink("./uploads/" . $result["foto"]);

    $query = "DELETE FROM masuk WHERE id = '$id';";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        header("location: $origin");
    } else {
        echo $query;
    }
}

// Check if form is submitted for adding new data
if(isset($_POST['submit'])){
    $namabarang = $_POST['namabarang'];
 
    $query = "INSERT INTO datamaster (namabarang) VALUES ('$namabarang')";
    mysqli_query($conn, $query);
    header("Location: ".$_SERVER['PHP_SELF']); // Redirect to avoid form resubmission
    exit;
}
