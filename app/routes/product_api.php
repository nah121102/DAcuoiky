<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

require_once __DIR__ . "/../controllers/ProductController.php";

$method = $_SERVER['REQUEST_METHOD'];
$productController = new ProductController();
$input = json_decode(file_get_contents("php://input"));

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = null;
}

switch ($method) {
    case 'GET':
        if ($id) {
            $response = $productController->show($id);
        } else {
            $response = $productController->index();
        }
        echo json_encode($response);
        break;

    case 'POST':
        if (!empty($input->name) && !empty($input->price) && !empty($input->category_id)) {
            $result = $productController->create($input);
            echo json_encode(["success" => $result]);
        } else {
            echo json_encode(["error" => "Thiếu dữ liệu"]);
        }
        break;

    case 'PUT':
        if ($id && !empty($input->name) && !empty($input->price) && !empty($input->category_id)) {
            $result = $productController->update($id, $input);
            echo json_encode(["success" => $result]);
        } else {
            echo json_encode(["error" => "Thiếu dữ liệu"]);
        }
        break;

    case 'DELETE':
        if ($id) {
            $result = $productController->delete($id);
            echo json_encode(["success" => $result]);
        } else {
            echo json_encode(["error" => "Thiếu ID"]);
        }
        break;

    default:
        echo json_encode(["error" => "Phương thức không được hỗ trợ"]);
        break;
}
?>
