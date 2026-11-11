<?php
namespace App\Models;

require_once __DIR__ . '/../../config/database.php';
use App\Config\Database;
use PDO;

class BaseModel {
    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }
}