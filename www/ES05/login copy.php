<?php
session_start();

$self=$_SERVER["PHP_SELF"];
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

//Recuperodati
$is_post_req= $_SERVER["REQUEST_METHOD"] == "POST";
$is_user_logged = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";

//per debug
echo "-" . $is_post_req . "-" . $is_user_logged . "-" . $username . "-" . $password;

// Verifica se l'utente è già autenticato
if ($is_user_logged) {
    $html_logged = "Login già effettuato.";
    $html_logged .= "<br><a href='welcome.php'>Benvenuto</a><br>";
    $html_logged .= "<a href='logout.php'>Logout</a>";
}
$html_logged = "Login già effettuato.";
$html_logged .= "<br><a href='welcome.php'>Benvenuto</a><br>";
$html_logged .= "<a href='logout.php'>Logout</a>";



// Verifica se sono stati inviati dati dal modulo di login
if (sdgf) {
    // Connessione al database
    $servername = "localhost";
    $username = "Golzi"; // Inserire il proprio username
    $password = "1234"; // Inserire la propria password
    $dbname = "ES05"; // Inserire il nome del proprio database

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica della connessione
    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }

    // Prendi i dati dal modulo di login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query per verificare se l'utente esiste nel database
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // L'utente esiste, impostare la variabile di sessione
        $_SESSION['logged_in'] = true;
        echo "Login avvenuto con successo.<br>";
        echo "<a href='welcome.php'>Benvenuto</a><br>";
        echo "<a href='logout.php'>Logout</a>";
    } else {
        echo "Username o password non validi.";
    }

    // Chiudi la connessione
    $conn->close();
}



$html = $html_logged;
$html .= $html_form;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?=$html?>
</body>
</html>