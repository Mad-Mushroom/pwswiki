<head>
    <title>PWS Wiki</title>
    <link rel="icon" type="../image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../style.css">
    <?php
        error_reporting(E_ERROR | E_PARSE);
        session_start();
        if($_GET['logout'] == 1){
            unset($_SESSION['id']);
            unset($_SESSION['username']);
            unset($_SESSION['userprivileges']);
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
        <h1>Hauptseite</h1>
        <hr>
        <p>Das Wiki über alles in der Paul-Winter Realschule Neuburg an der Donau!</p>
        <h2 style="color: red;">ACHTUNG</h2>
        <p>Die Website wird zurzeit noch entwickelt, sie ist NICHT fertig.</p>
        <p>Viele Funktionen & Features sind nicht fertig, oder funktionieren nicht richtig!</p>
        <p>Status: ALPHA</p>
        <h2>Über uns</h2>
        <p>Unser Team besteht zurzeit aus 2 Personen, wir gehen beide auf die Paul-Winter Realschule.</p>
        <h3>Technische Daten</h3>
        <p>Die Website wurde in php geschrieben, manche Teile sind aber (natürlich) auch mit HTML/css geschrieben.</p>
        <p>Zurzeit wird die Website auf einem Raspberry Pi 3 B+ gehostet.</p>
        <a href="https://github.com/Mad-Mushroom/pwswiki">GitHub Page</a>
        <br><hr>
        <p>Copyright &#169; 2024 PWS-Wiki Team</p>
    </div>
</body>