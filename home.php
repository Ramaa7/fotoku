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
    <title>Halaman Home</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        /* Container Style */
        .container {
            background: #ffffff;
            border-radius: 12px;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.6s ease-in-out;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #4e73df;
            margin-bottom: 20px;
        }

        .welcome-msg {
            font-size: 1.4rem;
            color: #333;
            margin-bottom: 30px;
            font-weight: 500;
        }

        /* Navigation Menu */
        ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        li {
            background-color: #4e73df;
            padding: 12px 30px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
            font-weight: 600;
        }

        li:hover {
            background-color: #224abe;
        }

        a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #f1f1f1;
        }

        /* Animation for container */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 25px;
            }

            h1 {
                font-size: 2rem;
            }

            .welcome-msg {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .welcome-msg {
                font-size: 1.1rem;
            }

            ul {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Halaman Home</h1>
        <p class="welcome-msg">Selamat datang, <b><?= $_SESSION['namalengkap'] ?></b> 🎉</p>

        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</body>

</html>