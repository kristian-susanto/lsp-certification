<?php
// Menampilkan daftar tugas
function tampilkanDaftar($tasks) {
    // Loop untuk setiap tugas dan menampilkannya
    foreach ($tasks as $task) {
        // Cek apakah tugas sudah selesai atau belum
        $isChecked = $task["status"] === "selesai" ? "checked" : "";
        $textClass = $task["status"] === "selesai" ? "text-decoration-line-through text-muted" : "";

        // Menampilkan tugas dengan checkbox dan tombol hapus
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
        echo "<form method='post' class='d-flex align-items-center w-100' action='?action=toggle&id={$task['id']}'>";
        echo "<input type='checkbox' class='form-check-input me-2' onchange='this.form.submit()' $isChecked>";
        echo "<span class='flex-grow-1 $textClass'>{$task['title']}</span>";
        echo "</form>";
        echo "<form method='post' action='?action=delete&id={$task['id']}' onsubmit='return confirm(\"Hapus tugas ini?\")'>";
        echo "<button class='btn btn-sm btn-danger'>Hapus</button>";
        echo "</form>";
        echo "</li>";
    }
}

// Menambahkan tugas baru ke dalam daftar tugas.
function tambahTugas(&$tasks, $title) {
    // Membuat ID baru berdasarkan ID terakhir yang ada
    $idBaru = end($tasks)["id"] + 1;
    // Menambahkan tugas baru ke array
    $tasks[] = ["id" => $idBaru, "title" => $title, "status" => "belum"];
}

// Mengubah status tugas menjadi selesai atau kembali ke belum.
function ubahStatusTugas(&$tasks, $id) {
    foreach ($tasks as &$task) {
        if ($task["id"] == $id) {
            // // Toggle status antara 'belum' dan 'selesai'
            $task["status"] = $task["status"] === "belum" ? "selesai" : "belum";
            break;
        }
    }
}

// Menghapus tugas berdasarkan ID dari daftar tugas.
function hapusTugas(&$tasks, $id) {
    foreach ($tasks as $i => $task) {
        if ($task["id"] == $id) {
            // // Menghapus tugas berdasarkan index
            array_splice($tasks, $i, 1);
            break;
        }
    }
}
