<head>
    <title>PWS Wiki</title>
    <link rel="icon" type="../image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../style.css">
    <?php
        error_reporting(E_ERROR | E_PARSE);
        $pdo = new PDO('mysql:host=localhost;dbname=wiki;charset=utf8', 'root', '');
        session_start();
        if($_GET['logout'] == 1){
            unset($_SESSION['id']);
            unset($_SESSION['username']);
        }
        if($_GET['id'] == NULL || $_SESSION['userprivileges'] <= 1){
            header("Location: index.php");
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

        foreach ($pdo->query("SELECT * FROM articles") as $row) {
            if($row['id'] == $_GET['id']){
                $a_heading = $row['heading'];
                $a_topic = $row['topic'];
                $a_author = $row['author'];
                $a_creationdate = $row['creationdate'];
                $a_quickfacts = $row['quickfacts'];
                $a_content = $row['content'];
                $a_sources = $row['sources'];
            }
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
        <?php
            if($loggedin == true && $_SESSION['userprivileges'] > 1){
                echo "<hr><a href=\"../admin/panel.php\">Admin Panel</a>";
            }
        ?>
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
        <h1>Artikel bearbeiten</h1>
        <hr>
        <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="post" id="create_form">
            <input type="date" name="date"/><br><br>
            <input type="text" name="header" placeholder="Überschrift" value="<?php echo $a_heading; ?>"/><br><br>
            <input type="text" name="topic" placeholder="Thema" value="<?php echo $a_topic; ?>"/><br><br>
            <input type="text" name="author" placeholder="Author" value="<?php echo $a_author; ?>"/><br><br>
            <textarea name="quickfacts" placeholder="Quickfacts"><?php echo $a_quickfacts; ?></textarea><br><br>
            <textarea name="content" placeholder="Inhalt"><?php echo $a_content; ?></textarea><br><br>
            <textarea name="sources" placeholder="Quellen"><?php echo $a_sources; ?></textarea><br><br>
            <input type="submit" name="submit" value="Aktualisieren" />
        </form>

        <?php
            $heading = $_POST['header'];
            $topic = $_POST['topic'];
            $author = $_POST['author'];
            $creationdate = $_POST['date'];
            $quickfacts = $_POST['quickfacts'];
            $content = $_POST['content'];
            $sources = $_POST['sources'];
            if($heading != NULL) $pdo->query("UPDATE `articles` SET `heading` = '" . $heading . "', `topic` = '" . $topic . "', `author` = '" . $author . "', `creationdate` = '" . $creationdate . "', `quickfacts` = '" . $quickfacts . "', `content` = '" . $content . "', `sources` = '" . $sources . "' WHERE `articles`.`id` = " . $_GET['id'] . " ");
            if($heading != NULL) header("Location: index.php");
        ?>
    </div>
</body>