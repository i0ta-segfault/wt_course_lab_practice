<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !isset($data['id'], $data['mse'], $data['ese'])) {
    echo json_encode(["error" => "Invalid input"]);
    exit();
}
$conn = new mysqli("localhost", "root", "", "vit_result");

$id = $data['id'];
$mse = $data['mse'];
$ese = $data['ese'];

$conn->query("UPDATE subjects SET mse=$mse, ese=$ese WHERE id=$id");

echo "updated";
?>