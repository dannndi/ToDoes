<?php
require_once 'connection_database.php';
$userid =  $_SESSION["userid"];

try {
    $sql = 'SELECT * FROM `tb_todoes` WHERE id_user = ? ORDER BY date_todoes ASC';
    $q = $database_connection->prepare($sql);
    $q->execute([$userid]);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Tidak Bisa Membuka Database $database_name :" . $e->getMessage());
}
