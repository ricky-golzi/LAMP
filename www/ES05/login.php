<?php
session_start();

// Costanti per la connessione al database
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'ES05_user');
define('DB_PASSWORD', 'mia_password');
define('DB_NAME', 'ES05');

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
$login_passed = false;

//per debug
echo "-" . $is_post_req . "-" . $is_user_logged . "-" . $username . "-" . $password;

// Verifica se sono stati inviati dati dal modulo di login
if ($is_post_req) {
    // Connessione al database
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // Verifica della connessione
    if (!$conn) {die("Connessione fallita: " . mysqli_connect_error());}

    echo "Connessione al database riuscita";
    // ... Puoi eseguire le tue query qui ...

    // Chiudere la connessione quando non è più necessaria
    mysqli_close($conn);

    // Query per verificare se l'utente esiste nel database
    $sql = "SELECT * FROM utente WHERE Username = '$username' AND Password = '$password'";
    $result = mysqli_query($conn, $query);
    // Verifica se la query ha restituito risultati
    if (mysqli_num_rows($result) > 0) {
        echo "Login riuscito. Benvenuto!"; // L'utente è autenticato con successo
        // L'utente esiste, impostare la variabile di sessione
        $_SESSION['logged_in'] = true;
        $html_login = "Login avvenuto con successo.<br>";
        $html_login .= "<a href='welcome.php'>Benvenuto</a><br>";
        $html_login .= "<a href='logout.php'>Logout</a>";
        $login_passed = true;
    } else {
        $html_login = "Username o password non validi.";
    }
}


// Verifica se l'utente è già autenticato
if ($is_user_logged) {
    $html_logged = "Login già effettuato.";
    $html_logged .= "<br><a href='welcome.php'>Benvenuto</a><br>";
    $html_logged .= "<a href='logout.php'>Logout</a>";
}
$html_logged = "Login già effettuato.";
$html_logged .= "<br><a href='welcome.php'>Benvenuto</a><br>";
$html_logged .= "<a href='logout.php'>Logout</a>";

if($is_post_req && $login_passed) {
    $html = $html_login;
} else {
    $html .= $html_form;
    $html .= $html_login;
}

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