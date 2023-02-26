<?php
namespace App\Models;

use App\Core\Model;

class AuthorModel extends Model 
{  
    public function __construct() {
        parent::__construct();
    }

    public function getByName($name) {
        // Retrieve the author with the given ID from the database
        // and return it as an Author object
        $query = "SELECT author_id, name FROM author WHERE name = :name";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":name", $name);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    } 

    public function createAuthor($name) {
        // Save the author to the database
        $sql = "INSERT INTO author (name, created_at) VALUES (?, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($name);
        $authorId = $this->db->lastInsertId();

        return $authorId;
    } 

    public function getTopAuthorsLastWeek() 
    {

        $query = "SELECT author.*, COUNT(news_author.news_id) AS news_count 
                FROM author 
                JOIN news_author ON author.author_id = news_author.author_id 
                JOIN news ON news_author.news_id= news.news_id 
                WHERE news.created_at >= DATE_SUB(NOW(), INTERVAL 1 WEEK) 
                GROUP BY author.author_id 
                ORDER BY news_count DESC 
                LIMIT 3";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
