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
    <style>

    </style>
</head>
<body>


<main>
    <?php
    $read_query = "select * from lib_pershkrim order by RAND() limit 8";
    $result = mysqli_query($conn, $read_query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $seria = $row['Nr_Seri'];
            $titulli = $row['Titulli'];
            $pershkrim = $row['Pershkrimi'];
            ?>
            <div class="card-container">
                <div class="card">
                    <img src='Imazhe/BigCover/<?php echo $seria; ?>.jpg' class="card-img-top"
                         alt="<?php echo $titulli; ?>">
                    <div class="card-content">
                        <h3 class="card-title"><?php echo $titulli; ?></h3>
                        <p class="card-text"><?php echo substr($pershkrim, 0, 100) . "..."; ?></p>
                        <a href='product.php?nr_serie=<?php echo $seria; ?>' class="btn">
                            <button type="submit">Me Shume</button>
                        </a>
                        <a href='shporta.php?nr_serie=<?php echo $seria; ?>' class="btn">
                            <button type="submit">Shto ne Shporte</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>

</main>
</body>
</html>