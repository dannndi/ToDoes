<?php
require_once "connection_database.php";

$id = $_POST["id-card"];

try {

    $q = $database_connection->prepare("DELETE FROM `tb_todoes` WHERE id = ?");
    $result = $q->execute([$id]);
    if ($result) {
        header("Location: ../dashboard.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
