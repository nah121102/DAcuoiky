<?php
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../models/Product.php";

class ProductController {
    private $db;
    private $product;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($this->db);
    }

    public function index() {
        return $this->product->getAll();
    }

    public function show($id) {
        return $this->product->getById($id);
    }

    public function create($data) {
        $this->product->name = $data->name;
        $this->product->price = $data->price;
        $this->product->category_id = $data->category_id;
        return $this->product->create();
    }

    public function update($id, $data) {
        $this->product->id = $id;
        $this->product->name = $data->name;
        $this->product->price = $data->price;
        $this->product->category_id = $data->category_id;
        return $this->product->update();
    }

    public function delete($id) {
        $this->product->id = $id;
        return $this->product->delete();
    }
}
?>
