<?php
session_start();
require_once "connection_database.php";

$email = $_POST["email"];
$password = $_POST["password"];

try {
    $result = $database_connection->prepare("SELECT * FROM `tb_user` WHERE `email` = ? ;");
    $result->execute([$email]);

    $count = $result->rowCount();

    if ($count == 1) {
        $data = $result->fetch();
        if (sha1($password) == $data["password"]) {
            $_SESSION["userid"] = $data["id"];
            $_SESSION["username"] = $data["nama_lengkap"];
            $_SESSION["isLogin"] = true;
            header("Location: ../dashboard.php");
            return;
        } else {
            echo "<script type='text/javascript'>
        alert('Password yang anda masukan tidak benar');
        window.location.replace('../signin.php');
        </script>";
        }
    } else {
        echo "<script type='text/javascript'>
        alert('Email tidak terdaftar');
        window.location.replace('../signin.php');
        </script>";
    }
} catch (PDOException $e) {
    $message =  $e->getMessage();
    echo "<script type='text/javascript'>
    alert('$message');
    window.location.replace('../signin.php');
    </script>";
}
