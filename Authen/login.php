<?php
include("../Database/database.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque&family=Cabin:wght@500&family=Josefin+Sans&family=Lato&family=Montserrat&family=Odibee+Sans&family=Pixelify+Sans&family=Tilt+Neon&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <section class="container">
        <div class="login-container">
            <div class="login-background">
                <video autoplay loop muted >
                    <source type="video/mp4" src="../assets/video_background.mp4">
                </video>
            </div>
            <div class="login-form">
                <div class="login-title">Haerin's Shop</div>
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <h4>Welcome to Haerin's Shop</h4>
                    <div class="login-side">
                        <div class="login-input">
                            <span>Username</span>
                            <input type="text" name="username" id="">
                        </div>
                        <div class="login-input">
                            <span>Password</span>
                            <input type="password" name="password" id="">
                        </div>
                    </div>
                    <input type="submit" value="Sign in" class="submit">
                    <div class="register-side">
                        <span>New Haerin's member?</span><a href="../Authen/register.php">Create Account</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        // Prepare the SQL statement
        $sql = "SELECT * FROM furnitures WHERE username = :username AND password = :password";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        // Execute the statement
        $stmt->execute();

        // Fetch the result
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($rows) {
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            header("Location: ../Views/Home.php");
        } else {
            echo "<span class='error'>Wrong username or password!!</span>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
