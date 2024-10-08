<?php
include_once("../backend/database.php");
include_once("../backend/user.php");

$database  = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->username = $_POST["username"];
$user->phone = $_POST['phone'];
$user->address = $_POST['address'];
$user->cityId = $_POST['cityId'];
$user->email = $_POST['email'];
$user->password = $_POST['password'];
$user->role = $_POST['role'];


if ($user->register()) {
    echo "Registration successful!";
} else {
    echo "Registration failed!";
}
