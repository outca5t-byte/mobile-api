<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require "connect.php";

$fname = $_GET["fname"];
$sname = $_GET["sname"];
$email = $_GET["email"];
$phone = $_GET["phone"];
$password = md5($_GET['password'] ?? '');
$flag = array();
$flag['success'] = 0;

$sql = "INSERT INTO users (fname, sname, email, phone, password)
        VALUES ('$fname', '$sname', '$email', '$phone', '$password')";

if (mysqli_query($con, $sql)) {
    $flag['success'] = 1;
}

echo json_encode($flag);

mysqli_close($con);
?>