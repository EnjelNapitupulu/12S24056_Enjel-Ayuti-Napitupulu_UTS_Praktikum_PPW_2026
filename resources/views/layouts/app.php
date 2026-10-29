<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DEL-LEATS - Native PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <nav class="bg-white shadow p-4 flex justify-between max-w-7xl mx-auto">
        <div class="font-bold text-xl text-blue-600">DEL-LEATS</div>
        <div class="space-x-4">
            <a href="index.php?page=equipments" class="hover:text-blue-600">Katalog Aset</a>
            <a href="index.php?page=equipments&action=create" class="hover:text-blue-600">Tambah Aset</a>
            <a href="index.php?page=loans&action=create" class="hover:text-blue-600">Ajukan Pinjam</a>
        </div>
    </nav>
    <div class="max-w-7xl mx-auto p-6">
        <?php if(isset($_GET['success'])): ?>
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">[SUKSES] Aksi berhasil dilakukan!</div>
        <?php endif; ?>
        
        
    </div>
</body>
</html>
