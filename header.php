<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Library</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="header-container">
        <div class="logo">
            <h1>
                <a href="index.php">
                    <img src="Imazhe/logo.png" alt="Logo" width="90" height="90"> ONLINE LIBRARY
                </a>
            </h1>
        </div>
        <div class="search">
            <form action="kerko.php" method="GET">
                <label>
                    <input type="text" name="kerko" placeholder="Kërko...">
                </label>
                <button type="submit">Kërko</button>
            </form>
        </div>
        <div class="account">
            <h2>
                <a href="llogaria.php"><img src="Imazhe/avatar.png" alt="Shporta" width="50" height="50">Llogaria</a>
            </h2>
        </div>
        <div class="cart">
            <h2>
                <a href="shporta.php"><img src="Imazhe/shporta.png" alt="Shporta" width="50" height="50">Shporta</a>
            </h2>
        </div>
    </div>
</header>
</body>
</html>
