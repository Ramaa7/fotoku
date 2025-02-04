<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #4e73df, #224abe);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            color: #fff;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
            color: #fff;
        }

        /* Login Container */
        .login-container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            max-width: 420px;
            width: 100%;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        }

        .login-container h2 {
            color: #4e73df;
            font-size: 1.5rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .login-container input {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            background-color: #f8f9fc;
            transition: all 0.3s;
        }

        .login-container input:focus {
            border-color: #4e73df;
            background-color: #fff;
            outline: none;
        }

        .login-container input[type="submit"] {
            background-color: #4e73df;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
            transition: all 0.3s;
            font-weight: 600;
            border-radius: 8px;
        }

        .login-container input[type="submit"]:hover {
            background-color: #224abe;
        }

        .login-container .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-container .register-link a {
            color: #4e73df;
            text-decoration: none;
            font-weight: 600;
        }

        .login-container .register-link a:hover {
            text-decoration: underline;
        }

        /* Animation Effects */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container {
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                padding: 30px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            h1 {
                font-size: 2rem;
            }

            .login-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Halaman Login</h1>
        <h2>Silakan Login</h2>
        <form action="proses_login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <div class="register-link">
            <p><a href="register.php">Register di sini</a></p>
        </div>
    </div>
</body>

</html>