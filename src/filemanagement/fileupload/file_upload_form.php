<?php
    include 'file_upload_logic.php';
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
    <?php
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
</main>

<footer>
    <?php
    include '../../navigation/footer/footerNav.php';
    ?>
</footer>
</body>
</html>