<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Connect to BDD
    $conn = new mysqli('localhost', 'root', 'root', 'Reseau.So');

    // check connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("SELECT * FROM users WHERE login_users = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        
        $user = $result->fetch_assoc();

        
        if (password_verify($password, $user['password_users'])) {
            echo "Connexion réussie!";
        } else {
            echo "Login ou mot de passe incorrect.";
        }
    } else {
        echo "Login ou mot de passe incorrect.";
    }

    // session close
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Page Login</title>
</head>
<body>
    <h1 class="centered">Connectez vous</h1>
    <div class="container">
    <form method="POST">
        <label for="login">Login:</label>
        <input id="login" name="login" placeholder="Votre Login" type="text" required>
        <br>
        <label for="password">Mot de passe:</label>
        <input id="password" name="password" placeholder="Mot de passe" type="password" required>
        <br>
        <button type="submit">Send</button>    
    </form>
    </div>
</body>
</html>