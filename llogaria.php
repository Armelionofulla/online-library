<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include 'db_connection.php';
include 'header.php';

if (isset($_POST['logout']))
    unset($_SESSION['user_id']);

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llogaria</title>
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
</head>
<body>


<main>

    <?php
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $read_query = "select  * from lib_klient where ID_Klient='$user_id'";

        $result = mysqli_query($conn, $read_query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Emri = $row['Emri'];
                $Mbiemri = $row['Mbiemri'];
                $Email = $row['Email'];

                echo "<h3>Emri:{$Emri}</h3>";
                echo "<h3>Mbiemri:{$Mbiemri}</h3>";
                echo "<h3>Email:{$Email}</h3>";
                echo "<form method='post'>";
                echo "<button name='logout'>Logout</button>";
                echo "</form>";

            }
        }
    } else {
        header('Location: login.php');
        exit();
    };
    ?>
</main>
</body>
</html>