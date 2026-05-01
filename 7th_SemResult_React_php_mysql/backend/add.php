<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "vit_result");

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'];
$course = $data['course'];

$conn->query("INSERT INTO marks (name, course) VALUES ('$name', '$course')");

echo "added";
?>