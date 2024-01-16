<?php

require_once 'NewsArticle.php';

class NewsManagementSystem
{

    public function getAllNews()
    {       
        require_once 'NewsArticle.php';
        require '../../database/dbaccess.php';       
        
        $allNewsArticles = array();
            
        $sqlSelect = 
        "SELECT id, user_id, headline, `description`, image_path, thumbnail_path, created_at
        FROM news_articles
        ORDER BY created_at DESC;";        
    
        $result = $connection->query($sqlSelect);     
                    
        while($row = $result->fetch_assoc()) {

            $id = $row["id"];
            $userId = $row["user_id"]; 
            $headline = $row["headline"];
            $description = $row["description"];  
            $image_path = $row["image_path"];  
            $thumbnail_path = $row["thumbnail_path"];                       
            $createdAt = $row["created_at"];                    
            
            $newsArticle = new NewsArticle($id, $userId, $headline, $description, $image_path, $thumbnail_path, $createdAt);
            
            array_push($allNewsArticles, $newsArticle);
        }            

        $connection->close();

        return $allNewsArticles;
    }


    public function getNewsArticleById($id)
    {       
        require_once 'NewsArticle.php';
        require '../../database/dbaccess.php';       
        
        $newsArticle;
            
        $sqlSelect = 
        "SELECT id, user_id, headline, `description`, image_path, thumbnail_path, created_at
        FROM news_articles
        WHERE id = ?;";        

        $statement = $connection->prepare($sqlSelect);
        $statement->bind_param("i", $id);
        $statement->execute();        

        $statement->bind_result($id, $userId, $headline, $description, $image_path, $thumbnail_path, $createdAt);                  

        $statement->fetch();    
        $statement->close();        
        $connection->close();  

        $newsArticle = new NewsArticle($id, $userId, $headline, $description, $image_path, $thumbnail_path, $createdAt);
    
        return $newsArticle;
    }

    public function saveNewsArticleToDatabase(NewsArticle $newsArticle)
    {        
        require_once 'NewsArticle.php';
        require '../../database/dbaccess.php';                    
        
        $sqlInsert = 
        "INSERT INTO `news_articles` (`user_id`, `headline`, `description`, `image_path`, `thumbnail_path`) 
        VALUES (?, ?, ?, ?, ?);"; # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!        

        $userId = $newsArticle->getUserId();
        $headline = $newsArticle->getHeadline();        
        $description = $newsArticle->getDescription();
        $imagePath = $newsArticle->getImagePath();
        $thumbnailPath = $newsArticle->getThumbnailPath();        

        $statement = $connection->prepare($sqlInsert);
        $statement->bind_param("issss", $userId, $headline, $description, $imagePath, $thumbnailPath);
        $result = $statement->execute();
          
        $statement->close();        
        $connection->close();

        return $result;       
    }

    public function deleteArticle($id)
    {        
        require_once 'NewsArticle.php';
        require '../../database/dbaccess.php';     
        
        $newsArticle = $this->getNewsArticleById($id);

        unlink($newsArticle->getImagePath());
        unlink($newsArticle->getThumbnailPath());
                
        $sqlDelete = 
        "DELETE FROM `news_articles` 
         WHERE id = ?;"; # ? --> placeholder in prepared statement !!! Avoid SQL injection !!!        
   
        $statement = $connection->prepare($sqlDelete);
        $statement->bind_param("i", $id);
        $result = $statement->execute();
          
        $statement->close();        
        $connection->close();

        return $result;       
    }

}