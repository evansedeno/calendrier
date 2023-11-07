<?php
// Gérer le stockage des événements en session pour l'exemple
session_start();
if (!isset($_SESSION['events'])) {
    $_SESSION['events'] = [];
}

// Ajouter un événement
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['event_name']) && isset($_POST['event_date'])) {
    $eventName = strip_tags($_POST['event_name']);
    $eventDate = DateTime::createFromFormat('Y-m-d', $_POST['event_date']);
    if ($eventDate) {
        // Ajouter l'événement
        $_SESSION['events'][] = ['name' => $eventName, 'date' => $eventDate->format('Y-m-d')];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier d'événements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .event-form {
            margin-bottom: 20px;
        }
        .event-list {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="event-form">
    <form action="calendar.php" method="post">
        <input type="text" name="event_name" placeholder="Nom de l'événement" required>
        <input type="date" name="event_date" required>
        <button type="submit">Ajouter l'événement</button>
    </form>
</div>

<div class="event-list">
    <table>
        <thead>
            <tr>
                <th>Nom de l'événement</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['events'] as $event): ?>
                <tr>
                    <td><?= htmlspecialchars($event['name']) ?></td>
                    <td><?= htmlspecialchars($event['date']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
