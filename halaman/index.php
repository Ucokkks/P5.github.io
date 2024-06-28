<?php
    include "../controller/controll.php";
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>P5</title>
</head>
<body style="font-family: 'Roboto', sans-serif; font-weight: 500;">
<header mt-5>
        <nav class="flex justify-between items-center p-4 bg-white">
            <div class="ml-16">
                <h1 class="text-xl medium-text">Len House</h1>
            </div>
<div class="pr-5">
    <ul class="flex space-x-4">
        <li><a href="#2" class="medium-text text-sm">List</a></li>
        <li><a href="#1" class="medium-text text-sm">Rekomendasi</a></li>
        <li><a href="#3" class="medium-text text-sm">Partner</a></li>
        <li><a href="#4" class="medium-text text-sm">Contact</a></li>
    </ul>
</div>
<?php if (isset($_SESSION['user_id'])): ?>
    <div class="call flex items-center space-x-2">
        <div class="backgrounds p-2 rounded-full bg-gray-200 mr-16">
            <a href="../buat_rumah/akun.php" class="flex items-center space-x-1 text-gray-700 hover:text-gray-900">
                <iconify-icon icon="mdi:account" width="18" height="18"></iconify-icon>
                <span class="text-sm">Profile</span>
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="call flex items-center space-x-2">
        <div class="backgrounds p-2 rounded-full bg-gray-200 mr-16">
            <a href="../account/regis.php" class="flex items-center space-x-1 text-gray-700 hover:text-gray-900">
                <iconify-icon icon="mdi:account" width="18" height="18"></iconify-icon>
                <span class="text-sm">Register</span>
            </a>
        </div>
    </div>
<?php endif; ?>


        </nav>
    </header>

    <section class="">
        <div class="relative">
            <img src="../assets/elements@2x.png" alt="background" style="width: 90%; display: block; margin: 0 auto;">
            <div class="absolute top-0 left-0 bottom-2 w-full h-full flex flex-col justify-center items-center ">
                <p class="text-white text-sm font-medium border-2 border-white px-4 py-2 rounded-xl mb-2">AYO SEGERA</p>
                <h2 class="text-white text-4xl medium-text ">Cari Rumah Yang Nyaman</h2>
                <p class="text-white text-sm font-light mt-2 mb-64">Mulai dari sini kamu bisa mencari rumah impian</p>
            </div>
        </div>
    </section>

    <section class="mt-32 mb-20" id="2">
        <div class="flex flex-col justify-center items-center">
            <h2 class="text-3xl medium-text ">Kategori Fitur</h2>
            <p class="text-sm font-medium mt-2">Menyediakan Berbagai Jenis Pilihan</p>
        </div>
        <div class="relative">
            <div class="flex justify-center items-center mt-24 space-x-24">
                <div class="relative">
                    <a href="rumah.php">
                    <p class="absolute inset-x-0 top-4 text-left ml-6  ">House</p>
                    <img src="../assets/h821.png" alt="house" style="width: 200px;">
                    </a>
                </div>
                <div class="relative">
                    <a href="villa.php">
                    <p class="absolute inset-x-0 top-4 text-left ml-6  ">Villa</p>
                    <img src="../assets/h822.png" alt="Villa" style="width: 200px;">
                    </a>
                </div>
                <div class="relative">
                    <a href="apart.php">
                    <p class="absolute inset-x-0 top-4 text-left ml-6 ">Apart</p>
                    <img src="../assets/h823.png" alt="Apart" style="width: 200px; " class="rounded-xl">
                    </a>
                </div>
            </div>
        </div>
    </section>

<section class="mt-32" id="1">
    <div class="w-full max-w-[90%] mx-auto mx-auto bg-[#F9F9F9] h-[600px] rounded-xl">
        <div class="flex flex-col justify-center items-center pt-24">
            <h2 class="text-3xl medium-text">Rumah Untukmu</h2>
            <p class="text-sm font-medium mt-2">Menyediakan Berbagai Jenis Pilihan</p>
        </div>

        <div class="grid grid-cols-3 gap-8 mt-8 p-8">
            <?php
            // Query untuk mengambil data rumah secara acak
            $query = "SELECT * FROM rumah ORDER BY RAND() LIMIT 3";
            $result = $koneksi->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
            <div class="flex flex-col justify-center items-center">
            <div class="border border-gray-300 rounded-lg p-4 w-full max-w-[70%] ">
                <div class="w-[200px] h-40 overflow-hidden rounded-xl mb-4" >
                    <img src="../assets/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_rumah']; ?>" class="w-[150px] h-48 object-cover rounded-xl">
                </div>
                <div class="flex justify-between">
                    <p class="text-base font-medium text-gray-600"><?php echo $row['nama_rumah']; ?></p>
                    <p class="text-lg font-bold text-gray-800">Rp <?php echo number_format($row['price']); ?></p>
                </div>
                <p class="text-sm font-light text-gray-500 mb-1 flex items-center">
                    <iconify-icon icon="carbon:location" width="18" height="18"></iconify-icon>
                    <span class="ml-2"><?php echo $row['location']; ?></span>
                </p>
                <p class="text-sm font-light text-gray-500 flex items-center">
                    <iconify-icon icon="tabler:bed-filled" width="18" height="18"></iconify-icon>
                    <span class="ml-2"><?php echo $row['kamar_tidur']; ?> Kamar Tidur</span>
                    <span class="mx-2">|</span>
                    <iconify-icon icon="cbi:roomsbathroom" width="18" height="18"></iconify-icon>
                    <span class="ml-2"><?php echo $row['kamar_mandi']; ?> Kamar Mandi</span>
                </p>
            </div>
            </div>
                    <?php
                }
            } else {
                echo "Tidak ada data rumah.";
            }
            ?>
        </div>

    </div>
</section>


    <section class="mt-32" id="3">
        <div class="w-full max-w-[90%] mx-auto bg-[#000000] h-[200px] rounded-lg">
            <div>
                <p class="text-white flex flex-col justify-center items-center pt-24 font-normal">Kami Bekerja Sama Dengan</p>
                <div class="flex flex-row justify-center items-center space-x-24">
                    <iconify-icon icon="cib:amd" width="64" height="64" style="color: white"></iconify-icon>
                    <iconify-icon icon="cib:amazon-aws" width="32" height="32" style="color: white"></iconify-icon>
                    <iconify-icon icon="simple-icons:logitech" width="32" height="32"  style="color: white"></iconify-icon>
                    <iconify-icon icon="logos:spotify" width="64" height="64" ></iconify-icon>
                    <iconify-icon icon="bi:microsoft" width="32" height="32"  style="color: white"></iconify-icon>
                    <iconify-icon icon="hugeicons:figma" width="32" height="32"  style="color: white"></iconify-icon>
                </div>
            </div>
        </div>
    </section>

    <footer class="mt-10 bg-gray-200 py-6" id="4">
    <div class="text-center">
        <p class="text-gray-600">© 2024 Len House. All rights reserved.</p>
    </div>
</footer>



    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
</body>
</html>