<?php 
session_start();

if (isset($_SESSION['session_username'])) {
    include "koneksi.php";

    if (isset($_POST['op']) && isset($_POST['np']) && isset($_POST['c_np'])) {
        $op = $_POST['op'];
        $np = $_POST['np'];
        $c_np = $_POST['c_np'];

        // Check if fields are empty
        if (empty($op)) {
            header("Location: akun.php?error=Password saat ini harus diisi.");
            exit();
        } elseif (empty($np)) {
            header("Location: akun.php?error=Password baru harus diisi.");
            exit();
        } elseif ($np !== $c_np) {
            header("Location: akun.php?error=Konfirmasi password tidak sesuai.");
            exit();
        } elseif ($np === $op) {
            header("Location: akun.php?error=Password baru tidak boleh sama dengan password saat ini.");
            exit();
        }

        // Hash the passwords
        $op = md5($op); // Not recommended, but using it for now
        $np = md5($np);

        // Check if the current password is correct (since we only have one user 'admin')
        $stmt = $conn2->prepare("SELECT password FROM login WHERE username='admin'");
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if ($row['password'] === $op) {
                // Update the password
                $stmt = $conn2->prepare("UPDATE login SET password=? WHERE username='admin'");
                $stmt->bind_param("s", $np);
                $stmt->execute();
                header("Location: akun.php?success=Password berhasil diubah.");
                exit();
            } else {
                header("Location: akun.php?error=Password saat ini salah.");
                exit();
            }
        } else {
            header("Location: akun.php?error=Akun tidak ditemukan.");
            exit();
        }
    } else {
        header("Location: akun.php?error=Data tidak lengkap.");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
