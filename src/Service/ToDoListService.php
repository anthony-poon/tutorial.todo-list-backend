<?php
namespace App\Service;

use PDO;

class ToDoListService {
    private $db;
    public function __construct() {
        $this->db = new PDO(
            "mysql:dbname=todo_list;host=anthony-poon.com",
            "todo_list",
            "CTmg52oOYF"
        );
    }

    public function getItems() {
        $query = $this->db->query("SELECT * FROM todo");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}