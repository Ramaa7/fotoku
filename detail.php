<?php
include "koneksi.php";

if (!isset($_GET['fotoid'])) {
    header("Location: index.php");
    exit();
}

$fotoid = $_GET['fotoid'];

// Ambil data foto dan user
$sql = mysqli_query($conn, "SELECT * FROM foto, user WHERE foto.userid = user.userid AND fotoid='$fotoid'");
$data = mysqli_fetch_array($sql);

if (!$data) {
    header("Location: index.php");
    exit();
}

// Hitung jumlah like
$userid_query = mysqli_query($conn, "SELECT COUNT(*) AS like_count FROM likefoto WHERE fotoid='$fotoid'");
$userid_data = mysqli_fetch_assoc($userid_query);
$userid_count = $userid_data['like_count'];

// Ambil komentar untuk foto
$isikomentar_query = mysqli_query($conn, "SELECT c.isikomentar, c.tanggalkomentar, u.namalengkap FROM komentarfoto c JOIN user u ON c.userid = u.userid WHERE c.fotoid='$fotoid'");
$komentarfoto = [];
while ($isikomentar = mysqli_fetch_assoc($isikomentar_query)) {
    $komentarfoto[] = $isikomentar;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Foto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 1.5em;
            color: #333;
            text-align: center;
            margin-top: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .foto-detail {
            text-align: center;
        }

        .foto-detail img {
            width: 70%;
            max-width: 500px;
            border-radius: 8px;
            margin-top: 15px;
            cursor: pointer;
        }

        .uploader {
            font-size: 1em;
            margin-top: 8px;
            color: #555;
        }

        .like-info {
            font-size: 1em;
            color: #888;
            margin-top: 15px;
        }

        .komentarfoto {
            margin-top: 20px;
        }

        .komentarfoto h3 {
            font-size: 1.2em;
            color: #333;
        }

        .komentar-item {
            background-color: #f1f1f1;
            padding: 8px;
            margin-bottom: 8px;
            border-radius: 8px;
        }

        .komentar-item b {
            color: #555;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        a:hover {
            background-color: #0056b3;
        }

        .social-share {
            margin-top: 20px;
            text-align: center;
        }

        .social-share a {
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #25d366;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .social-share a.facebook {
            background-color: #3b5998;
        }

        .social-share a.instagram {
            background-color: #e1306c;
        }

        .social-share a:hover {
            opacity: 0.8;
        }

        .download-btn {
            display: block;
            margin-top: 15px;
            padding: 8px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        .download-btn:hover {
            background-color: #218838;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            max-width: 90%;
            max-height: 80%;
            margin: auto;
            display: block;
            border-radius: 8px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 25px;
            color: #f1f1f1;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Judul: <?= $data['judulfoto'] ?></h1>
        <p>
        <h3>Deskripsi:</h3> <?= $data['deskripsifoto'] ?></p>

        <div class="foto-detail">
            <img id="myImg" src="gambar/<?= $data['lokasifile'] ?>" alt="<?= $data['judulfoto'] ?>">
            <p class="uploader">Uploader: <b><?= $data['namalengkap'] ?></b></p>
            <p class="uploader">Tanggal Upload: <b><?= $data['tanggalunggah'] ?></b></p>
        </div>

        <!-- Menampilkan jumlah like -->
        <p class="like-info">Jumlah Like: <b><?= $userid_count ?></b></p>

        <!-- Menampilkan komentar -->
        <div class="komentarfoto">
            <h3>Komentar:</h3>
            <?php if (empty($komentarfoto)) { ?>
                <p>Belum ada komentar.</p>
            <?php } else { ?>
                <?php foreach ($komentarfoto as $isikomentar) { ?>
                    <div class="komentar-item">
                        <p><b><?= $isikomentar['namalengkap'] ?>:</b> <?= $isikomentar['isikomentar'] ?></p>
                        <p><i>Tanggal Komentar: <?= $isikomentar['tanggalkomentar'] ?></i></p>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>

        <!-- Social Share Buttons -->
        <div class="social-share">
            <a href="https://wa.me/?text=<?= urlencode('Check out this photo: ' . $data['judulfoto'] . ' - ' . 'http://yourwebsite.com/path/to/foto.php?fotoid=' . $fotoid) ?>" target="_blank">Share on WhatsApp</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=http://yourwebsite.com/path/to/foto.php?fotoid=<?= $fotoid ?>" class="facebook" target="_blank">Share on Facebook</a>
            <a href="https://www.instagram.com/?url=http://yourwebsite.com/path/to/foto.php?fotoid=<?= $fotoid ?>" class="instagram" target="_blank">Share on Instagram</a>
        </div>

        <!-- Download Button -->
        <a href="gambar/<?= $data['lokasifile'] ?>" class="download-btn" download>Download Foto</a>

        <a href="index.php">Kembali</a>
    </div>

    <!-- Modal for Enlarged Image -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
    </div>

    <script>
        // Modal Image Functionality
        var modal = document.getElementById("myModal");
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var span = document.getElementsByClassName("close")[0];

        img.onclick = function() {
            modal.style.display = "flex";
            modalImg.src = this.src;
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        // Close modal if clicked outside of the image
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>