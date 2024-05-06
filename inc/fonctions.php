<?php

function getTable($pdo, $table){
    $query = $pdo->prepare("SELECT * FROM $table");
    $query->execute();
    return $query;
}

function getAllDates($pdo){
    $query = $pdo->prepare("SELECT DISTINCT date FROM Calendrier ORDER BY date desc");
    $query->execute();
    return $query;
}

function printAllSports($pdo, $query){
    echo "<br>";
    echo "<form action='recherche.php' method='post'>";
    echo "<table border='1'>";
    echo "<tr><th>Nom du Sport</th>";

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td><input type='submit' class = btn-search name = sports value='" . $row['nom'] . "'></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</form>";
}

function printAllVilles($pdo, $query){
    echo "<br>";
    echo "<form action='recherche.php' method='post'>";
    echo "<table border='1'>";
    echo "<tr><th>Nom de la ville</th>";

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td><input type='submit' class = btn-search name = villes value='" . $row['ville'] . "'></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</form>";
}

function printAllLieux($pdo, $query){
    echo "<br>";
    echo "<form action='recherche.php' method='post'>";
    echo "<table border='1'>";
    echo "<tr><th>Nom du lieu</th> <th>Paralympique</th>";

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td><input type='submit' class = btn-search name = lieux value='" . $row['lieu'] . "'></td>";
        if ($row["Site paralympique"] == 1)
            echo "<td>Site Paralympique</td>";
        else
            echo "<td></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</form>";
}

function printAllDates($pdo, $query){
    echo "<br>";
    echo "<form action='recherche.php' method='post'>";
    echo "<table border='1'>";
    echo "<tr><th>Date</th>";

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td><input type='submit' class = btn-search name = dates value='" . $row['date'] . "'></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</form>";
}

function SelectorFilter($pdo, $villes, $dates, $sports){
    echo "<form action='recherche.php' method='post'>";
    echo "<select name = dates id = dates onchange= updateSelectors()>";
    echo "<option value=''>Toutes les Dates</option>";
    while ($row = $dates->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='".$row['date']."'>".$row['date']."</option>";
    }
    echo "</select>";
    echo "<select name = villes id = villes>";
    echo "<option value=''>Toutes les Villes</option>";
    while ($row = $villes->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='".$row['ville']."'>".$row['ville']."</option>";
    }
    echo "</select>";
    echo "<select name = sports id = sports>";
    echo "<option value=''>Tous les Sports</option>";
    while ($row = $sports->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='".$row['nom']."'>".$row['nom']."</option>";
    }
    echo "</select>";
    echo "<input type='submit' id= btn-submit value='Rechercher'>";
    echo "</form>";
}

function getTableSearch($pdo, $villes, $dates, $sports, $lieux){
    $query = $pdo->prepare("SELECT Calendrier.date , Calendrier.debut, Calendrier.fin, Calendrier.details, Lieux.lieu , Villes.ville , Sports.nom FROM  Villes
        JOIN LieuxVilles ON Villes.idVille = LieuxVilles.idVille
        JOIN Lieux ON LieuxVilles.idLieu = Lieux.idLieu
        JOIN Calendrier ON Lieux.idLieu = Calendrier.idLieu
        JOIN Sports ON Calendrier.idSport = Sports.idSport
        WHERE (Villes.ville = :villes OR :villes IS NULL) AND (Sports.nom = :sports OR :sports IS NULL) AND (Calendrier.date = :dates OR :dates IS NULL) AND (Lieux.lieu = :lieux OR :lieux IS NULL);");

    $query->execute([':villes' => $villes, ':dates' => $dates, ':sports' => $sports, ':lieux' => $lieux]);

    return $query;
}

function printAllSearch($pdo, $query){
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);
    if(empty($rows))   {
        echo "<p id=resultNull >Aucun résultat 😒<p>";
        echo "<div class=ball>
            </div>";
        
    }
    else {
        
        echo "<br>";
        echo "<form action='recherche.php' method='post'>";
        echo "<table border='1'>";
        echo "<tr><th>Date</th><th>Ville</th><th>Sport</th><th>Début</th><th>Fin</th><th>Lieu</th><th>Détails</th>";

        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td><input type='submit' class = btn-search name = dates value='" . $row['date'] . "'></td>";
            echo "<td><input type='submit' class = btn-search name = villes value='" . $row['ville'] . "'></td>";
            echo "<td><input type='submit' class = btn-search name = sports value='" . $row['nom'] . "'></td>";
            echo "<td>" . $row['debut'] . "</td>";
            echo "<td>" . $row['fin'] . "</td>";
            echo "<td><input type='submit' class = btn-search name = lieux value='" . $row['lieu'] . "'></td>";
            echo "<td>" . $row['details'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</form>";
    }
    

    
}