<!DOCTYPE html>
<html>
<head>
    <title>Compatibilité Injection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            margin: 0 auto;
            width: 50%;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        select {
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
            color: #007BFF;
            text-align: center;
        }
        textarea {
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 16px;
            margin-top: 10px;
        }

        .button {
    display: inline-block;
    padding: 8px 16px; /* Plus petit padding */
    font-size: 16px; /* Plus petite taille de police */
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    color: #fff;
    background-color: #6C757D; /* Gris */
    border: none;
    border-radius: 15px;
}

.button:hover {
    background-color: #5a6268; /* Gris un peu plus foncé lors du survol */
}

.button:active {
    background-color: #495057; /* Gris encore plus foncé lors du clic */
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Compatibilité Injection</h1>
        <a href="zeta.php" class="button">Retour au tableau de bord</a>
        <select id="drug1">
            <option value="AMIKIN_amikacine_sulf.">AMIKIN_amikacine_sulf.</option>
            <option value="daphalgan">daphalgan</option>
            <option value="sirop pour la toux">sirop pour la toux</option>
            <option value="aspirine">aspirine</option>
        </select>
        <select id="drug2">
            <option value="doliprane">doliprane</option>
            <option value="daphalgan">daphalgan</option>
            <option value="ACYCLOVIR">ACYCLOVIR</option>
            <option value="aspirine">dobutamine</option>
        </select>
        <button onclick="checkCompatibility()">Vérifier la compatibilité</button>
        <div class="result" id="result"></div>
        <div>
            <h2>Protocole d'injection</h2>
            <textarea id="protocol" rows="4" cols="50"></textarea>
        </div>
    </div>
    <script>
    function checkCompatibility() {
    var drug1 = document.getElementById('drug1').value;
    var drug2 = document.getElementById('drug2').value;

    fetch('insert_drugs.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            drug1: drug1,
            drug2: drug2
        })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('result').innerHTML = data.result;
    })
    .catch((error) => {
        console.error('Erreur:', error);
    });
}

    </script>
</body>
</html>