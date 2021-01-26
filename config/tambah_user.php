<?php
session_start();
require_once "connection_database.php";

$nama_lengkap = $_POST["nama_lengkap"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

if ($password != $confirm_password) {
    echo "<script type='text/javascript'>
    alert('Konfirmasi password tidak sesuai');
    window.location.replace('../signup.php');
    </script>";
} else {
    $q = $database_connection->prepare("INSERT INTO `tb_user` (`id`,`nama_lengkap`, `email`,
 `username`, `password`) VALUES (NULL, ?,?,?,SHA1(?));");
    $result = $q->execute([$nama_lengkap, $email, $username, $password]);
    if ($result) {
        $r = $database_connection->prepare("SELECT * FROM `tb_user` WHERE `email` = ? ;");
        $r->execute([$email]);
        $user = $r->fetchAll();
        echo var_dump($user);
        $_SESSION["userid"] = $user["id"];
        $_SESSION["username"] = $user["nama_lengkap"];
        $_SESSION["isLogin"] = true;
        header("Location: ../dashboard.php");
    } else {
        echo "<script type='text/javascript'>
        alert('Email telah di gunakan');
        window.location.replace('../signup.php');
        </script>";
    }
}
