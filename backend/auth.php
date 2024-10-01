<?php
function checkUserRole($role)
{
    if (!isset($_SESSION["userInfo"]) || $_SESSION["userInfo"]['role'] != $role) {
        header('Location: ../index.php');
    }

    // print_r($_SESSION['userInfo']);
}
