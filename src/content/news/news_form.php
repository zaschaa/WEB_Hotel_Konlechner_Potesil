<?php    
    require_once('../../userManagement/User.php');
    // Start or continue a session
    session_start();
?>

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
    require "./NewsArticle.php";
    include '../../navigation/navbar/topNavBar.php';
    include "news_logic.php";
    ?>
</header>

<main>
    <div class="container justify-content-left">
        <h1>Neuigkeiten</h1>
        
        <h2>Hier erhalten Sie aktuelle Informationen!</h2>

        <div class="news-container mb-3">
            <div class="border-bottom border-2 mb-3">
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
            
            <?php
                $formattedArticles = getAndFormatAllNewsArticles();
            ?>

            <?php
            foreach ($formattedArticles as $article) { 
                $id = $article->getId();
                $thumbnail = $article->getThumbnailPath();
                $headline = $article->getHeadline();
                $description = $article->getDescription();
                $createdAt = date("d.m.Y H:i", date_timestamp_get(date_create($article->getCreatedAt())));
            ?>                                        
                <div class="d-flex flex-column border-bottom border-2 mb-3">
                    
                    <div>
                        <?php echo "<p>$createdAt</p>"; ?>                   
                    </div>
                    <div>
                        <?php echo "<h2>$headline</h2>"; ?>                    
                    </div>
                    <div class="mb-3">                            
                        <?php echo "<img src='$thumbnail' alt='Thumbnail'>"; ?>                                                    
                    </div>                      
                    <div class="mb-3">                                                         
                        <?php echo "<p>$description</p>"; ?>                          
                    </div>  
                    <div class="mb-3">
                        <?php if(isset($_SESSION["currentUser"]) && $_SESSION["currentUser"]->isAdmin()): ?>
                            <form method="POST">
                                <button class="btn btn-danger" type="submit" id="delete" name="delete" value="<?php echo $id; ?>">
                                    Löschen
                                </button>
                            </form>
                        <?php endif; ?>
                    </div> 
                        
                </div>                            
                
            <?php 
            } 
            ?>           

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