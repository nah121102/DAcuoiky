<?php
class Database {
    private $host = "localhost";
    private $db_name = "product_db";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            error_log("❌ Lỗi kết nối database: " . $exception->getMessage()); 
            return null; // Trả về null thay vì die()
        }
        return $this->conn;
    }
}
?>
// Ghi log
