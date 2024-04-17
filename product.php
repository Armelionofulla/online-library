<!DOCTYPE html>
<html lang="en">
<?php
include 'db_connection.php';
include 'header.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dyqani Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Trupi i faqes -->
<main class="product">
    <br><br>
    <?php
    if (isset($_GET['nr_serie'])) {
        $nr_serie = $_GET['nr_serie'];
        $author_query = "select Emri,Mbiemri from lib_autor WHERE ID_autor in( SELECT ID_autor from lib_aut_klas where Nr_Seri='$nr_serie') ";
        $result = mysqli_query($conn, $author_query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $emri = $row['Emri'];
            $mbiemri = $row['Mbiemri'];
        }
        $read_query = "select  * from lib_pershkrim where Nr_Seri='$nr_serie'";

        $result = mysqli_query($conn, $read_query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $titulli = $row['Titulli'];
                $pershkrim = $row['Pershkrimi'];
                echo "<li>";
                echo "<h1>Titulli:{$titulli}</h1>";
                echo "<img src='Imazhe/BigCover/{$nr_serie}.jpg'>";
                echo "<h3>Seria:{$nr_serie}</h3>";
                echo "<h3>Autori:{$emri} {$mbiemri}</h3>";
                echo "<hr><br>";
                echo "<h2>Pershkrim i librit:</h2>";
                echo "<hr>";
                echo "<p>{$pershkrim}</p>";
                echo "<hr><br>";
                echo "<hr><br>";
                echo "<button><a href='shporta.php?nr_serie={$nr_serie}'>Shto në shportë</a</button>";
                echo "</li>";
            }
        }
    }
    ?>
</main>

</body>
</html>
