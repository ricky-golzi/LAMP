<?php
session_start();

// Costanti per la connessione al database
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'ES05_user');
define('DB_PASSWORD', 'mia_password');
define('DB_NAME', 'ES05');

$self = $_SERVER["PHP_SELF"];

// Definizione del form HTML
$html_form = <<<FORM
    <form action="$self" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
    <br>
    <a href="register.php">Registrati</a><br>
    <a href="reset_password.php">Resetta password</a>
FORM;

// Connessione al database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verifica della connessione
if (!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}

// Verifica se sono stati inviati dati dal modulo di login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";

    // Query per verificare se l'utente esiste nel database
    $sql = "SELECT Username, Password FROM utente WHERE Username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) == 1) {
        mysqli_stmt_bind_result($stmt, $db_username, $db_password);
        mysqli_stmt_fetch($stmt);
        if (password_verify($password, $db_password)) {
            $_SESSION['logged_in'] = true;
            echo "Login riuscito. Benvenuto!";
            // Redirect o altre azioni dopo il login
            exit();
        } else {
            echo "Password errata.";
        }
    } else {
        echo "Utente non trovato.";
    }
}

// Chiudere la connessione quando non è più necessaria
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>LOGIN-Golzi</title>
</head>
<body>
    <h2>LOGIN-Golzi</h2>
    <?php echo $html_form; ?>
</body>
</html>