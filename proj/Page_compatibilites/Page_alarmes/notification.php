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
    width: 60%;
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


.notification {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #dddddd;
        border-radius: 5px;
        box-shadow: 0px 0px 5px 0px #aaaaaa;
}

.notification-container {
        position: fixed;
        right: 0;
        top: 0;
        width: 200px;
        height: 100%;
        overflow-y: auto;
        background-color: #f8f9fa;
        padding: 20px;
        box-shadow: -2px 0px 5px 0px rgba(0,0,0,0.1);
}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <h1>Tableau de bord des alarmes</h1>

    <a href="../Page_compatibilites/compatibilite.php" class="button">Compatibilité</a>

    <!-- Ajoutez le container pour la barre de notification -->
    <div class="notification-container">
        <h2>Notifications</h2>
        <div id="notifications">
            <!-- Les notifications seront générées dynamiquement ici -->
        </div>
    </div>

    <script>
    function refreshNotifications() {
        $.ajax({
            url: 'scriptnotif.php',
            type: 'get',
            dataType: 'json',
            success: function(data) {
                var notificationsDiv = $('#notifications');
                notificationsDiv.empty();
                data.forEach(function(notification) {
                    notificationsDiv.append(
                        '<div class="notification">' +
                            '<p>Nom: ' + notification.fullname + '</p>' +
                            '<p>Chambre: ' + notification.room + '</p>' +
                            '<p>Temps restant: ' + notification.remaining_time + ' secondes</p>' +
                        '</div>'
                    );
                });
            },
            error: function(request, status, error) {
                console.error('Error fetching notifications:', status, error);
            }
        });
    }

        // Rafraîchir les notifications toutes les 10 secondes
        setInterval(refreshNotifications, 10000);
        // Appel initial pour charger les notifications dès le chargement de la page
        refreshNotifications();
    </script>

    <div class="alarm-list" id="alarmList">
            <!-- Le contenu de cette liste sera généré dynamiquement -->
    </div>

        <script>
        function updateAlarms() {
            fetch('get_alarms.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('alarmList').innerHTML = data;
                });
        }

        // Appeler la fonction une fois au début
        updateAlarms();

        // Puis appeler la fonction toutes les 10 secondes
        setInterval(updateAlarms, 10000);
        </script>

<!-- Ajoutez votre code JavaScript pour gérer les notifications ici -->

</body>
</html>
