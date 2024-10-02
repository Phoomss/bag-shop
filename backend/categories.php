<?php
require_once('database.php');

class Categories
{
  private $conn;
  private $table_name = "categories";
  public $name;

  public function __construct()
  {
    $database  = new Database();
    $this->conn = $database->getConnection();
  }

  public function getCategories()
  {
    $query = 'SELECT * FROM ' . $this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function create()
  {
    $query = 'INSERT INTO ' . $this->table_name . ' (name) VALUES (:name)';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':name', $this->name);
    return $stmt->execute();
  }

  public function update($id,$name)
  {
    $query = 'UPDATE ' . $this->table_name . ' SET name = :name WHERE id = :id';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  public function delete($id)
  {
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE id = :id';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  public function getCategoryById($id)
  {
      $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  

}

