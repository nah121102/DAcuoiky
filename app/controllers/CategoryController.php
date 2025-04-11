<?php
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../models/Category.php"; // Đảm bảo đúng đường dẫn

class CategoryController {
    private $db;
    private $category;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->category = new Category($this->db);
    }

    public function index() {
        return $this->category->getAll()->fetchAll(PDO::FETCH_ASSOC);
    }

    public function store($name) {
        $this->category->name = $name;
        return $this->category->create();
    }

    public function update($id, $name) {
        $this->category->id = $id;
        $this->category->name = $name;
        return $this->category->update();
    }

    public function delete($id) {
        $this->category->id = $id;
        return $this->category->delete();
    }
}

// Khởi tạo controller
$categoryController = new CategoryController();
$categories = $categoryController->index();
?>
