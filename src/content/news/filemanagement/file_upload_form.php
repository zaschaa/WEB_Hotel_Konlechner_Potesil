<?php
include 'file_upload_logic.php';

// if(isset($_SESSION["news"])) : var_dump($_SESSION["news"]); endif;
// phpinfo();
?>

<h3> File Upload</h3>
<form method="POST" enctype="multipart/form-data">
    <input type="file" id="file" name="file">

    <label for="headline">
    </label>
    <input type="text" id="headline" name="headline">

    <label for="description"></label>
    <input type="text" id="description" name="description">
    <input class="btn btn-success" type="submit" id="submit" value="Hochladen">
</form>

<ul>
    <?php
    listAllFilesInDirectory()
    ?>
</ul>