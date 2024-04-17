<!DOCTYPE html>
<html lang="en">
<?php
include 'db_connection.php';
include 'header.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Library</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>
<!-- Skripta për shtuar në shportë (JavaScript mund të përdoret për ndërveprim me përdoruesin) -->
<script>
    function shtoNeShporte(liber_id) {
        // Këtu mund të shtohet logjika për shtimin në shportë
        alert("Libri u shtua në shportë!");
    }
</script>

<body>

<?php
// Simulate a database connection
include("db_connection.php");

// Check if the 'q' parameter is set for search
if (isset($_GET['kerko'])) {
    $search_query = $_GET['kerko'];

    // Construct and execute SQL query for searching books
    $sql = "SELECT * FROM lib_pershkrim WHERE Titulli LIKE '%$search_query%'";
    $result = $conn->query($sql);

    // Display search results
    echo "<main>";
    echo "    <h2>Rezultatet e Kërkimit për: '$search_query'</h2>";
    if ($result->num_rows > 0) {
        echo "    <ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<hr>";
            echo "<img src='Imazhe/cover/{$row['Nr_Seri']}.jpg'>";
            echo "<h3>{$row['Titulli']}</h3>";
            echo "<p>{$row['Pershkrimi']}</p>";
            echo "<p>Cmimi: {$row['Cmimi']}</p>";
            echo "<p>Botuesi: {$row['Botuesi']}</p>";
            echo "<p>Publikimi: {$row['Publikimi']}</p>";
            echo "<p>Tirazhi: {$row['Tirazhi']}</p>";
            echo "<p>Numri i Faqeve: {$row['Nr_Faqeve']}</p>";
            echo "<p>Vleresimi: {$row['Vleresim']}</p>";
            echo "<p>Sasia në Stok: {$row['Sasia']}</p>";
            echo "<hr>";
        }
        echo "    </ul>";
    } else {
        echo "    <p>Nuk u gjetën rezultate për këtë kërkim.</p>";
    }
    echo "</main>";

    echo "</body>";
    echo "</html>";

} elseif (isset($_GET['kategori'])) {  // Check if a category is clicked
    $category = $_GET['kategori'];

    // Construct and execute SQL query for displaying books in the selected category
    $sql = "SELECT * FROM lib_pershkrim WHERE Nr_Seri in( SELECT Nr_Seri from lib_klas where ID_Kat in( SELECT ID_Kat  FROM  lib_kat where Kategoria = '$category'))";
    $result = $conn->query($sql);


    // Display category results
    echo "<main class='lib'>";
    echo "    <h2>Librat në kategorinë: $category</h2>";
    if ($result->num_rows > 0) {
        echo "    <ul>";
        while ($row = $result->fetch_assoc()) {
            echo "        <li>";
            echo "<img src='Imazhe/cover/{$row['Nr_Seri']}.jpg'>";
            echo "            <h3>{$row['Titulli']}</h3>";
            echo "            <p>{$row['Pershkrimi']}</p>";
            echo "            <p>Cmimi: {$row['Cmimi']}</p>";
            echo "            <p>Botuesi: {$row['Botuesi']}</p>";
            echo "            <p>Publikimi: {$row['Publikimi']}</p>";
            echo "            <p>Tirazhi: {$row['Tirazhi']}</p>";
            echo "            <p>Numri i Faqeve: {$row['Nr_Faqeve']}</p>";
            echo "            <p>Vleresimi: {$row['Vleresim']}</p>";
            echo "            <p>Sasia në Stok: {$row['Sasia']}</p>";
            echo "<button><a href='shporta.php?nr_serie={$row['Nr_Seri']}'>Shto në shportë</a</button>";
            echo "        </li>";
        }
        echo "    </ul>";
    } else {
        echo "    <p>Nuk ka libra në këtë kategori.</p>";
    }
    echo "</main>";

    echo "</body>";
    echo "</html>";

} else {
    // Handle the case where neither search nor category is specified
    echo "Nuk është specifikuar një kërkim ose një kategori.";
}

// Close the connection
$conn->close();
?>


</body>
</html>



