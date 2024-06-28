<?php
include "../controller/controll.php";
session_start();

$action = isset($_POST['action']) ? $_POST['action'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : ''; 
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($action === "regis") {
    if (!empty($username) && !empty($email) && !empty($password)) {  
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO akun (nama, email, password) VALUES ('$username', '$email', '$password_hash')";

        if ($koneksi->query($sql) === TRUE) {
            header('Location: ./login.php');
            exit();
        } else {
            echo "Gagal menambah akun: " . $koneksi->error;
        }
    } else {
        echo "Semua field harus diisi!";
    }
}


if ($action === 'login') {
    if (!empty($username) && !empty($password)) {
        $sql = "SELECT * FROM akun WHERE nama = '$username'";
        $result = $koneksi->query($sql);

        if ($result->num_rows === 0) {
            header('Location: login.php?msg=Username%20atau%20Password%20salah!!');
            exit();
        } else {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $row['id'];
                header('Location: ../buat_rumah/akun.php');
                exit();
            } else {
                header('Location: login.php?msg=Username%20atau%20Password%20salah!!');
                exit();
            }
        }
    } else {
        echo "Username dan Password harus diisi!";
    }

       

}

if ($action === 'logout') {
    session_destroy();
    header('Location: ../halaman/index.php');
    exit();
}

$koneksi->close();
?>