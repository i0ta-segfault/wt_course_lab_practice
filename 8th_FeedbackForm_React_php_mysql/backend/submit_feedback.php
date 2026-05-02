<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !isset($data['name'], $data['course'], $data['message'])) {
    echo json_encode(["error" => "Invalid input"]);
    exit();
}
$conn = new mysqli("localhost", "root", "", "feedback_db");

$name = $data['name'];
$course = $data['course'];
$message = $data['message'];

$conn->query("INSERT INTO feedback (name, course, message)
VALUES ('$name', '$course', '$message')");

echo "Submitted";
?>