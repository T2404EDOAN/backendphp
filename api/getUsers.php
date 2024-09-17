<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT id, name, email FROM users";
$stmt = $db->prepare($query);
$stmt->execute();

$users = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $user = array(
        "id" => $row['id'],
        "name" => $row['name'],
        "email" => $row['email']
    );
    array_push($users, $user);
}

echo json_encode($users);
