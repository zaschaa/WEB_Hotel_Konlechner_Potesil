<?php
include 'file_upload_logic.php';

// if(isset($_SESSION["news"])) : var_dump($_SESSION["news"]); endif;
// phpinfo();
?>

<h3>Neuen Newsartikel anlegen</h3>
<form method="POST" enctype="multipart/form-data" class="flex-column">
    <input type="file" id="file" name="file">

    <div class="newsTextInputField">
        <label for="headline" class="form-label col-lg-2">Überschrift</label>
        <input type="text" id="headline" name="headline">
    </div>

    <div class="newsTextInputField">
        <label for="description" class="form-label col-lg-2">Beschreibung</label>
        <input type="text" id="description" name="description">
    </div>
    <input class="btn btn-success" type="submit" id="submit" value="Hochladen">
</form>

<ul>
    <?php
    // listAllFilesInDirectory()
    ?>
</ul>