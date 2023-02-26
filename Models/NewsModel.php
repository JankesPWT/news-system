<?php
namespace App\Models;

use App\Core\Model;

class NewsModel extends Model 
{  
    public function __construct() {
        parent::__construct();
    }

    public function getAll() 
    {
        // Retrieve all articles from the database
        // and return them as an array of Article objects
        $query = "SELECT * FROM news";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getById(int $id) 
    {
        $query = "SELECT n.news_id, n.title, n.text, n.created_at, n.edited_at 
                  FROM news n WHERE n.news_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getAuthorsOfNews(int $id)
    {
        $query = "SELECT * FROM news_author na
                  LEFT JOIN author a ON na.author_id=a.author_id
                  WHERE na.news_id=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createNews(string $title, string $text, int $authorId): int
    {
        $query = "INSERT INTO news (title, text, created_at) VALUES (?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$title, $text]);
        $newsId = $this->db->lastInsertId();

        $query = "INSERT INTO news_author (news_id, author_id) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$newsId, $authorId]);

        return $newsId;
    }

    public function update(int $id, string $title, string $text) 
    {
        $query = "UPDATE news SET title = ?, text = ? WHERE news_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$title, $text, $id]);
    }
    
    public function delete(int $id) 
    {
        // Delete the article from the database
        $query = "DELETE FROM news_author WHERE news_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);

        $query = "DELETE FROM news WHERE news_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    }
}