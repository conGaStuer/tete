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
                <video autoplay loop muted>
                    <source type="video/mp4" src="../assets/video_background.mp4">
                </video>
            </div>
            <div class="login-form">
                <div class="login-title">Haerin's Shop</div>
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <h4>Welcome to Haerin's  Shop</h4>
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
                    <input type="submit" value="Sign up" class="submit">
                    <div class="register-side">
                        <span>Have an Account?</span><a href="../Authen/login.php">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<?php
include("../Database/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username)) {
        echo "Please enter your username";
    } else if (empty($password)) {
        echo "Please enter your password";
    } else {
        try {
            // Create a new PDO instance
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);

            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO furnitures (username, password) VALUES (:username, :password)");

            // Bind parameters
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);

            // Execute the statement
            $stmt->execute();

            // Start the session
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;

            // Redirect to the home page
            header("Location: ../Views/Home.php");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the database connection
            $conn = null;
        }
    }
}
?>
