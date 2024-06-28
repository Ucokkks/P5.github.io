<?php
session_start();
require '../controller/controll.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $nama_rumah = $_POST['nama_rumah'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $kamar_tidur = $_POST['kamar_tidur'];
    $bathrooms = $_POST['bathrooms'];
    $user_id = $_SESSION['user_id']; // Asumsikan user_id disimpan di sesi setelah login

    $gambar = null;
    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "../assets/";
        $gambar = basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $gambar;

        if (!move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }

    if (!empty($id) && !empty($type) && !empty($nama_rumah) && !empty($price) && !empty($location) && !empty($kamar_tidur) && !empty($bathrooms) && !empty($user_id)) {
        // Prepare SQL statement based on whether gambar is updated or not
        if (!empty($gambar)) {
            $stmt = $koneksi->prepare("UPDATE rumah SET type = ?, nama_rumah = ?, price = ?, location = ?, kamar_tidur = ?, kamar_mandi = ?, gambar = ? WHERE id = ?");
            $stmt->bind_param("ssdsdssi", $type, $nama_rumah, $price, $location, $kamar_tidur, $bathrooms, $gambar, $id);
        } else {
            $stmt = $koneksi->prepare("UPDATE rumah SET type = ?, nama_rumah = ?, price = ?, location = ?, kamar_tidur = ?, kamar_mandi = ? WHERE id = ?");
            $stmt->bind_param("ssdsdsi", $type, $nama_rumah, $price, $location, $kamar_tidur, $bathrooms, $id);
        }

        if ($stmt->execute()) {
            header('Location: ../halaman/index.php');
            exit();
        } else {
            echo "Gagal menyimpan perubahan: " . $stmt->error;
        }
    } else {
        echo "Semua field harus diisi!";
    }
}
?>
