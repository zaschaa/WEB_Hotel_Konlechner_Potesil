<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>

    <title>News</title>
    <link rel="stylesheet" href="../../styles.css"/>
</head>
<body class="bgColor bg-gradient">
<header>
    <?php
    require_once "../../userManagement/User.php";
    require_once "./NewsArticle.php";
    include '../../navigation/navbar/topNavBar.php';
    include "news_logic.php";
    ?>
</header>

<main>
    <div class="container justify-content-left">
        <h1>Neuigkeiten</h1>
        <h2>Hier erfahren Sie den neuesten heißesten Scheiß!</h2>

        <div class="news-container">
            <div>
                <?php
                if (isset($_SESSION["currentUser"]) && $_SESSION["currentUser"]->isAdmin()) {
                    ?>
                    <p class="d-inline-flex gap-1">

                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#createArticleField" role="button"
                           aria-expanded="false" aria-controls="collapseExample">
                            Neuen News-Artikel anlegen
                        </a>
                    </p>
                    <div class="collapse" id="createArticleField">
                        <div class="card card-body">
                            <?php
                            include "filemanagement/file_upload_form.php"
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div>
                <?php
                $formattedArticles = getAndFormatAllNewsArticles();
                foreach ($formattedArticles as $article) {
                    $foo = $article->getThumbnailPath();
                        echo "<img src='$foo' alt='moo'>";
                }
                ?>
            </div>
        </div>
    </div>
</main>

<footer>
    <?php
    include '../../navigation/footer/footerNav.php';
    ?>
</footer>
</body>
</html>