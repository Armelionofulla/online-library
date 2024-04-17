<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
else $user_id=$_SESSION['user_id'];

include 'db_connection.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatura e Blerjes</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<main>
    <h2>Fatura e Blerjes</h2>
    <ol>
        <?php
        $totali=$_SESSION['totali'];
        if(isset($_POST['konfirmo'])){

            $insert_query="insert into porosi (ID_klient,Porosidat) values('$user_id','$totali')";
            $result = mysqli_query($conn, $insert_query);
            if($result){
                $query="select ID_Porosi from porosi where ID_klient='$user_id' order by ID_Porosi desc ";
                $result = mysqli_query($conn,$query);
            }
            $row = mysqli_fetch_assoc($result);
            $id=$row['ID_Porosi'];
        }

        if(isset($_SESSION['shporta']) && count($_SESSION['shporta']) > 0) {
            foreach ($_SESSION['shporta'] as $nr_serie => $sasia) {
                $query = "select  * from lib_pershkrim where Nr_Seri='$nr_serie'";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $titulli = $row['Titulli'];
                    $cmimi=$row['Cmimi'];
                }

                echo "<li>";
                echo "<p>Liber ID: $nr_serie</p>";
                echo  "<p>Titulli: $titulli</p>";
                echo "<p>Cmimi: $cmimi</p>";
                echo "<p>Sasia: $sasia</p>";
                $shuma=$sasia*$cmimi;
                echo "<p>Shuma:{$shuma}</p>";
                echo "</li>";

                if(isset($_POST['konfirmo'])){
                    $insert_query = "insert into rresht_porosi(ID_Porosi,Seri,Sasia,Cmimi) values ('$id','$nr_serie','$sasia','$cmimi')";
                    $update_query="update lib_pershkrim set Sasia=Sasia-'$sasia' where Nr_Seri= '$nr_serie'";

                    $insert_result = mysqli_query($conn, $insert_query);
                    $update_result = mysqli_query($conn, $update_query);
                    if ($insert_result&& $update_result) {
                        $showAlert = true;
                    }
                }

            }
        } else {
            echo "<p>Shporta është bosh.</p>";
        }


        ?>
    </ol>

    <?php

    if($totali>0){
        echo "<h3>Totali {$totali}<h3>";
        echo "<form method='post'>
    <input type='hidden' name='user_id' value='$user_id'>
    <input type='hidden' name='cmimi' value='$totali'>
    <button type='submit' name='konfirmo' >Konfirmo blerjen</button>
    </form>";
    }
    ?>

</main>
<script>
    <?php
    if ($showAlert) {
        echo "alert('Blerja u krye me succes!');";
    }
    ?>
</script>

</body>
</html>