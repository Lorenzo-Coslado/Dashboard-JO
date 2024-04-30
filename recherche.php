<?php
require 'inc/connexion/connexion.php';
require 'inc/fonctions.php';
$dates = $_POST['dates'];
$villes = $_POST['villes'];
$sports = $_POST['sports'];

if ($dates == "") {
    $dates = NULL;
}
if ($villes == "") {
    $villes = NULL;
}
if ($sports == "") {
    $sports = NULL;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de la Recherche</title>
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
        <h2>Résultat de la recherche 🔍</h2>
    <?php
    printAllSearch($pdo, getTableSearch($pdo, $villes, $dates, $sports));
    ?>
    <script>
    var resultNull = document.getElementById('resultNull');

    resultNull.addEventListener('mouseover', function() {
        resultNull.textContent = 'Aucun résultat 😭';
    });

    resultNull.addEventListener('mouseout', function() {
        resultNull.textContent = 'Aucun résultat 😒';
    });
    
    var ball = document.querySelector('.ball');

    ball.addEventListener('animationend', function() {
        ball.remove();
    });
    </script>
</body>
</html>