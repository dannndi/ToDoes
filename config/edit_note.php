<?php
require_once "connection_database.php";

$id = $_POST["id-card"];
$title = $_POST["title"];
$desc = $_POST["desc"];
$datepicker = $_POST["datepicker"];

try {
    $time = strtotime($datepicker);
    $date = date('Y-m-d H:i:s', $time);

    $q = $database_connection->prepare("UPDATE `tb_todoes` SET `title_todoes` = ?,
     `des_todoes`=?, `date_todoes`=? WHERE id = ?");
    $result = $q->execute([$title, $desc, $date, $id]);
    if ($result) {
        header("Location: ../dashboard.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
