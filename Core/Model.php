<?php
namespace App\Core;

use App\Core\Database;

class Model
{
    public Database $db;

    public function __construct()
    {
        $this->db = new Database;
    }
}