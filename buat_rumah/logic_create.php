<?php
session_start();
require '../controller/controll.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Validasi jenis properti
    $allowed_types = ['rumah', 'villa', 'apartement'];
    if (!in_array($type, $allowed_types)) {
        echo "Jenis properti tidak valid.";
        exit;
    }

    if (!empty($type) && !empty($nama_rumah) && !empty($price) && !empty($location) && !empty($kamar_tidur) && !empty($bathrooms) && !empty($user_id)) {
        // Prepare and bind the SQL statement
        $stmt = $koneksi->prepare("INSERT INTO rumah (type, nama_rumah, price, location, kamar_tidur, kamar_mandi, gambar, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Bind parameters
        $stmt->bind_param("ssdssdss", $type, $nama_rumah, $price, $location, $kamar_tidur, $bathrooms, $gambar, $user_id);

        // Execute statement
        if ($stmt->execute()) {
            header('Location: ../halaman/index.php');
            exit();
        } else {
            echo "Gagal menambah properti: " . $stmt->error;
        }
    } else {
        echo "Semua field harus diisi!";
    }
}
?>
