<?php
include_once("../backend/products.php");

$product = new Products();

// Set the response header to JSON
// header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action == 'create') {
            // Process product data
            $data = [
                'product_name' => $_POST['product_name'],
                'product_description' => $_POST['product_description'],
                'price' => $_POST['price'],
                'category_id'=> $_POST['category_id'],
            ];

            // Process images
            $images = [];
            if (!empty($_FILES['images']['name'][0])) {
                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $image_name = $_FILES['images']['name'][$key];
                    $target_dir = "../product_image"; // Ensure this directory exists and is writable
                    $target_file = $target_dir . '/' . basename($image_name); // Fixed file path

                    // Check if the file was uploaded without errors
                    if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                        if (move_uploaded_file($tmp_name, $target_file)) {
                            $images[] = $target_file; // Store image path
                        } else {
                            echo json_encode(['status' => 'error', 'message' => "Error uploading file: " . htmlspecialchars($image_name)]);
                            exit;
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'message' => "Error with file upload: " . htmlspecialchars($image_name)]);
                        exit;
                    }
                }
            }

            // Create product and images
            $response = $product->create($data, $images);
            echo json_encode(["status" => "success", "message" => "Product created successfully", "data" => $response]);
        } elseif ($action == 'update') {
            // Retrieve form data
            $product_id = $_POST['id'];
            $product_name = $_POST['product_name'];
            $product_description = $_POST['product_description'];
            $price = $_POST['price'];
            $images_to_delete = isset($_POST['images_to_delete']) ? $_POST['images_to_delete'] : [];
            $new_images = $_FILES['new_images']; // Get the new images uploaded

            // Update product details, including handling image deletions and uploads
            $response = $product->update($product_id, $product_name, $product_description, $price, $images_to_delete, $new_images);

            echo json_encode($response); // Send response back to the client
        }elseif ($action == 'delete') {
            $product_id = $_POST['id'];
            $images = $product->getImagesByProductId($product_id);

            // Delete the product and its images
            $response = $product->delete($product_id, $images);

            if ($response) {
                echo json_encode(['status'=> 'success', 'message'=> 'deleted successfully']);
            } else {
                echo json_encode(['status'=> 'error', 'message'=> 'not found id']);
            }
        }
    }
}

if($_POST['action']=='get' && isset($_POST['id'])){
    $product_id = $_POST['id'];
    $product = $product->getProductById($product_id);

    if($product){
        echo json_encode(['status'=> 'success', 'data'=> $product]);
    }else{
        echo json_encode(['status'=> 'error', 'message'=> 'ไม่พบสินค้า']);
    }
}