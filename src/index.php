<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
        <title>The Great Old Hotel</title>

        <link rel="stylesheet" href="./styles.css"/>
        <!--
         _             _____                _            ______     _            _ _
        | |           /  ___|              | |           | ___ \   | |          (_) |
        | |__  _   _  \ `--.  __ _ ___  ___| |__   __ _  | |_/ /__ | |_ ___  ___ _| |
        | '_ \| | | |  `--. \/ _` / __|/ __| '_ \ / _` | |  __/ _ \| __/ _ \/ __| | |
        | |_) | |_| | /\__/ / (_| \__ \ (__| | | | (_| | | | | (_) | ||  __/\__ \ | |
        |_.__/ \__, | \____/ \__,_|___/\___|_| |_|\__,_| \_|  \___/ \__\___||___/_|_|
                __/ |
               |___/
                          _   _   __                          _   _   __            _           _
                         | | | | / /                         | | | | / /           | |         | |
           __ _ _ __   __| | | |/ /  ___  _ __  _ __ __ _  __| | | |/ /  ___  _ __ | | ___  ___| |__  _ __   ___ _ __
          / _` | '_ \ / _` | |    \ / _ \| '_ \| '__/ _` |/ _` | |    \ / _ \| '_ \| |/ _ \/ __| '_ \| '_ \ / _ \ '__|
         | (_| | | | | (_| | | |\  \ (_) | | | | | | (_| | (_| | | |\  \ (_) | | | | |  __/ (__| | | | | | |  __/ |
          \__,_|_| |_|\__,_| \_| \_/\___/|_| |_|_|  \__,_|\__,_| \_| \_/\___/|_| |_|_|\___|\___|_| |_|_| |_|\___|_|
        -->
    </head>
    
    <body class="bgColor bg-gradient">
        <header>
            <?php
              include 'topNavBar.php';
            ?>
        </header>

        <main>
          <div class="container justify-content-left">                         
            <h1 class="mb-3">Willkommen!</h2>

            <h2 class="mb-3">Im traditionsreichen Haus mitten in Wien.</h2>            
            
            <h1 class="homeTitle mb-2">The Great Old Hotel</h1>     

            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/Wien_Hotel_Sacher_Am_Abend.jpg/440px-Wien_Hotel_Sacher_Am_Abend.jpg" alt="a picture of hotel Sacher at night"/>     
          </div>                                                                                                    
        </main>
        
        <footer>
          <?php
            include 'footerNav.php';
          ?>
        </footer> 
  </body>     
</html>