<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "todolist");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

// Tambah tugas
if (isset($_POST['tambah'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $conn->query("INSERT INTO tasks (title) VALUES ('$title')");
}

// Ubah status
if (isset($_POST['ubah_status'])) {
    $id = intval($_POST['ubah_status']);
    $result = $conn->query("SELECT status FROM tasks WHERE id = $id");
    $row = $result->fetch_assoc();
    $newStatus = ($row['status'] === 'belum') ? 'selesai' : 'belum';
    $conn->query("UPDATE tasks SET status='$newStatus' WHERE id=$id");
}

// Hapus tugas
if (isset($_POST['hapus'])) {
    $id = intval($_POST['hapus']);
    $conn->query("DELETE FROM tasks WHERE id=$id");
}

// Ambil semua tugas
$tasks = $conn->query("SELECT * FROM tasks ORDER BY id DESC");

function tampilkanDaftar($tasks)
{
    while ($task = $tasks->fetch_assoc()) {
        $checked = $task['status'] === 'selesai' ? 'checked' : '';
        $style = $task['status'] === 'selesai' ? 'text-decoration: line-through;' : '';
        echo <<<HTML
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <form method="POST" class="d-flex align-items-center w-100">
                <input type="hidden" name="ubah_status" value="{$task['id']}">
                <input type="checkbox" class="form-check-input me-2" onchange="this.form.submit()" {$checked}>
                <span class="flex-grow-1" style="$style">{$task['title']}</span>
            </form>
            <form method="POST" class="ms-2">
                <!-- Status -->
                <input type="hidden" name="hapus" value="{$task['id']}">
                <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </li>
HTML;
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
<body class="bg-light">
<div class="container py-5">
    <h1 class="mb-4 text-center">To-Do List</h1>

    <form method="POST" class="mb-4 d-flex">
        <input type="text" name="title" class="form-control me-2" placeholder="Tambahkan tugas baru..." required>
        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
    </form>

    <ul class="list-group">
        <?php tampilkanDaftar($tasks); ?>
    </ul>
</div>
</body>
</html>
