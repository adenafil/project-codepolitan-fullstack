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
        'status' => 0
    ];
    $daftar_belanja = serialize($todos);
    file_put_contents('todo.txt', $daftar_belanja);
    // Redirect halaman
    header('location:index.php');
}

if (isset($_GET['status'])) {
    // ubah status
    // $_GET['key']
    // key = index && status is index of key
    $todos[$_GET['key']]['status'] = $_GET['status'];
    $daftar_belanja = serialize($todos);
    file_put_contents('todo.txt', $daftar_belanja);
    // Redirect halaman
    header('location:index.php');
}

print_r($_GET);
?>

<h1>Todo App</h1>
<form action="" method="POST">
    <label>Daftar Belanjar Hari Ini</label><br>
    <input type="text" name="todo">
    <button type="submit">Simpan</button>
</form>
<ul>

    <?php foreach ($todos as $key => $value) { ?>

        <li>
            <input type="checkbox" onclick="window.location.href='index.php?status=<?= ($value['status'] == 1) ? '0' : '1' ?>&key=<?php echo $key; ?>'" name="todo" <?= ($value['status'] == 1) ? 'checked' : '' ?>>
            <label"><?= ($value['status'] == 1) ? "<del>" . $value['todo'] . "</del>" : $value['todo']  ?></label>
                <a href="#">hapus</a>
        </li>

    <?php } ?>
</ul>