<?php
session_start();

include 'db_connection.php';
include 'header.php';
if (isset($_GET['nr_serie'])) {
    $nr_serie = $_GET['nr_serie'];
    $_SESSION['shporta'][$nr_serie] = isset($_SESSION['shporta'][$nr_serie]) ? $_SESSION['shporta'][$nr_serie] + 1 : 1;
    unset($_GET['nr_serie']);
    header("Location: shporta.php");
}
// Kontrollo nqs forma është dorëzuar

if (isset($_POST['shto'])) {
    $nr_serie = $_POST['nr_serie'];

    // Shto në sesion
    $_SESSION['shporta'][$nr_serie]++;
    header("Location: shporta.php");

} else if (isset($_POST['hiq'])) {
    $nr_serie = $_POST['nr_serie'];
    if ($_SESSION['shporta'][$nr_serie] > 0)
        $_SESSION['shporta'][$nr_serie]--;
    else unset($_SESSION['shporta'][$nr_serie]);
} else if (isset($_POST['fshi'])) {
    $nr_serie = $_POST['nr_serie'];

    // Hiq nga sesioni
    if (isset($_SESSION['shporta'][$nr_serie])) {
        unset($_SESSION['shporta'][$nr_serie]);
    }

    header("Location: shporta.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shporta </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main>
    <!-- Shfaq librat ne shporte -->
    <ul id="shporta-lista">
        <?php

        if (isset($_SESSION['shporta']) && count($_SESSION['shporta']) > 0) {
            $totali = 0;
            foreach ($_SESSION['shporta'] as $nr_serie => $sasia) {
                $query = "select  * from lib_pershkrim where Nr_Seri='$nr_serie'";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $titulli = $row['Titulli'];
                    $cmimi = $row['Cmimi'];
                }

                echo "<li>";
                echo "<p>Liber ID: $nr_serie</p>";
                echo "<p>Titulli: $titulli</p>";
                echo "<p>Cmimi: $cmimi</p>";
                echo "<p>Sasia: $sasia</p>";
                $shuma = $sasia * $cmimi;
                echo "<p>Shuma:{$shuma}</p>";
                echo "<form method='post'>
                <input type='hidden' name='nr_serie' value='$nr_serie'>
                <button type='submit' name='hiq' >Hiq</button>
                <button type='submit' name='shto' >Shto</button>
                <button type='submit' name='fshi' >Fshi</button>
                </form>";
                echo "</li>";
                $totali += $shuma;
            }
        } else {
            echo "<p>Shporta është bosh.</p>";
        }
        ?>
    </ul>
    <br>
    <?php
    if (isset($totali)) {
        if ($totali > 0 && $totali < 5000)
            $totali = $totali + 100;

        echo "<p>Totali:$totali</p>";
    }
    ?>
    <a href="pagesa.php">
        <button>Pagesa</button>
    </a>
</main>

</body>
</html>
