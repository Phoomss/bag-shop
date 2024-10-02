<?php
require_once '../backend/categories.php';

// สร้าง object ของ Categories
$category = new Categories();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action == 'create') {
            $name = $_POST['name'];
            $category->name = $name;

            if ($category->create()) {
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Category created successfully',
                    'data' => $category
                ));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to create category.'));
            }
        } elseif ($action == 'update') {
            $id = $_POST['id'];
            $name = $_POST['name'];

            if ($category->update($id, $name)) {
                echo json_encode(array('status' => 'success', 'message' => 'Category updated successfully.'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to update category.'));
            }
        } elseif ($action == 'delete') {
            $id = $_POST['id'];

            if ($category->delete($id)) {
                echo json_encode(array('status' => 'success', 'message' => 'Category deleted successfully.'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to delete category.'));
            }
        }
    }
}

// ตรวจสอบว่ามี action และ id ที่ต้องการหรือไม่
if ($_POST['action'] == 'get' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $category = $category->getCategoryById($id); // สร้างฟังก์ชัน getCategoryById ในคลาส Categories
    if ($category) {
        echo json_encode(['status' => 'success', 'data' => $category]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ไม่พบประเภทสินค้าที่ต้องการ']);
    }
}

