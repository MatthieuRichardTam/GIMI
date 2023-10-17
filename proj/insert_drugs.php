
<?php
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents('php://input'), true);

    $drug1 = $data['drug1'];
    $drug2 = $data['drug2'];

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

    // Préparer la requête SQL pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO mytable (drug1, drug2) VALUES (?, ?)");
    $stmt->bind_param("ss", $drug1, $drug2);

    // Exécuter la requête SQL
    $stmt->execute();

    // Supposons que le résultat que vous voulez renvoyer est stocké dans une table nommée result_table, et la colonne du résultat est nommée result_column
    $resultQuery = "SELECT result_column FROM result_table ORDER BY id DESC LIMIT 1"; // This query gets the latest result
    $result = $conn->query($resultQuery);

    $latestResult = null;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $latestResult = $row["result_column"];
        }
    } 

    // Fermer la requête et la connexion
    $stmt->close();
    $conn->close();

    echo json_encode(array('status' => 'success', 'result' => $latestResult));
?>


