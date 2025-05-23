<?php
class Category {
    private $conn;
    private $table = "category";

    public $id;
    public $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}
?>
