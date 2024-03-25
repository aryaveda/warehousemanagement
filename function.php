<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "stokbarang");

if(isset($_POST['addnewbarang'])){
    $tanggal = $_POST['tanggal'];
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jenis_peralatan = $_POST['jenis_peralatan'];
    $merk = $_POST['merk'];
    $sn = $_POST['sn'];
    $asal_perolehan = $_POST['asal_perolehan'];
    $jumlah_barang = $_POST['jumlah_barang'];


    $addtotable = mysqli_query($conn,"insert into masuk(tanggal,id_barang,nama_barang,jenis_peralatan,merk,sn,asal_perolehan,jumlah_barang) values('$tanggal','$id_barang','$nama_barang','$jenis_peralatan','$merk','$sn','$asal_perolehan','$jumlah_barang')");
    if($addtotable){
        header('location:index.php');
        exit;
    } else {
        echo 'Gagal';
        header('location:index.php');
        exit;
    }
}