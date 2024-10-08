<?php
require_once('database.php');
class Products
{
    private $conn;
    private $table_product = "products";
    private $table_product_images = "product_images";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($data, $images)
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare(
                "INSERT INTO " . $this->table_product .
                    "(product_name, product_description, price,category_id) 
                     VALUES (:product_name, :product_description, :price, :category_id)"
            );
            $stmt->bindParam(':product_name', $data['product_name']);
            $stmt->bindParam(':product_description', $data['product_description']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->execute();

            $product_id = $this->conn->lastInsertId(); //get last data inserted product id

            // insert image data
            foreach ($images as $image_url) {
                $stmt = $this->conn->prepare('INSERT INTO ' . $this->table_product_images . ' (product_id, image_url) VALUES (:product_id, :image_url)');
                $stmt->bindParam('product_id', $product_id);
                $stmt->bindParam('image_url', $image_url);
                $stmt->execute();
            }

            $this->conn->commit();
            return "Product created successfully ";
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return 'Error:' . $e->getMessage();
        }
    }

    public function getProducts()
    {
        try {
            $stmt = $this->conn->prepare(
                'SELECT p.id, 
                    p.product_name, 
                    p.product_description, 
                    p.price, 
                    c.name AS category_name, 
                    pi.image_url 
             FROM products p 
             LEFT JOIN product_images pi ON p.id = pi.product_id 
             LEFT JOIN categories c ON p.category_id = c.id'
            );
            $stmt->execute();

            $products = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $product_id = $row['id'];
                if (!isset($products[$product_id])) {
                    $products[$product_id] = [
                        'id' => $product_id,
                        'product_name' => $row['product_name'],
                        'product_description' => $row['product_description'],
                        'price' => $row['price'],
                        'images' => [],
                        'category_name' => [$row['category_name']],
                    ];
                }
                if ($row['image_url']) {
                    $products[$product_id]['images'][] = $row['image_url'];
                }
            }
            return $products;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getImagesByProductId($product_id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT image_url FROM " . $this->table_product_images .  " WHERE product_id = :product_id");
            $stmt->bindParam(':product_id', $product_id);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getProductById($product_id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_product . " WHERE id = :id");
            $stmt->bindParam(':id', $product_id);
            $stmt->execute();

            // Fetch the product details
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                // Now fetch the associated images
                $stmt = $this->conn->prepare("SELECT image_url FROM " . $this->table_product_images . " WHERE product_id = :product_id");
                $stmt->bindParam(':product_id', $product_id);
                $stmt->execute();

                // Fetch all images associated with the product
                $images = $stmt->fetchAll(PDO::FETCH_COLUMN);

                // Add images to the product array
                $product['images'] = $images;

                return $product; // Return the product with images
            } else {
                return null; // Return null if no product found
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // Return the error message
        }
    }

    public function update($product_id, $product_name, $product_descript, $price, $images_to_delete, $new_images)
    {
        try {
            $this->conn->beginTransaction();

            // update product etails
            $stmt = $this->conn->prepare(
                "UPDATE " . $this->table_product .
                    "SET product_name = :product_name, product_description = :product_description, price = :price 
                WHERE id = :id"
            );
            $stmt->bindParam("product_name", $product_name);
            $stmt->bindParam("product_description", $product_descript);
            $stmt->bindParam("price", $price);
            $stmt->bindParam(':id', $product_id);

            // delete specifie images
            if (!empty($images_to_delete)) {
                foreach ($images_to_delete as $image_url) {
                    // delete from database
                    $stmt = $this->conn->prepare('SELECT * FROM ' . $this->table_product_images . 'WHERE product_id = :product_id AND image_url = :image_url');
                    $stmt->bindParam(':id', $product_id);
                    $stmt->bindParam(':image_url', $image_url);

                    // delete file from theproduct_image dir
                    $file_path = '../product_image' . basename($image_url);
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
            }

            // handle new image
            if (isset($new_images) && !empty($new_images['name'][0])) {
                foreach ($new_images['tmp_name'] as $key => $tmp_name) {
                    $imageName = basename($new_images['name'][$key]);
                    $targetPath = '../product_image' . $imageName;

                    // check if file alreay exists to avoid overwriting
                    if (!file_exists($targetPath)) {
                        if (move_uploaded_file($tmp_name, $targetPath)) {
                            // save image
                            $stmt = $this->conn->prepare('INSERT INTO' . $this->table_product_images . "(product_id, image_url) VALUES (:product_id, :image_url)");
                            $stmt->bindParam(":product_id", $product_id);
                            $stmt->bindParam(":image_url", $image_url);
                            $stmt->execute();
                        } else {
                            throw new Exception("Coul not move uploaded file");
                        }
                    } else {
                        throw new Exception("File already exists:" . $imageName);
                    }
                }
            }

            $this->conn->commit();
            return 'Product updated successfully';
        } catch (PDOException $e) {
            // Rollback the transaction if something failed
            $this->conn->rollBack();
            return "Error: " . $e->getMessage();
        }
    }

    public function delete($product_id, $images)
    {
        try {
            // Delete product images from the database
            $stmt = $this->conn->prepare("DELETE FROM " . $this->table_product_images . " WHERE product_id = :product_id");
            $stmt->bindParam(':product_id', $product_id);
            $stmt->execute();

            // Delete images from the uploads directory
            foreach ($images as $image) {
                if (file_exists($image)) {
                    unlink($image); // Delete the image file
                }
            }

            // Finally, delete the product
            $stmt = $this->conn->prepare("DELETE FROM " . $this->table_product . " WHERE id = :id");
            $stmt->bindParam(':id', $product_id);
            $stmt->execute();

            return "Product and associated images deleted successfully.";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
