<?php
session_start();

//Recuperodati
$is_post_req= $_SERVER["REQUEST_METHOD"] == "POST";
$is_user_logged = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";

//per debug
echo "-" . $is_post_req . "-" . $is_user_logged . "-" . $username . "-" . $password;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
    <br>
    <a href="register.php">Registrati</a><br>
    <a href="reset_password.php">Resetta password</a>
</body>
</html>