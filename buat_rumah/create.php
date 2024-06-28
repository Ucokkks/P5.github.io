<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Properti</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Tambah Properti</h1>
        <form action="logic_create.php" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_rumah">Nama Properti:</label>
                <input type="text" name="nama_rumah" id="nama_rumah" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Harga:</label>
                <input type="number" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="location">Lokasi:</label>
                <input type="text" name="location" id="location" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="kamar_tidur">Total Kamar Tidur:</label>
                <input type="number" name="kamar_tidur" id="kamar_tidur" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="bathrooms">Total Kamar Mandi:</label>
                <input type="number" name="bathrooms" id="bathrooms" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tipe Properti:</label>
                <div class="flex items-center">
                    <label class="inline-flex items-center mr-4">
                        <input type="radio" name="type" value="rumah" class="form-radio text-indigo-600" checked>
                        <span class="ml-2">Rumah</span>
                    </label>
                    <label class="inline-flex items-center mr-4">
                        <input type="radio" name="type" value="villa" class="form-radio text-indigo-600">
                        <span class="ml-2">Villa</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="type" value="apartement" class="form-radio text-indigo-600">
                        <span class="ml-2">Apartemen</span>
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambah Properti</button>
        </form>
    </div>
</body>
</html>
