<?php
include 'file_upload_logic.php';

// phpinfo();
?>

<h3> File Upload</h3>
<form method="POST" enctype="multipart/form-data">
    <input type="file" id="file" name="file">
    <input class="btn btn-success" type="submit" id="submit" value="Hochladen">
</form>

<ul>
    <?php
    listAllFilesInDirectory()
    ?>
</ul>