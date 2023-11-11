<?php
include './login_logic.php';
?>

<!DOCTYPE html>
<html lang="DE">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>

    <title>Login</title>

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

        <?php if (!isset($_SESSION["currentUser"])) : ?>
            <form method="POST" class="mt-2">
                <table>
                    <tr>
                        <td>
                            <label for="username">Benutzername</label>
                        </td>
                        <td>
                            <input type="text" name="username" id="username" required/>
                            <!--name attribut legt Name des Parameters beim Absenden des Requests fest-->
                        </td>
                    </tr>
                    <tr>
                        <td><label for="password">Passwort</label></td>
                        <td><input type="password" name="password" id="password" required/></td>
                    </tr>
                </table>

                <div class="mt-1">
                    <button class="btn btn-danger" type="reset" name="reset">Reset</button>
                    <button class="btn btn-success" type="submit" name="submit" id="submit" value="login">Login</button>
                </div>
            </form>

            <div class="mb-3">
                <p>Noch kein Profil angelegt? Hier können Sie sich
                    <a href="../registration/registration_form.php">registrieren.</a>
                </p>
            </div>

        <?php
        // FixMe: this is once again only for experimentation reasons
        else:
            $username = $_SESSION["currentUser"]->getUsername();
            echo "<script> console.log('Currently logged in as: $username ' )</script>";
            ?>

            <div>
                <h1>
                    Willkommen
                    <?php
                    $currentUser = $_SESSION["currentUser"];
                    if ($currentUser->getSex() !== "Keine") {
                        echo $currentUser->getSex()
                            . " "
                            . $currentUser->getName()
                            . " "
                            . $currentUser->getLastname()
                            . "!";
                    } else {
                        echo $currentUser->getName()
                            . " "
                            . $currentUser->getLastname()
                            . "!";
                    }
                    ?>
                </h1>
            </div>

            <form method="POST" class="mt-2">
                <div class="mt-1">
                    <button class="btn btn-danger" type="submit" name="submit" id="submit" value="logout">
                        Logout
                    </button>
                </div>
            </form>

        <?php
        endif;
        ?>
    </div>
</main>

<footer>
    <?php
    include '../../navigation/footer/footerNav.php';
    ?>
</footer>
</body>
</html>