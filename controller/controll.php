<?php

$koneksi = new mysqli("localhost", "root", "", "rumah");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

?>