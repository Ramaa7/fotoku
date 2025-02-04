<?php
session_start();
if (!isset($_SESSION['userid'])) {
?>
<?php
} else {
?>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* Reset and global styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #f4f7fc;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 30px;
        }

        h1 {
            font-size: 3rem;
            font-weight: 800;
            color: #2C3E50;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            font-size: 1.3rem;
            color: #7F8C8D;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Navigation styles */
        ul {
            list-style: none;
            padding: 0;
            margin-bottom: 40px;
            display: flex;
            gap: 20px;
        }

        li {
            display: inline;
        }

        a {
            text-decoration: none;
            padding: 12px 25px;
            background-color: white;
            color: #3498db;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        a:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        /* Gallery Styles */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            margin-top: 30px;
        }

        .gallery-item {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
        }

        .gallery-item-content {
            padding: 15px;
        }

        .gallery-item-content h3 {
            font-size: 1.2rem;
            color: #2C3E50;
            margin-bottom: 10px;
        }

        .gallery-item-content p {
            font-size: 0.9rem;
            color: #7F8C8D;
            margin-bottom: 15px;
        }

        .gallery-item-actions {
            display: flex;
            gap: 10px;
        }

        .gallery-item-actions a {
            text-decoration: none;
            padding: 8px 15px;
            background-color: #3498db;
            color: white;
            font-size: 0.9rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .gallery-item-actions a:hover {
            background-color: #2980b9;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            position: relative;
            max-width: 70%;
            max-height: 70%;
            background-color: white;
            border-radius: 12px;
            padding: 20px;
        }

        .modal-content img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .modal-content .actions {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .modal-content .actions a {
            text-decoration: none;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .modal-content .actions a:hover {
            background-color: #2980b9;
        }

        .modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 1.2rem;
            cursor: pointer;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.2rem;
            }

            .gallery {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }

            ul {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }

            a {
                padding: 10px 20px;
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <h1>Halaman Landing</h1>
    <?php
    if (!isset($_SESSION['userid'])) {
    ?>
        <ul>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    <?php
    } else {
    ?>
        <p>Selamat datang <b><?= $_SESSION['namalengkap'] ?></b></p>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="album.php">Album</a></li>
            <li><a href="foto.php">Foto</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    <?php
    }
    ?>

    <!-- Search Form -->
    <form method="get" action="" style="margin-bottom: 20px;">
        <input type="text" name="search" placeholder="Cari Judul Foto" style="padding: 8px; width: 300px; border-radius: 5px; border: 1px solid #ccc;">
        <button type="submit" style="padding: 8px 15px; background-color: #3498db; color: white; border: none; border-radius: 5px;">Cari</button>
    </form>

    <div class="gallery">
        <?php
        include "koneksi.php";

        // Handle search query
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql_query = "SELECT * FROM foto, user WHERE foto.userid = user.userid AND judulfoto LIKE '%$search%'";
        $sql = mysqli_query($conn, $sql_query);

        while ($data = mysqli_fetch_array($sql)) {
        ?>
            <div class="gallery-item">
                <img src="gambar/<?= $data['lokasifile'] ?>" alt="Foto" class="zoomable" />
                <div class="gallery-item-content">
                    <h3><?= $data['judulfoto'] ?></h3>
                    <p><?= $data['deskripsifoto'] ?></p>
                    <p><strong>Uploader:</strong> <?= $data['namalengkap'] ?></p>
                    <p><strong>Likes:</strong>
                        <?php
                        $fotoid = $data['fotoid'];
                        $sql2 = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                        echo mysqli_num_rows($sql2);
                        ?>
                    </p>
                    <div class="gallery-item-actions">
                        <a href="like.php?fotoid=<?= $data['fotoid'] ?>">Like</a>
                        <a href="komentar.php?fotoid=<?= $data['fotoid'] ?>">Komentar</a>
                        <a href="detail.php?fotoid=<?= $data['fotoid'] ?>">Detail</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="modal" id="modal">
        <div class="modal-content">
            <button class="modal-close">&times;</button>
            <img id="modal-image" src="" alt="Zoomed Foto">
            <div id="modal-detail"></div>
        </div>
    </div>

    <script>
        // Modal functionality
        const modal = document.getElementById('modal');
        const modalImage = document.getElementById('modal-image');
        const modalDetail = document.getElementById('modal-detail');
        const modalClose = document.querySelector('.modal-close');

        document.querySelectorAll('.zoomable').forEach(img => {
            img.addEventListener('click', () => {
                modal.style.display = 'flex';
                modalImage.src = img.src;
            });
        });

        modalClose.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</body>

</html>