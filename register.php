<?php
session_start();
include 'config/db.php';

if(isset($_POST['daftar'])){
    $wa = $_POST['wa'];
    $pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);

    // cek kalau nomor sudah ada
    $cek = mysqli_query($conn,"SELECT * FROM users WHERE no_wa='$wa'");
    if(mysqli_num_rows($cek) > 0){
        echo "Nomor sudah terdaftar!";
    } else {
        mysqli_query($conn,"INSERT INTO users VALUES(NULL,'$wa','$pw')");
        $id = mysqli_insert_id($conn); // ambil id user terakhir

$_SESSION['user'] = $id;

header("Location: index.php");
exit;
    }
}
?>

<h2>Register</h2>

<form method="POST">
No WhatsApp:<br>
<input name="wa" required><br><br>

Password:<br>
<input name="pw" type="password" maxlength="5" required><br><br>

<button name="daftar">Daftar</button>
</form>