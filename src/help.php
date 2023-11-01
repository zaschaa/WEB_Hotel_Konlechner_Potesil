<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
        <title>FAQ</title>
        <link rel="stylesheet" href="./styles.css"/>
    </head>
    <body class="bgColor bg-gradient">     
        <header>
            <?php
              include 'topNavBar.php';
            ?> 
        </header>

        <main> 
            <div class="container justify-content-left">
                <h1>Offene Fragen? <br> Nicht mehr lange!</h1>

                <dl>
                    <dt><b>Was ist der Zweck dieser Webseite?</b></dt>
                    <dd>- Es handelt sich um den Auftritt des Hotels "The Great Old Hotel".</dd><br>
                    <dt><b>Verfügt das Hotel über eine Tag und Nacht besetzte Rezeption?</b></dt>
                    <dd>- Ja, unsere Rezeption ist 24 h / 7 Tage die Woche besetzt.</dd><br>
                    <dt><b>Gibt es im Hotel ein Restaurant und wann ist dieses geöffnet?</b></dt>
                    <dd>- Ja, das Hotel verfügt über ein eigenes Restaurant mit Bar. Warme Küche wird tägl. von 11 - 22 Uhr angeboten. Kalte Snacks und Getränke erhalten Sie tägl. von 9 - 24 Uhr. </dd>
                </dl>   
            </div>    
        </main>

        <footer>
            <?php
                include 'footerNav.php';
            ?>
        </footer>  
    </body>
</html>