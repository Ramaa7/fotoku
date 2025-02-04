<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Foto</title>
    <style>
        /* Global styles */
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
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        h1 {
            font-size: 3rem;
            font-weight: 800;
            color: #2C3E50;
            margin-bottom: 30px;
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

        /* Form Styles */
        form {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            border: none;
        }

        form table {
            width: 100%;
        }

        form table td {
            padding: 15px;
        }

        form input[type="text"],
        form input[type="file"],
        form select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        form input[type="submit"] {
            padding: 12px 25px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.1rem;
        }

        form input[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Table Styles */
        table {
            width: 90%;
            margin-top: 30px;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            border: none;
        }

        table th,
        table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        table th {
            background-color: #3498db;
            color: white;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        table td {
            color: #555;
            font-size: 1rem;
        }

        table td img {
            max-width: 100px;
            height: auto;
            border-radius: 6px;
        }

        table td a {
            text-decoration: none;
            color: #3498db;
            padding: 8px 15px;
            border: 1px solid #3498db;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        table td a:hover {
            background-color: #3498db;
            color: white;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            form {
                width: 100%;
            }

            table {
                width: 100%;
                margin-top: 20px;
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
    <h1>Halaman Foto</h1>
    <p>Selamat datang <b><?= $_SESSION['namalengkap'] ?></b></p>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="album.php">Album</a></li>
        <li><a href="foto.php">Foto</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

    <form action="tambah_foto.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judulfoto" required></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="deskripsifoto" required></td>
            </tr>
            <tr>
                <td>Lokasi File</td>
                <td><input type="file" name="lokasifile" required></td>
            </tr>
            <tr>
                <td>Album</td>
                <td>
                    <select name="albumid" required>
                        <?php
                        include "koneksi.php";
                        $userid = $_SESSION['userid'];
                        $sql = mysqli_query($conn, "SELECT * FROM album WHERE userid='$userid'");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <option value="<?= $data['albumid'] ?>"><?= $data['namaalbum'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Tambah Foto"></td>
            </tr>
        </table>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tanggal Unggah</th>
            <th>Lokasi File</th>
            <th>Album</th>
            <th>Disukai</th>
            <th>Aksi</th>
        </tr>
        <?php
        include "koneksi.php";
        $userid = $_SESSION['userid'];
        $sql = mysqli_query($conn, "SELECT * FROM foto, album WHERE foto.userid='$userid' AND foto.albumid=album.albumid");
        while ($data = mysqli_fetch_array($sql)) {
        ?>
            <tr>
                <td><?= $data['fotoid'] ?></td>
                <td><?= $data['judulfoto'] ?></td>
                <td><?= $data['deskripsifoto'] ?></td>
                <td><?= $data['tanggalunggah'] ?></td>
                <td>
                    <img src="gambar/<?= $data['lokasifile'] ?>" alt="<?= $data['judulfoto'] ?>">
                </td>
                <td><?= $data['namaalbum'] ?></td>
                <td>
                    <?php
                    $fotoid = $data['fotoid'];
                    $sql2 = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($sql2);
                    ?>
                </td>
                <td>
                    <a href="hapus_foto.php?fotoid=<?= $data['fotoid'] ?>">Hapus</a>
                    <a href="edit_foto.php?fotoid=<?= $data['fotoid'] ?>">Edit</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>