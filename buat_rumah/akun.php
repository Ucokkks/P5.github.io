<?php
include "../Controller/controll.php";
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit();
}

$nama = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM rumah WHERE user_id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">

<nav class="bg-white shadow-md py-4">
    <div class="container mx-auto px-4">
        <a href="../halaman/index.php" class="text-lg font-semibold text-gray-800">Len House</a>
        <form action="../account/index.php" method="post">
            <button type="submit" name="logout_btn" class="logout-btn">Logout</button>
        </form>

    </div>
</nav>

<p class="text-2xl font-semibold mb-4 text-center mt-8"><?= "Halo " . $nama; ?></p>
<p class="text-xl mb-4 text-center">Ingin membuat berita:</p>

<div class="flex justify-center mt-4">
    <div class="p-6 bg-white rounded-lg shadow-md w-full max-w-md">
        <a href="create.php" class="block w-full text-center py-2 px-4 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 transition duration-300 ease-in-out">
            Buat Berita
        </a>
    </div>
</div>

<p class="text-xl mb-4 text-center mt-8">Edit berita:</p>
<div class="flex justify-center mt-6">
    <div class="p-6 bg-white rounded-lg shadow-md w-full max-w-3xl overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['nama_rumah']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <a href="update.php?id=<?= $row['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                            <button onclick="konfirmasiHapus(<?= $row['id'] ?>)" class="text-red-600 hover:text-red-900">Hapus</button>
                        </div>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function konfirmasiHapus(id) {
        if (confirm("Yakin ingin menghapus berita ini?")) {
            location.replace("delete.php?delete_id=" + id);
        }
    }
</script>

</body>
</html>
