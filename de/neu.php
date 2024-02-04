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
        }else{
            header("Location: index.php");
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
        <h1>Neuen Artikel erstellen</h1>
        <hr>
        <form action="neu.php" method="post" id="create_form">
            <input type="date" name="date"/><br><br>
            <input type="text" name="header" placeholder="Überschrift"/><br><br>
            <input type="text" name="topic" placeholder="Thema"/><br><br>
            <input type="text" name="author" placeholder="Author"/><br><br>
            <textarea name="quickfacts" placeholder="Quickfacts" ></textarea><br><br>
            <textarea name="content" placeholder="Inhalt" ></textarea><br><br>
            <textarea name="sources" placeholder="Quellen" ></textarea><br><br>
            <input type="submit" name="submit" value="Erstellen" />
        </form>

        <?php
            $id = 0;
            foreach ($pdo->query("SELECT * FROM articles") as $row) {
                $id = ++$row['id'];
            }
            $heading = $_POST['header'];
            $topic = $_POST['topic'];
            $author = $_POST['author'];
            $creationdate = $_POST['date'];
            $quickfacts = $_POST['quickfacts'];
            $content = $_POST['content'];
            $sources = $_POST['sources'];
            //echo "INSERT INTO `articles` (`id`, `heading`, `topic`, `author`, `creationdate`, `quickfacts`, `content`, `sources`) VALUES ('" . $id . "', '" . $heading . "', '" . $topic . "', '" . $author . "', '" . $creationdate . "', '" . $quickfacts . "', '" . $content . "', '" . $sources . "')";
            $pdo->query("INSERT INTO `articles` (`id`, `heading`, `topic`, `author`, `creationdate`, `quickfacts`, `content`, `sources`) VALUES ('" . $id . "', '" . $heading . "', '" . $topic . "', '" . $author . "', '" . $creationdate . "', '" . $quickfacts . "', '" . $content . "', '" . $sources . "')");
            header("Location: index.php");
        ?>
    </div>
</body>