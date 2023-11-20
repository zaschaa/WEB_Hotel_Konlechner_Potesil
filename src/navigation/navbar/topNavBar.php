<nav class="navbar navbar-expand-lg navBarColor bg-gradient">
    <div class="container justify-content-left">
        <div class="navbar d-flex flex-column">
            <a class="p-1 mb-2" id="homeLink" href="../../index.php">
                <?php
                include "../../banner/TheGreatOldOneBanner.php"
                ?>
            </a>
        </div>   
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">     
                <li class="nav-item px-2">
                    <a href="../../userManagement/registration/registration_form.php">Benutzer-Registrierung</a>
                </li>
                <li class="nav-item px-2">
                    <a href="../../content/information/news.php">Neuigkeiten</a>
                </li>                            
            </ul>
            <div class="nav-item d-flex justify-content-end bg-info-subtle bg-opacity-25 rounded">
                <a class="btn btn-outline-info" id="loginLink" href="../../userManagement/login/login_form.php">
                    <?php
                        // uses cookie just as an example on how cookie data could be retrieved and used
                        // this is not best practise and just for experimentation
                        if (!isset($_SESSION["currentUser"]) && !isset($_COOKIE["LOGON_USER"])) {
                            echo 'Login';
                        } else {
                            echo 'Profil';
                        }
                    ?>
                </a>
            </div>
        </div>
    </div>
</nav>