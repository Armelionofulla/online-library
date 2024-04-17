<?php
include 'db_connection.php';
include 'header.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emri = $_POST['emri'];
    $mbiemri = $_POST['mbiemri'];
    $email = $_POST['email'];
    $query = "SELECT * FROM lib_klient WHERE Emri = '$emri' AND Mbiemri = '$mbiemri' AND Email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['ID_Klient'];
        header("Location: pagesa.php");
        exit();
    } else {
        $error = "Te dhenat nuk jane te sakta.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main>

    <?php
    if (isset($error_message)) {
        echo "<p>$error</p>";
    }
    ?>

    <form method="post">
        <h1>Log In</h1><br><br>
        <label>Emri :</label>
        <input type="text" name="emri" required>
        <label>Mbiemri :</label>
        <input type="text" name="mbiemri" required>

        <label>Email:</label>
        <input type="text" name="email" required>

        <button type="submit">Hyr</button>
    </form>
</main>

</body>
</html>