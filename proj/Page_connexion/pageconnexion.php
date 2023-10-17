
<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <style>
    body {
    background-color: #34a7a1;
    font-family: Arial, sans-serif;
}

.login-container {
    width: 300px;
    margin: 0 auto;
    margin-top: 100px;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0px 0px 10px 0px #000000;
    border-radius: 15px;
}

.logo {
    width: 100px;  
    height: auto;  
}

.logo-container {
    display: flex;
    justify-content: center;
    margin-bottom: 15px;
}

.logo-container img {
    width: 80px;
    height: 80px;
    
}

h1 {
    text-align: center;
    color: #34a7a1;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-top: 10px;
    color: #34a7a1;
}

input {
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #34a7a1;
}

button {
    margin-top: 20px;
    padding: 10px;
    background-color: #34a7a1;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #288e8a;
}
    </style>
</head>
<body>
<div id="login-container">
        <form method="POST">
            <img class="logo" src="logo.png" alt="Logo">
            <h2>Se connecter</h2>
            <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            <input type="submit" value="Se connecter">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "hi";

            // Créer la connexion
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Vérifier la connexion
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            // Récupérez les informations de l'utilisateur à partir du formulaire
            $username = $_POST['username'];
            $password = $_POST['password']; 

            // Créez une requête SQL pour récupérer l'utilisateur avec ce nom d'utilisateur et ce mot de passe
            $sql = "SELECT * FROM userss WHERE username = '$username' AND password = '$password'";

            // Exécutez la requête
            $result = $conn->query($sql);

            // Vérifiez si un utilisateur correspond
            if ($result->num_rows > 0) {
                // Redirige vers la page "Tableau de bord des alarmes"
                header("Location: ../Page_alarmes/notification.php");
                exit();
            } else {
                echo "Échec de la connexion";
            }
            $conn->close();
        }
    ?>
    </div>
    
</body>
</html>