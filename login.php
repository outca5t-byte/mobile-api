<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

require_once "connect.php";

$phone = $_GET['phone'] ?? '';
$password = md5($_GET['password'] ?? '');

if (empty($phone) || empty($password)) {
    echo json_encode([
        'code' => 0,
        'message' => 'phone and password are required.'
    ]);
    exit;
}

$query = mysqli_query($con, "
SELECT fname, sname, email, phone 
FROM users 
WHERE phone = '$phone' AND password = '$password'
");

if (mysqli_num_rows($query) > 0) {

    $rows = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $rows[] = $row;
    }

    echo json_encode([
        'code' => 1,
        'users' => $rows
    ]);

} else {
    echo json_encode([
        'code' => 0,
        'message' => 'Invalid phone or password.'
    ]);
}

mysqli_close($con);
?>