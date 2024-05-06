<?php
require 'inc/connexion/connexion.php';
require 'inc/fonctions.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="inc/css/style.css">
    <link rel="icon" href="inc/img/jeux-olympiques.png">
</head>
<body>
    <?php
    include 'inc/navbar.php';
    ?>
    <div id = "srch-ctn">
        <h2>Filtre de recherche</h2>
        <?php
        SelectorFilter($pdo, getTable($pdo, 'Villes'), getAllDates($pdo), getTable($pdo, 'Sports')); 
        ?>
        <h2>Tous les sports ⛹🏽</h2>
        <?php
        printAllSearch($pdo, getTableSearch($pdo, NULL, NULL, NULL, NULL));
        ?>
    </div>
    <script src="inc/js/updateSelector.js"></script>
</body>
</html>
