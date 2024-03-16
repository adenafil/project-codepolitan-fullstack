<?php

// Total array yang disiapkan untuk di simpan
$todos = [];

// Membaca file todo.txt
$file = file_get_contents("todo.txt");
// Mengubah format serialize menjadi array
$todos = unserialize($file);

// cek apakah ada post method yang dikirim user

if (isset($_POST['todo'])) {
    $data = $_POST['todo'];
    $todos[] = [
        'todo' => $data,
        'status'=> 0
    ];
    $daftar_belanja = serialize($todos);
    file_put_contents('todo.txt', $daftar_belanja);
}

?>

<h1>Todo App</h1>
<form action="" method="POST">
    <label>Daftar Belanjar Hari Ini</label><br>
    <input type="text" name="todo">
    <button type="submit">Simpan</button>
</form>
<ul>
    <li>
        <input type="checkbox" name="todo">
        <label">Todo 1</label>
        <a href="#">hapus</a>
    </li>
    <li>
        <input type="checkbox" name="todo">
        <label>Todo 1</label>
        <a href="#">hapus</a>
    </li>
    <li>
        <input type="checkbox" name="todo">
        <label>Todo 1</label>
        <a href="#">hapus</a>
    </li>
</ul>