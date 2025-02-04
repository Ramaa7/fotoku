<?php
include "koneksi.php";
session_start();

if (!isset($_SESSION['userid'])) {
    // Untuk bisa like harus login dulu
    header("location:index.php");
    exit;
} else {
    $fotoid = $_GET['fotoid'];
    $userid = $_SESSION['userid'];

    // Cek apakah user sudah pernah like foto ini atau belum
    $sql = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

    if (mysqli_num_rows($sql) == 1) {
        // Jika user sudah pernah like, hapus like (unlike)
        mysqli_query($conn, "DELETE FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
    } else {
        // Jika user belum pernah like, tambahkan like
        $tanggallike = date("Y-m-d");
        mysqli_query($conn, "INSERT INTO likefoto VALUES('', '$fotoid', '$userid', '$tanggallike')");
    }

    // Redirect ke halaman utama
    header("location:index.php");
    exit;
}
