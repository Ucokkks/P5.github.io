<?php
include "../Controller/controll.php";
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../halaman/index.php');
    exit();
}

if (!isset($_GET['delete_id']) || !is_numeric($_GET['delete_id'])) {
    $_SESSION['error_msg'] = "Parameter tidak valid";
} else {
    $user_id = $_SESSION['user_id'];
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM rumah WHERE id = ? AND user_id = ?";
    $stmt = $koneksi->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ii", $delete_id, $user_id);

        if ($stmt->execute()) {
            echo "Rumah berhasil dihapus.";
        } else {
            echo "Gagal menghapus rumah: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Gagal menyiapkan statement SQL: " . $koneksi->error;
    }
}

header("Location: akun.php");
exit();
?>
