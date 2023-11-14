<?php

use userManagement\UserManagementSystem;
use userManagement\User as User;

require_once('../UserManagementSystem.php');

$ums = new UserManagementSystem();
$ums->initializeUserRegistration();

$username = $_SESSION["currentUser"]->getUsername();
// FixMe: this is once again only for experimentation reasons
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

        <form method="POST" class="mt-2">
            <div class="mt-1">
                <button class="btn btn-danger" type="submit" name="submit" id="submit" value="logout">
                    Logout
                </button>
            </div>
        </form>

        <form class="col-3" method="POST">

            <div class="mb-3">
                <label for="username" class="form-label">Benutzername</label>
                <input type="text" class="form-control" name="username" id="username" disabled
                       value=<?php echo $currentUser->getUsername() ?>>
                <div id="username" class="form-text">Ihr Benutzername kann nicht geändert werden!</div>
            </div>

            <div class="mb-3">
                <label for="sex" class="form-label">Anrede</label>
                <select name="sex" id="sex" class="form-select">
                    <option selected value="Keine">Keine</option>
                    <option value="Frau">Frau</option>
                    <option value="Herr">Herr</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Vorname</label>
                <input type="text" class="form-control" name="name" id="name"
                       value=<?php echo $currentUser->getName() ?>>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Nachname</label>
                <input type="text" class="form-control" name="lastname" id="lastname"
                       value=<?php echo $currentUser->getLastname() ?>>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required
                       value=<?php echo $currentUser->getEmail() ?>>
                <div id="emailHelp" class="form-text">Wir werden Ihre E-Mailadresse niemals an Dritte weitergeben!</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Neues Passwort</label>
                <input type="password" class="form-control" name="password" id="password" required
                       value=<?php echo $currentUser->getPassword() ?>>
            </div>
            <div class="mb-3">
                <label for="password2" class="form-label">Neues Passwort bestätigen</label>
                <input type="password" class="form-control" name="password2" id="password2"
                       aria-describedby="password2Help" required
                       value=<?php echo $currentUser->getPassword() ?>>
                <div id="password2Help" class="form-text">Bitte hier das Passwort wiederholen!</div>
            </div>

            <div class="mb-3">
                <label for="oldPassword" class="form-label">Altes Passwort</label>
                <input type="password" class="form-control" name="oldPassword" id="oldPassword" required>
                <div id="oldPasswordHelp" class="form-text">Bitte das aktuelle Passwort zur Bestätigung eingeben!</div>
            </div>

            <button class="btn btn-success" type="submit" name="change" id="change">Ändern</button>
        </form>
    </div>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["change"])) {

        $enteredSex = htmlspecialchars($_POST["sex"]);
        $enteredName = htmlspecialchars($_POST["name"]);
        $enteredLastname = htmlspecialchars($_POST["lastname"]);
        $enteredEmail = htmlspecialchars($_POST["email"]);
        $enteredPassword1 = htmlspecialchars($_POST["password"]);
        $enteredPassword2 = htmlspecialchars($_POST["password2"]);
        $enteredOldPassword = htmlspecialchars($_POST["oldPassword"]);

        if ($enteredPassword1 === $enteredPassword2
            && $ums->isRegisteredUserWithCorrectPassword($currentUser->getUsername(), $enteredOldPassword)
        ) {

            $updatedUser = new User();
            $updatedUser->setAllValues(
                $currentUser->getUsername(),
                $enteredPassword1,
                $enteredSex,
                $enteredName,
                $enteredLastname,
                $enteredEmail
            );

            $ums->updateUser($updatedUser);
            $_SESSION['currentUser'] = $updatedUser;
        }
        // ToDo: else { fail }
    }
}
