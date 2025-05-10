<?php
// // Memulai session untuk menyimpan data tugas
session_start();

// Mengecek apakah data tugas sudah ada di session atau menampilkan default
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [
        ["id" => 1, "title" => "Belajar PHP", "status" => "belum"],
        ["id" => 2, "title" => "Kerjakan tugas UX", "status" => "selesai"],
    ];
}

// // Mempermudah manipulasi data tugas yang disimpan dalam session
$tasks = &$_SESSION['tasks'];
