<?php
include "koneksi.php";


if (isset($_POST["aksi"])) {
    if ($_POST["aksi"] == "add") {
        $tanggal = $_POST["tanggal"];
        // $barcode = $_POST["barcode"];
        //new barcode

        $barcode = $_POST["id_barang"];
        
        //id barang new code
        $id_barang = (new DateTime($_POST["tanggal"]))->format("YmdHis");
        $nama_barang = $_POST["nama_barang"];
        $jenis_peralatan = $_POST["jenis_peralatan"];
        $merk = $_POST["merk"];
        $sn = $_POST["sn"];
        $asal_perolehan = $_POST["asal_perolehan"];

        $harga = $_POST["harga"];
        $foto = $_FILES["foto"]["name"];
        $keterangan = $_POST["keterangan"];

        $dir = "./uploads/";
        $tmpFile = $_FILES["foto"]["tmp_name"];

        move_uploaded_file($tmpFile, $dir . $foto);

        echo $tanggal .
            "" .
            $barcode .
            "" .
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
            $keterangan .
            "";
        $query = "INSERT INTO masuk VALUES(null, '$tanggal', '$barcode', '$id_barang', '$nama_barang', '$jenis_peralatan', '$merk', '$sn', '$asal_perolehan','$harga','$foto','$keterangan')";
        $sql = mysqli_query($conn, $query);

        if ($sql) {
            // echo $tanggal.''.$barcode.''.$id_barang.''.$nama_barang.''.$jenis_peralatan.''.$merk.''.$sn.''.$asal_perolehan.''.$jumlah_barang.''.$harga.''.$keterangan.'';
            header("location: barangMasuk.php");
        } else {
            echo $query;
        }
    } elseif ($_POST["aksi"] == "edit") {
        echo "Edit Data";
        $id = $_POST["id"];
        $tanggal = $_POST["tanggal"];
        $barcode = $_POST["barcode"];
        $id_barang = $_POST["id_barang"];
        $nama_barang = $_POST["nama_barang"];
        $jenis_peralatan = $_POST["jenis_peralatan"];
        $merk = $_POST["merk"];
        $sn = $_POST["sn"];
        $asal_perolehan = $_POST["asal_perolehan"];
        
        $harga = $_POST["harga"];
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

        $query = "UPDATE masuk SET tanggal='$tanggal', barcode='$barcode', id_barang='$id_barang',nama_barang='$nama_barang',merk='$merk',sn='$sn',asal_perolehan='$asal_perolehan',harga='$harga',keterangan='$keterangan', foto='$foto' WHERE id='$id';";
        $sql = mysqli_query($conn, $query);

        if ($sql) {
            // echo $tanggal.''.$barcode.''.$id_barang.''.$nama_barang.''.$jenis_peralatan.''.$merk.''.$sn.''.$asal_perolehan.''.$jumlah_barang.''.$harga.''.$keterangan.'';
            header("location: barangMasuk.php");
        } else {
            echo $query;
        }
    }
}

if (isset($_GET["hapus"])) {
    $id = $_GET["hapus"];

    $queryShow = "SELECT * from masuk WHERE id = '$id';";
    $sqlShow = mysqli_query($conn, $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    unlink("./uploads" . $result["foto"]);

    $query = "DELETE FROM masuk WHERE id = '$id';";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        header("location: barangMasuk.php");
    } else {
        echo $query;
    }
}