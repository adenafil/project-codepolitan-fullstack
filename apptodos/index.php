<?php

// Total array yang disiapkan untuk di simpan
$todos = [];

//melakukan pengecekan apakah file todo.txt ditemukan
if(file_exists('todo.txt'))
{
	//membaca file todo.txt
	$file	=	file_get_contents('todo.txt');
	//mengubah format serialize menjadi array
	$todos	=	unserialize($file);
	
}
// cek apakah ada post method yang dikirim user

if (isset($_POST['todo'])) {
    $data = $_POST['todo'];
    $todos[] = [
        'todo' => $data,
        'status' => 0
    ];
    $daftar_belanja = serialize($todos);
    simpanData($daftar_belanja);
}

if (isset($_GET['status'])) {
    // ubah status
    // $_GET['key']
    // key = index && status is index of key
    $todos[$_GET['key']]['status'] = $_GET['status'];
    $daftar_belanja = serialize($todos);
    simpanData($daftar_belanja);
}

if (isset($_GET['hapus'])) {
    // Hapus data sesuai key yang dipilih
    unset($todos[$_GET['key']]);
    $daftar_belanja = serialize($todos);
    simpanData($daftar_belanja);
}

function simpanData($daftar_belanja) {
    file_put_contents('todo.txt', $daftar_belanja);
    // redirec halaman
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
                <a href="
                index.php?hapus=1&key=<?= $key?>
                " onclick="return confirm('Apakah ANda Yakin Akan Menghapus Data Ini ?')">hapus</a>
        </li>

    <?php } ?>
</ul>