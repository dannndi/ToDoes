<?php
session_start();
require_once "connection_database.php";
$id = $_SESSION["userid"];
$nama_lengkap = $_POST["nama_lengkap"];
$username = $_POST["username"];
$old_password = $_POST["old-password"];
$new_password = $_POST["new-password"];
$confirm_new_password = $_POST["confirm-new-password"];

$result = $database_connection->prepare("SELECT * FROM `tb_user` WHERE `id` = ? ;");
$result->execute([$id]);
$data = $result->fetch();

if (sha1($old_password) != $data["password"]) {
    echo "<script type='text/javascript'>
    alert('Salah memasukan password lama');
    window.location.replace('../profile.php');
    </script>";
} else if ($new_password != $confirm_new_password) {
    echo "<script type='text/javascript'>
    alert('New password dan Confirmasi password tidak sama');
    window.location.replace('../profile.php');
    </script>";
} else if ($new_password == "" && $confirm_new_password == "") {
    $q = $database_connection->prepare("UPDATE `tb_user` SET `nama_lengkap` = ?, `username` = ? WHERE `id` = ? ;");
    $result = $q->execute([$nama_lengkap, $username, $id]);
    if ($result) {
        $_SESSION["username"] = $nama_lengkap;
        header("Location: ../dashboard.php");
    } else {
        echo "<script type='text/javascript'>
        alert('Gagal edit profile');
        window.location.replace('../profile.php');
        </script>";
    }
} else {
    $q = $database_connection->prepare("UPDATE `tb_user` SET `nama_lengkap` = ?, `username` = ?,`password` = SHA1(?) WHERE `id` = ? ;");
    $result = $q->execute([$nama_lengkap, $username, $new_password, $id]);
    if ($result) {
        $_SESSION["username"] = $nama_lengkap;
        header("Location: ../dashboard.php");
    } else {
        echo "<script type='text/javascript'>
        alert('Gagal edit profile');
        window.location.replace('../profile.php');
        </script>";
    }
}
