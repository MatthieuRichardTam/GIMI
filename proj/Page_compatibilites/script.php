<?php
    header("Content-Type: application/json");

    // Récupérer les données du POST
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $drug1 = $request->drug1;
    $drug2 = $request->drug2;

    // Pour cet exemple, nous allons simplement attribuer une valeur de compatibilité aléatoire.
    // Vous voudrez probablement remplacer cela par un code qui interroge votre base de données ou un autre mécanisme pour déterminer la compatibilité réelle.

    $compatibility = rand(0, 10);

    // Créer un objet de réponse
    $response = array(
        "compatibility" => $compatibility
    );

    // Renvoyer l'objet de réponse en tant que JSON
    echo json_encode($response);
?>


