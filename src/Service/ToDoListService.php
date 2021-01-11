<?php
namespace App\Service;

use PDO;

class ToDoListService {
    private $db;
    public function __construct() {
        // Connect to a database on start
        $this->db = new PDO(
            "mysql:host=anthony-poon.com;dbname=todo_list",
            "todo_list",
            "CTmg52oOYF"
        );
    }

    public function addItem(string $itemName) {
        // Add an item to the database
        $query = $this->db->prepare("
            INSERT INTO
                todo
                (item_name)
            VALUES
                (:item_name)
        ");
        $query->bindValue(":item_name", $itemName);
        $query->execute();
    }

    public function getItems() {
        // Retrieve all items from database
        $query = $this->db->prepare("
            SELECT
                *
            FROM todo
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}