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