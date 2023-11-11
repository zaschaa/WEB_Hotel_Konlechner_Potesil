<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
        <title>About</title>
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
                <h1>Über uns</h1>

                <p>Unser Hotel ist ein Familenbetrieb in fünter Generation.</p>
                <p>Es wurde 1876 gegründet und befindet sich im ersten Wiener Gemeindebezirk hinter der Staatsoper.
                Von Anfang an zählte das Hotel zu den besten Adressen in der Stadt und wurde schließlich 1881 für den Wein- und Delikatessenhandel zum k.u.k. Hoflieferant ernannt.
                Bekannte Spezialität des Hauses ist die berühmte Schokoladen-Torte, deren Rezept streng geheim gehalten wird.
                </p>
                <img class="mb-2" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Wien_-_Sachertorte.jpg/440px-Wien_-_Sachertorte.jpg" alt="a picture of a chocolate cake">
                
                <p>Das Haus verfügt über fünf Sterne und ist Mitglied der <a href="https://de.lhw.com/">Leading Hotels of the World</a>.</p>
                <p>Im Jahr 2006 wurde das Gebäude, das sich in seiner Bausubstanz aus insgesamt sechs Stadthäusern zusammensetzt, 
                unter der Leitung des Architekturbüros Frank & Partner thermisch generalsaniert, und ein Dachausbau durchgeführt, in dem ein Spa-Bereich untergebracht ist.
                </p>
            </div>     
        </main>

        <footer>
            <?php
                include '../navigation/footerNav.php';
            ?>
        </footer>        
    </body>
</html>