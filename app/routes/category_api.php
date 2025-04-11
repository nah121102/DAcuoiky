<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

require_once __DIR__ . "/../controllers/CategoryController.php";

$method = $_SERVER['REQUEST_METHOD'];
$categoryController = new CategoryController();
$input = json_decode(file_get_contents("php://input"));

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = null;
}

switch ($method) {
    case 'GET':
        if ($id) {
            $response = $categoryController->show($id);
        } else {
            $response = $categoryController->index();
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        break;

    case 'POST':
        if (!empty($input->name)) {
            $result = $categoryController->store($input->name);
            echo json_encode(["success" => $result], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => "Thiếu dữ liệu"], JSON_UNESCAPED_UNICODE);
        }
        break;

    case 'PUT':
        if ($id && !empty($input->name)) {
            $result = $categoryController->update($id, $input->name);
            echo json_encode(["success" => $result], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => "Thiếu dữ liệu"], JSON_UNESCAPED_UNICODE);
        }
        break;

    case 'DELETE':
        if ($id) {
            $result = $categoryController->delete($id);
            echo json_encode(["success" => $result], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => "Thiếu ID"], JSON_UNESCAPED_UNICODE);
        }
        break;

    default:
        echo json_encode(["error" => "Phương thức không được hỗ trợ"], JSON_UNESCAPED_UNICODE);
        break;
}
?>
