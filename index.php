<?php
// Memasukkan file yang diperlukan
require 'data.php';
require 'functions.php';

// Tangani aksi dari form (POST/GET)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_GET["action"] ?? "";
    $id = $_GET["id"] ?? "";

    if ($action === "toggle") {
        // Mengubah status tugas (selesai atau belum)
        ubahStatusTugas($tasks, $id);
    } elseif ($action === "delete") {
        // Menghapus tugas berdasarkan ID
        hapusTugas($tasks, $id);
    } elseif (isset($_POST["title"])) {
        // Menambah tugas baru
        tambahTugas($tasks, htmlspecialchars(trim($_POST["title"])));
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">To-Do List</h1>

    <!-- Form Tambah Tugas -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="post" action="">
                <div class="input-group">
                    <input type="text" class="form-control" name="title" placeholder="Tambahkan tugas baru" required>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Tugas -->
    <h3>Daftar Tugas</h3>
    <ul class="list-group">
        <?php tampilkanDaftar($tasks); ?>
    </ul>
</div>
</body>
</html>
