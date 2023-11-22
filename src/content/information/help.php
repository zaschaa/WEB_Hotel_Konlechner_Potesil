<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
        <title>FAQ</title>
        <link rel="stylesheet" href="../../styles.css"/>
    </head>
    <body class="bgColor bg-gradient">     
        <header>
            <?php
              include '../../navigation/navbar/topNavBar.php';
            ?> 
        </header>

        <main> 
            <div class="container justify-content-left">
                <h1>Offene Fragen? <br> Nicht mehr lange!</h1>

                <dl>
                    <dt><b>Was ist der Zweck dieser Webseite?</b></dt>
                    <dd>- Es handelt sich um den Auftritt des Hotels "The Great Old One".</dd><br>
                    <dt><b>Wo finde ich die Kontaktdaten?</b></dt>
                    <dd>- Die Firmen-Anschrift sowie die, für den Inhalt dieser Webseite veranwortlichen, Personen mitsamt Kontaktdaten, Telefonnummer und E-Mail-Adresse finden Sie hier: <a href="./impressum.php" class="text-decoration-underline">Impressum</a></dd><br>
                    <dt><b>Verfügt das Hotel über eine Tag und Nacht besetzte Rezeption?</b></dt>
                    <dd>- Ja, unsere Rezeption ist 24 h / 7 Tage die Woche besetzt.</dd><br>
                    <dt><b>Wie kann ich eine Reservierung durchführen?</b></dt>
                    <dd>- Gerne können Sie sich telefonisch unter +43 1 333 40 77-0< oder per Email an <a class="text-decoration-underline" href="mailto:office@thegreatoldone.vienna">office@thegreatoldone.vienna</a> mit einer Reservierungsanfrage an uns wenden.</dd>
                    <dd>- Falls Sie jedoch lieber selbst online eine Reservierung durchführen möchten, so ist es erforderlich, sich mittels eines Formulars auf dieser Webseite als Benutzer zu registrieren.<br><br>
                        <p>
                            Zur Registrierung gelanden Sie hier: <a href='../userManagement/registration/registration_form.php' class="text-decoration-underline">Benutzer-Registrierung</a><br>
                            Sobald Sie sich registiert haben, können Sie sich mit dem angelegten Benutzer unter "Login" im rechten oberen Eck anmelden.<br>
                            Sollten Sie sich bereits angemeldet haben, können Sie dort Einsicht in die Angaben zu Ihrem Profil nehmen und dieses auch anpassen.
                        </p>                        
                    </dd>
                        
                    <dt><b>Gibt es im Hotel ein Restaurant und wann ist dieses geöffnet?</b></dt>
                    <dd>- Ja, das Hotel verfügt über ein eigenes Restaurant mit Bar. Warme Küche wird tägl. von 11 - 22 Uhr angeboten. Kalte Snacks und Getränke erhalten Sie tägl. von 9 - 24 Uhr. </dd>
                </dl>   
            </div>    
        </main>

        <footer>
            <?php
                include '../../navigation/footer/footerNav.php';
            ?>
        </footer>  
    </body>
</html>