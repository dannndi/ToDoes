<?php
session_start();
require_once "connection_database.php";
$userid = $_SESSION["userid"];
$title = $_POST["title"];
$desc = $_POST["desc"];
$datepicker = $_POST["datepicker"];

try {
    $time = strtotime($datepicker);
    $date = date('Y-m-d H:i:s', $time);

    $q = $database_connection->prepare("INSERT INTO `tb_todoes` (`id`,`id_user`, `title_todoes`,
     `des_todoes`, `date_todoes`) VALUES (NULL, ?,?,?,?);");
    $result = $q->execute([$userid, $title, $desc, $date]);
    if ($result) {
        header("Location: ../dashboard.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
