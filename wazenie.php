<!DOCTYPE html>
<html lang="en">

<?php

header('Refresh:3');
$db = mysqli_connect('localhost', 'root', '', 'wazenietirow');
if (!$db)
    throw new ErrorException('Blad poleczenia z baza');
$zapytanie = mysqli_query($db, 'INSERT INTO `wagi` (lokalizacje_id, waga, rejestracja, dzien, czas)
VALUES (5, FLOOR(1 + RAND() * 10), "DW12345", CURRENT_DATE, CURRENT_TIME);');

echo $zapytanie;


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ważenie samochodów ciężarowych</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <header>
        <section id="pierwszy">
            <h1>Ważenie pojazdów we
                Wrocławiu</h1>
        </section>
        <section id="drugi"><img src="/obraz1.png" alt="waga"></section>
    </header>
    <aside id="lewy">
        <h2>Lokalizacje wag</h2>
        <ol>
            <?php
            $db = mysqli_connect('localhost', 'root', '', 'wazenietirow');
            if (!$db)
                throw new ErrorException('Blad poleczenia z baza');
            $zapytanie = mysqli_query($db, 'SELECT ulica FROM `lokalizacje`;');
            while ($wynik = mysqli_fetch_assoc($zapytanie)) {
                echo "<li>ulica {$wynik['ulica']}</li>";
            }
            mysqli_close($db)
            ;
            ?>
        </ol>
        <h2>Kontakt</h2>
        <a href="mailto:wazenie@wroclaw.pl">napisz</a>
    </aside>
    <main>
        <h2>Alerty</h2>
        <table>
            <tr>
                <th>rejestracja</th>
                <th>ulica</th>
                <th>waga</th>
                <th>dzien</th>
                <th>czas</th>
            </tr>
            <?php
            $db = mysqli_connect('localhost', 'root', '', 'wazenietirow');
            if (!$db)
                throw new ErrorException('Blad poleczenia z baza');
            $zapytanie = mysqli_query($db, 'SELECT wagi.rejestracja,wagi.waga,wagi.dzien,wagi.czas,lokalizacje.ulica FROM `wagi` INNER JOIN `lokalizacje` ON lokalizacje.id = wagi.lokalizacje_id AND wagi.waga > 5;');
            while ($wynik = mysqli_fetch_assoc($zapytanie)) {
                echo "<tr>
                <td>{$wynik['rejestracja']}</td>
                <td>{$wynik['ulica']}</td>
                <td>{$wynik['waga']}</td>
                <td>{$wynik['dzien']}</td>
                <td>{$wynik['czas']}</td>
                </tr>";
            }
            mysqli_close($db)
            ;
            ?>
        </table>
    </main>
    <aside id="prawy">
        <img src="/obraz2.jpg" alt="tir">
    </aside>
    <footer>
        <p>Stronę wykonał:0000000</p>
    </footer>
</body>

</html>