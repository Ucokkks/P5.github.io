<?php
session_start();
include '../controller/controll.php';

if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit();
}

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    $stmt = $koneksi->prepare("SELECT * FROM rumah WHERE id = ?");
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Properti tidak ditemukan.";
        exit();
    }

    $property = $result->fetch_assoc();
} else {
    echo "ID properti tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Properti</title>
    <link href="path-to-tailwind.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Properti</h1>
        <form action="logic_update.php" method="POST" enctype="multipart/form-data" class="mb-4">
            <input type="hidden" name="id" value="<?= $property['id'] ?>">
            <div class="mb-4">
                <label class="block text-gray-700">Nama Properti:</label>
                <input type="text" name="nama_rumah" value="<?= htmlspecialchars($property['nama_rumah']) ?>" class="border rounded w-full py-2 px-3">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Harga:</label>
                <input type="number" name="price" value="<?= $property['price'] ?>" class="border rounded w-full py-2 px-3">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Lokasi:</label>
                <input type="text" name="location" value="<?= htmlspecialchars($property['location']) ?>" class="border rounded w-full py-2 px-3">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Total Kamar Tidur:</label>
                <input type="number" name="kamar_tidur" value="<?= $property['kamar_tidur'] ?>" class="border rounded w-full py-2 px-3">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Total Kamar Mandi:</label>
                <input type="number" name="bathrooms" value="<?= $property['kamar_mandi'] ?>" class="border rounded w-full py-2 px-3">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Tipe Properti:</label>
                <div>
                    <label class="inline-flex items-center">
                        <input type="radio" name="type" value="rumah" class="form-radio" <?= ($property['type'] === 'rumah') ? 'checked' : '' ?>>
                        <span class="ml-2">Rumah</span>
                    </label>
                    <label class="inline-flex items-center ml-4">
                        <input type="radio" name="type" value="villa" class="form-radio" <?= ($property['type'] === 'villa') ? 'checked' : '' ?>>
                        <span class="ml-2">Villa</span>
                    </label>
                    <label class="inline-flex items-center ml-4">
                        <input type="radio" name="type" value="apartement" class="form-radio" <?= ($property['type'] === 'apartemen') ? 'checked' : '' ?>>
                        <span class="ml-2">Apartemen</span>
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Gambar:</label>
                <input type="file" name="gambar" class="border rounded w-full py-2 px-3">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
