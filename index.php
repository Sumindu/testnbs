<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="loginStyle.css">
</head>
<body>
    <div class="wrapper">
        <form action="index.php" method="post">
            <h1>Login</h1>
            <!-- alerts -->
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    // Perform authentication logic here
                    // Replace the following code with your authentication logic
                    if ($username === "admin" && $password === "admin") {
                        echo "<div class='alert alert-success'>Login successful!</div>";
                        header("Location: home.php");
                        exit();
                    } else {
                        echo "<p class='error'>Invalid username or password.</p>";
                    }
                }
            ?>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" 
                required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" 
                required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="remember-forget">
            </div>
            <button name="submit" type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>