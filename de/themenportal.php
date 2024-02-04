<head>
    <title>PWS Wiki</title>
    <link rel="icon" type="../image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../style.css">
    <?php
        error_reporting(E_ERROR | E_PARSE);
        session_start();
        $pdo = new PDO('mysql:host=localhost;dbname=wiki;charset=utf8', 'root', '');
        if($_GET['logout'] == 1){
            unset($_SESSION['id']);
            unset($_SESSION['username']);
        }
        $loggedin = false;
        $username = "Nicht angemeldet";
        if($_SESSION['id'] != 0){
            $id = $_SESSION['id'];
            $username = $_SESSION['username'];
            $loggedin = true;
        }
    ?>
</head>
<body>
    <div id="nav_panel">
        <img src="../img/pws_logo_t.png" alt="Logo" width="200" height="150">
        <a href="index.php">Hauptseite</a><br>
        <a href="themenportal.php">Themenportal</a><br>
        <hr>
        <a href="neu.php">Neuen Artikel anlegen</a><br>
        <a href="edit.php">Artikel editieren</a><br>
        <!--<a href="autorenportal.php">Autorenportal</a><br>-->
        <a href="hilfe.php">Hilfe</a><br>
        <a href="kontakt.php">Kontakt</a><br>
        <a href="spenden.php">Spenden</a><br>
        <hr>
        <a href="index.php">Deutsch</a><br>
        <a href="../en/index.php">English</a><br>
    </div>
    <div id="account_panel">
        <?php
            if($loggedin == true){
                echo "<a href=\"index.php?logout=1\">Ausloggen</a><a href=\"../account/manage.php\">Konto verwalten</a><a id=\"login_status_text\">" . $username . "</a>";
            }else{
                echo "<a href=\"../account/login.php\">Anmelden</a><a href=\"../account/register.php\">Konto erstellen</a><a id=\"login_status_text\">Nicht angemeldet</a>";
            }
        ?>
    </div>
    <div id="main_panel">
        <h1>Themenportal</h1>
        <hr>
        <?php
            $allgemein = "<h2>Allgemein</h2>";
            $schule_schulleben = "<h2>Schule & Schulleben</h2>";
            $lehrer = "<h2>Lehrkräfte</h2>";
            $other = "<h2>Sonstiges</h2>";
            foreach ($pdo->query("SELECT * FROM articles") as $row) {
                if($row['topic'] == "Schule & Schulleben"){
                    $schule_schulleben = $schule_schulleben . "<a href=\"artikel.php?id=" . $row['id'] . "\">" . $row['heading'] . "</a>";
                }else if($row['topic'] == "Allgemein"){
                    $allgemein = $allgemein . "<a href=\"artikel.php?id=" . $row['id'] . "\">" . $row['heading'] . "</a>";
                }else if($row['topic'] == "Lehrer"){
                    $lehrer = $lehrer . "<a href=\"artikel.php?id=" . $row['id'] . "\">" . $row['heading'] . "</a>";
                }else{
                    $other = $other . "<a href=\"artikel.php?id=" . $row['id'] . "\">" . $row['heading'] . "</a>";
                }
            }

            echo $allgemein;
            echo $schule_schulleben;
            echo $lehrer;
            echo $other;
        ?>
    </div>
</body>