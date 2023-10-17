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
    padding: 8px 16px; 
    font-size: 16px; 
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    color: #fff;
    background-color: #6C757D; 
    border: none;
    border-radius: 15px;
}

.button:hover {
    background-color: #5a6268; 
}

.button:active {
    background-color: #495057; 
}
    </style>


</head>
<body>
    <div class="container">
        <h1>Compatibilité Injection</h1>
        <a href="../Page_alarmes/notification.php" class="button">Retour au tableau de bord</a>
        <select id="drug1">
            <option value="ACYCLOVIR">ACYCLOVIR</option>
            <option value="CEFUROXIME">CEFUROXIME</option>
            <option value="MEROPENEM">MEROPENEM</option>
            <option value="GLUCOSALIN">GLUCOSALIN</option>
        </select>
        <select id="drug2">
            <option value="ACYCLOVIR">ACYCLOVIR</option>
            <option value="CEFUROXIME">CEFUROXIME</option>
            <option value="MEROPENEM">MEROPENEM</option>
            <option value="GLUCOSALIN">GLUCOSALIN</option>
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
            
            
    fetch('script.php', {
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
        document.getElementById('result').innerHTML = 'Résultat de compatibilité: ' + data.compatibility + '/10';
    })
    .catch((error) => {
        console.error('Erreur:', error);
    });
}
    </script>
</body>
</html>

