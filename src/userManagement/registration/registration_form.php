<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
        <title>Registrierung</title>
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
                <h1>Benutzer-Registrierung</h1>

                <form class="col-3" method="POST">
                    <div class="mb-3">
                        <label for="anrede" class="form-label">Anrede</label>
                        <select id="anrede" class="form-select">
                            <option selected value="Keine">Keine</option>   
                            <option value="Frau">Frau</option>
                            <option value="Herr">Herr</option>                    
                        </select>                                             
                    </div>
                    <div class="mb-3">
                        <label for="vorname" class="form-label">Vorname</label>
                        <input type="text" class="form-control" name="vorname" id="vorname">
                    </div>
                    <div class="mb-3">
                        <label for="nachname" class="form-label">Nachname</label>
                        <input type="text" class="form-control" name="nachname" id="nachname">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">Wir werden Ihre E-Mailadresse niemals an Dritte weitergeben!</div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>         
                    <div class="mb-3">
                    <label for="password" class="form-label">Passwort</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password2" class="form-label">Passwort bestätigen</label>
                        <input type="password" class="form-control" name="password2" id="password2" aria-describedby="password2Help" required>
                        <div id="password2Help" class="form-text">Bitte hier das Passwort wiederholen!</div>
                    </div>           
                    <button class="btn btn-success" type="submit">Registrieren</button>
                </form>         
            </div>
        </main>

        <footer>
            <?php
                include '../../navigation/footer/footerNav.php';
            ?>
        </footer>       
    </body>
</html>