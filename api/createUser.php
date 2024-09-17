<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

// Nhận dữ liệu JSON từ request
$data = json_decode(file_get_contents("php://input"));

// Kiểm tra xem dữ liệu có hợp lệ và có các trường cần thiết hay không
if (isset($data->name) && isset($data->email)) {
    // Chuẩn bị câu lệnh SQL để thêm người dùng
    $query = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $stmt = $db->prepare($query);

    // Gắn các giá trị từ dữ liệu JSON
    $stmt->bindParam(":name", $data->name);
    $stmt->bindParam(":email", $data->email);

    // Thực thi câu lệnh và trả về kết quả
    if ($stmt->execute()) {
        echo json_encode(array("message" => "User created successfully."));
    } else {
        echo json_encode(array("message" => "Unable to create user."));
    }
} else {
    // Trả về thông báo lỗi nếu dữ liệu không hợp lệ
    echo json_encode(array("message" => "Invalid input. Name and email are required."));
}
