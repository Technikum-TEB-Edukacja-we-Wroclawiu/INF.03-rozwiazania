<?php
$db = mysqli_connect('localhost', 'root', '', 'terminarz');

// skrypt 1

/* info: tutaj pobieram wszystkie najbliższe zadania i zapisuję do zmiennej
   $next_tasks. Operator ".=" to skrócony operator "dopisania" do napisu,
   zgodnie z zasadami skracania operatorów (np. += czy -=). */

$q = "SELECT DISTINCT wpis
FROM zadania
WHERE dataZadania BETWEEN '2020-07-01' AND '2020-07-07'
	AND wpis <> '';";
$r = mysqli_query($db, $q);

$next_tasks = "";
while($row = mysqli_fetch_array($r)) {
    $next_tasks .= $row['wpis'] . "; ";
}


// skrypt 2

/* info: tutaj pobieram wszystkie wyniki zapytania do tablicy $calendar, 
   później będę wyświetlać tylko z tej zmiennej. */
$q = "SELECT dataZadania, wpis
FROM zadania
WHERE miesiac = 'lipiec';";
$r = mysqli_query($db, $q);
$calendar = mysqli_fetch_all($r, MYSQLI_BOTH);

// ponieważ zakończyłem prace na bazie danych, mogę tutaj już zakończyć połączenie
mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadania na lipiec</title>
    <link rel="stylesheet" href="styl6.css">
</head>
<body>
    <header>
        <section class="left">
            <img src="logo1.png" alt="lipiec">
        </section>
        <section class="right">
            <h1>TERMINARZ</h1>
            <p>najbliższe zadania: <?= $next_tasks ?></p>
        </section>
    </header>
    <main>
        <?php 
        foreach($calendar as $c) {
        ?>
        <section class="calendar">
            <h6><?= $c['dataZadania'] ?></h6>
            <p><?= $c['wpis'] ?></p>
        </section>
        <?php
        }
        ?>
    </main>
    <footer>
        <a href="sierpien.html">Terminarz na sierpień</a>
        <p>Stronę wykonał: 123456789112</p>
    </footer>
</body>
</html>