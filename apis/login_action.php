<?php
session_start();
include_once("../config/database.php");
include_once("../backend/user.php");

$database  = new Database();
$db = $database->getConnection();

$user = new User($db);

$response = [
    "status" => "error",
    'message' => 'Invalid email or password'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debugging lines
    error_log("POST data: " . print_r($_POST, true));

    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    if ($user->login()) {
        // Ensure this matches your session structure
        $role = $_SESSION['userInfo']['role']; // Ensure 'role' is set correctly in login()

        // Debugging: print the role
        error_log("Logged in user role: " . $role);

        $response = [
            "status" => "success",
            "role" => $role // Use 'role' to match JavaScript
        ];
    } else {
        error_log("Login failed for email: " . $user->email);
    }
    echo json_encode($response);
    error_log("Response JSON: " . json_encode($response));
    exit; // เพิ่ม exit เพื่อหยุดการประมวลผลที่เหลือ
}
