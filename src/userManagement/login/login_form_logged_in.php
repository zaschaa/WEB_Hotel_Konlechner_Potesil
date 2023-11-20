<?php

use userManagement\User as User;
use userManagement\UserManagementSystem;

require_once('../UserManagementSystem.php');

$ums = new UserManagementSystem();
$ums->initializeUserRegistration();

$currentUser = $_SESSION["currentUser"];

$username = $_SESSION["currentUser"]->getUsername();
// FixMe: this is once again only for experimentation reasons
echo "<script> console.log('Currently logged in as: $username ' )</script>";

$isUpdateInputValid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["change"])) {

        $enteredSex = $ums->prepareInput($_POST["sex"]);
        $enteredName = $ums->prepareInput($_POST["name"]);
        $enteredLastname = $ums->prepareInput($_POST["lastname"]);
        $enteredEmail = $ums->prepareInput($_POST["email"]);
        $enteredPassword1 = $ums->prepareInput($_POST["password"]);
        $enteredPassword2 = $ums->prepareInput($_POST["password2"]);
        $enteredOldPassword = $ums->prepareInput($_POST["oldPassword"]);

        if($enteredEmail != $currentUser->getEmail()) {
            $isValidEmail = $ums->isValidEmail($enteredEmail);
            $emailErrMessage = $ums->getEmailErrMessage();  
        } else {
            $isValidEmail = true;
        }

        if($enteredPassword1 != $currentUser->getPassword()) {
            $isValidPassword = $ums->isValidPassword($enteredPassword1, $enteredPassword2);
            $pwErrMessage = $ums->getPwErrMessage();  
        } else {
            $isValidPassword = true;
        }        

        $isUpdateInputValid = $isValidEmail && $isValidPassword && $ums->isRegisteredUserWithCorrectPassword($currentUser->getUsername(), $enteredOldPassword);

        if ($isUpdateInputValid) 
        {
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

?>

<div>
    <h1>
        Willkommen
        <?php        
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

        if($isUpdateInputValid) {
            echo "<p class=" . "text-danger" . ">Die Änderung wurde übernommen!</p>";
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
                <option <?php if($currentUser->getSex()==="Keine") {echo "selected";} ?> value="Keine">Keine</option>
                <option <?php if($currentUser->getSex()==="Frau") {echo "selected";} ?> value="Frau">Frau</option>
                <option <?php if($currentUser->getSex()==="Herr") {echo "selected";} ?> value="Herr">Herr</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Vorname</label>
            <input type="text" class="form-control" name="name" id="name"
                    value=<?php if(isset($enteredName)) { echo $enteredName;} else {echo $currentUser->getName();} ?>>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Nachname</label>
            <input type="text" class="form-control" name="lastname" id="lastname"
                    value=<?php if(isset($enteredLastname)) { echo $enteredLastname;} else {echo $currentUser->getLastname();} ?>>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?php if(isset($emailErrMessage)) {echo "is-invalid";}?>" name="email" id="email" aria-describedby="emailHelp" required
                    value=<?php if(isset($enteredEmail)) { echo $enteredEmail;} else {echo $currentUser->getEmail();} ?>>
            <div id="emailHelp" class="form-text <?php if(isset($emailErrMessage)) {echo "text-danger";}?>"><?php if(isset($emailErrMessage)) { echo $emailErrMessage; } else { echo "Wir werden Ihre E-Mailadresse niemals an Dritte weitergeben!";} ?></div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Neues Passwort</label>
            <input type="password" class="form-control <?php if(isset($pwErrMessage)) {echo "is-invalid";}?>" name="password" id="password" aria-describedby="passwordHelp" required
                    value=<?php if(isset($enteredPassword1)) { echo $enteredPassword1;} else {echo $currentUser->getPassword();} ?>>
            <div id="passwordHelp" class="form-text <?php if(isset($pwErrMessage)) {echo "text-danger";}?>"><?php if(isset($pwErrMessage)) { echo $pwErrMessage;} ?></div>        
        </div>
        <div class="mb-3">
            <label for="password2" class="form-label">Neues Passwort bestätigen</label>
            <input type="password" class="form-control <?php if(isset($pwErrMessage)) {echo "is-invalid";}?>" name="password2" id="password2" aria-describedby="password2Help" required
                    value=<?php if(isset($enteredPassword2)) { echo $enteredPassword2;} else {echo $currentUser->getPassword();} ?>>
            <div id="password2Help" class="form-text <?php if(isset($pwErrMessage)) {echo "text-danger";}?>"><?php if(isset($pwErrMessage)) { echo $pwErrMessage;} else {echo "Bitte hier das Passwort wiederholen!";} ?></div>
        </div>
        <div class="mb-3">
            <label for="oldPassword" class="form-label">Altes Passwort</label>
            <input type="password" class="form-control <?php if(isset($enteredOldPassword)) {if($currentUser->getPassword() != $enteredOldPassword) {echo "is-invalid";}}?>" name="oldPassword" id="oldPassword" aria-describedby="oldPasswordHelp" required>
            <div id="oldPasswordHelp" class="form-text <?php if(isset($enteredOldPassword)) {if($currentUser->getPassword() != $enteredOldPassword) {echo "text-danger";}}?>"><?php if(isset($enteredOldPassword)) {if($currentUser->getPassword() != $enteredOldPassword) {echo "Falsches Passwort!";} else {echo "Bitte das aktuelle Passwort zur Bestätigung eingeben!";}} ?></div>
        </div>

        <button class="btn btn-success" type="submit" name="change" id="change">Ändern</button>
    </form>
</div>


