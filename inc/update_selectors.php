<?php
require 'connexion/connexion.php';

$dates = $_POST['date'];

if ($dates == "") {
    $dates = NULL;
}

$query = $pdo->prepare("SELECT Calendrier.date , Calendrier.debut, Calendrier.fin, Calendrier.details, Lieux.lieu , Villes.ville , Sports.nom FROM  Villes
        JOIN LieuxVilles ON Villes.idVille = LieuxVilles.idVille
        JOIN Lieux ON LieuxVilles.idLieu = Lieux.idLieu
        JOIN Calendrier ON Lieux.idLieu = Calendrier.idLieu
        JOIN Sports ON Calendrier.idSport = Sports.idSport
        WHERE (Calendrier.date = :dates OR :dates IS NULL);");

$query->execute([':dates' => $dates]);

$results = $query->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($results);

echo $json;