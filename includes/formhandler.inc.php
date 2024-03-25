<php?

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $tanggal = $_POST["tanggal"];
    $id_barang = $_POST["id_barang"];
    $nama_barang = $_POST["nama_barang"];
    $jenis_peralatan = $_POST["jenis_peralatan"];
    $merk = $_POST["merk"];
    $sn = $_POST["sn"];
    $asal_perolehan = $_POST["asal_perolehan"];
    $jumlah_barang = $_POST["jumlah_barang"];

    try{
        require_once "dbh.inc.php";
        
        $query = "INSERT INTO masuk (tanggal, id_barang, nama_barang, jenis_peralatan, merk, sn, asal perolehan, jumlah_barang) VALUES(?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$tanggal, $id_barang, $nama_barang, $jenis_peralatan, $merk, $sn, $asal_perolehan, $jumlah_barang]);

        $pdo = null;
        $stmt = null;
        header("Location: ../barangmasuk.php");
        die();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: ../barangmasuk.php");
}