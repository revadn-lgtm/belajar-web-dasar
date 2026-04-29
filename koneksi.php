<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'db_reva';

mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect($host, $user, $password);
if (!$conn) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

// Buat database jika belum ada, lalu pilih database
if (!mysqli_select_db($conn, $database)) {
    $createDbSql = "CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    if (!mysqli_query($conn, $createDbSql)) {
        die('Gagal membuat database: ' . mysqli_error($conn));
    }
    if (!mysqli_select_db($conn, $database)) {
        die('Gagal memilih database: ' . mysqli_error($conn));
    }
}

// Buat tabel untuk menyimpan data formulir jika belum ada
$tableSql = "CREATE TABLE IF NOT EXISTS `form_data` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `nama` VARCHAR(150) NOT NULL,
    `nomor` VARCHAR(50) DEFAULT NULL,
    `tanggal` DATE DEFAULT NULL,
    `waktu` TIME DEFAULT NULL,
    `warna` VARCHAR(7) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

mysqli_query($conn, $tableSql);
