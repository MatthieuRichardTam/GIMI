<!DOCTYPE html>
<html>
<head>
    <title>Tableau de bord des alarmes</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #F0F0F0;
}


h1 {
    text-align: center;
    color: #456990;
}

.alarm-list {
    width: 80%;
    max-height: 500px;
    margin: 0 auto;
    overflow-y: auto;
}

.alarm {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    padding: 10px;
    background-color: #ffffff;
    border-radius: 5px;
    box-shadow: 0px 0px 10px 0px #000000;
}

.severity {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    margin-right: 10px;
}

.severe {
    background-color: red;
}

.moderate {
    background-color: yellow;
}

.minor {
    background-color: green;
}

.details h2 {
    margin: 0;
    margin-bottom: 5px;
    color: #456990;
}

.details p {
    margin: 0;
    color: #456990;
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
    <h1>Tableau de bord des alarmes</h1>
    <a href="compatibilite.php" class="button">Compatibilité</a>
    <div class="alarm-list">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hi";
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        //$coon = new PDO(
        //    'mysql:host=localhost;dbname=hi;charset=utf8',
        //    'root',
        //    ''
        //);
        // Vérifier la connexion
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, fullname, room, alarm_time, severity FROM alarmees";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // Afficher les données pour chaque alarme
          while($row = $result->fetch_assoc()) {
        ?>
        <div class="alarm">
            <div class="severity <?php echo $row['severity']; ?>"></div>
            <div class="details">
                <h2><?php echo $row['fullname']; ?></h2>
                <p>Chambre: <?php echo $row['room']; ?></p>
                <p>Temps restant avant l'alarme: <?php echo $row['alarm_time']; ?></p>
            </div>
        </div>
        <?php
          }
        } else {
          echo "Aucune alarme à afficher";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>