<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Villa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="grid grid-cols-3 gap-8 mt-8 p-8">
        <?php
        session_start();
        require '../controller/controll.php';

        // Query untuk mengambil informasi enum dari kolom 'type'
        $sql_enum = "SHOW COLUMNS FROM rumah LIKE 'type'";
        $result_enum = $koneksi->query($sql_enum);

        if ($result_enum->num_rows > 0) {
            $row_enum = $result_enum->fetch_assoc();
            // Mendapatkan definisi enum
            $enum_definition = $row_enum['Type'];
            
            // Mendapatkan nilai-nilai enum
            preg_match_all("/'([^']*)'/", $enum_definition, $matches);
            $enum_values = $matches[1];
            
            // Menampilkan hanya nilai 'villa'
            if (in_array('villa', $enum_values)) {
                // Query untuk mengambil data villa dengan jenis 'villa'
                $sql_properties = "SELECT nama_rumah, price, location, kamar_tidur, kamar_mandi, gambar FROM rumah WHERE type = 'villa' ORDER BY RAND() LIMIT 3";
                $result_properties = $koneksi->query($sql_properties);

                // Menampilkan hasil query
                if ($result_properties->num_rows > 0) {
                    while ($row = $result_properties->fetch_assoc()) {
                        ?>
                        <div class="border border-gray-300 rounded-lg p-4 w-full max-w-[70%]">
                            <div class="w-[200px] h-40 overflow-hidden rounded-xl mb-4">
                                <img src="../assets/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_rumah']; ?>" class="w-full h-full object-cover rounded-xl">
                            </div>
                            <div class="flex justify-between">
                                <p class="text-base font-medium text-gray-600"><?php echo $row['nama_rumah']; ?></p>
                                <p class="text-lg font-bold text-gray-800">Rp <?php echo number_format($row['price']); ?></p>
                            </div>
                            <p class="text-sm font-light text-gray-500 mb-1 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 0a8 8 0 0 1 8 8c0 5.25-8 12-8 12S2 13.25 2 8a8 8 0 0 1 8-8zm0 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/>
                                </svg>
                                <span class="ml-2"><?php echo $row['location']; ?></span>
                            </p>
                            <p class="text-sm font-light text-gray-500 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><g fill="currentColor"><path d="M3 6a1 1 0 0 1 .993.883L4 7v6h6V8a1 1 0 0 1 .883-.993L11 7h8a3 3 0 0 1 2.995 2.824L22 10v8a1 1 0 0 1-1.993.117L20 18v-3H4v3a1 1 0 0 1-1.993.117L2 18V7a1 1 0 0 1 1-1"/><path d="M7 8a2 2 0 1 1-1.995 2.15L5 10l.005-.15A2 2 0 0 1 7 8"/></g></svg>
                                <span class="ml-2"><?php echo $row['kamar_tidur']; ?> Kamar Tidur</span>
                                <span class="mx-2">|</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><path fill="currentColor" d="M96 77.3C96 70 101.9 64 109.3 64c3.5 0 6.9 1.4 9.4 3.9l14.9 14.9c-3.6 9-5.6 18.9-5.6 29.2c0 19.9 7.2 38 19.2 52c-5.3 9.2-4 21.1 3.8 29c9.4 9.4 24.6 9.4 33.9 0L289 89c9.4-9.4 9.4-24.6 0-33.9c-7.9-7.9-19.8-9.1-29-3.8C246 39.2 227.9 32 208 32c-10.3 0-20.2 2-29.2 5.5l-14.9-14.9C149.4 8.1 129.7 0 109.3 0C66.6 0 32 34.6 32 77.3V256c-17.7 0-32 14.3-32 32s14.3 32 32 32h448c17.7 0 32-14.3 32-32s-14.3-32-32-32H96zM32 352v16c0 28.4 12.4 54 32 71.6V480c0 17.7 14.3 32 32 32s32-14.3 32-32v-16h256v16c0 17.7 14.3 32 32 32s32-14.3 32-32v-40.4c19.6-17.6 32-43.1 32-71.6v-16z"/></svg>
                                <span class="ml-2"><?php echo $row['kamar_mandi']; ?> Kamar Mandi</span>
                            </p>
                        </div>
                        <?php
                    }
                } else {
                    echo "Tidak ada data villa dengan jenis 'villa'.";
                }
            } else {
                echo "Nilai enum 'villa' tidak ditemukan.";
            }
        } else {
            echo "Kolom tidak ditemukan.";
        }
        ?>
    </div>
</body>
</html>
