<?php
include "koneksi.php";

if (isset($_POST["aksi"])) {
    if ($_POST["aksi"] == "add") {
        
        $tanggal = $_POST["tanggal"];

        //WORK MANTAP
        // $barcode = $_POST["id_barang"];
        $date = new DateTime($tanggal);
        $current_time = new DateTime(); // Current date and time
        $id_barang = $date->format("Ymd") . $current_time->format("His");
        $nama_barang = $_POST["nama_barang"];
        $jenis_peralatan = $_POST["jenis_peralatan"];
        $merk = $_POST["merk"];
        $sn = $_POST["sn"];
        $asal_perolehan = $_POST["asal_perolehan"];

        $harga = $_POST["harga"];
        // new status
        $status = $_POST["status"];

        $foto = $_FILES["foto"]["name"];
        $keterangan = $_POST["keterangan"];

        $dir = "./uploads/";
        $tmpFile = $_FILES["foto"]["tmp_name"];

        move_uploaded_file($tmpFile, $dir . $foto);

        echo $tanggal .
            "" .
            // $barcode .
            // "" .
            $id_barang .
            "" .
            $nama_barang .
            "" .
            $jenis_peralatan .
            "" .
            $merk .
            "" .
            $sn .
            "" .
            $asal_perolehan .
            "" .
            $harga .
            "" .
            $status .
            "" .
            $keterangan .
            "";
            $query = "INSERT INTO masuk VALUES(null, '$tanggal', '$id_barang', '$nama_barang', '$jenis_peralatan', '$merk', '$sn', '$asal_perolehan','$harga','$status','$foto','$keterangan')";
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
        echo "Edit Data";
        $id = $_POST["id"];
        $tanggal = $_POST["tanggal"];
        // $barcode = $_POST["barcode"];

        $date = new DateTime($tanggal);
        $current_time = new DateTime(); 
        $id_barang = $date->format("Ymd") . $current_time->format("His");

        $nama_barang = $_POST["nama_barang"];
        $jenis_peralatan = $_POST["jenis_peralatan"];
        $merk = $_POST["merk"];
        $sn = $_POST["sn"];
        $asal_perolehan = $_POST["asal_perolehan"];
        
        $harga = $_POST["harga"];
        
$status = $_POST["status"];
        // $foto = $_FILES['foto']['name'];
        $keterangan = $_POST["keterangan"];

        $queryShow = "SELECT * from masuk WHERE id = '$id';";
        $sqlShow = mysqli_query($conn, $queryShow);
        $result = mysqli_fetch_assoc($sqlShow);

        if ($_FILES["foto"]["name"] == "") {
            $foto = $result["foto"];
        } else {
            $foto = $_FILES["foto"]["name"];
            unlink("./uploads" . $result["foto"]);
            move_uploaded_file(
                $_FILES["foto"]["tmp_name"],
                "./uploads/" . $_FILES["foto"]["name"]
            );
        }

        $query = "UPDATE masuk SET tanggal='$tanggal',nama_barang='$nama_barang',jenis_peralatan='$jenis_peralatan',merk='$merk',sn='$sn',asal_perolehan='$asal_perolehan',harga='$harga',keterangan='$keterangan', foto='$foto', status='$status' WHERE id='$id';";
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


