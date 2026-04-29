<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents("php://input"), true);

$conn = new mysqli("localhost", "root", "", "vit_result");

$id = $data['id'];
$mse = $data['mse'];
$ese = $data['ese'];

$conn->query("UPDATE subjects SET mse=$mse, ese=$ese WHERE id=$id");

echo "updated";
?>