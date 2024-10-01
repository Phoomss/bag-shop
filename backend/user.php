<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class User
{
    private $conn;
    private $table = 'users';
    public $username;
    public $phone;
    public $address;
    public $cityId;
    public $email;
    public $password;
    public $role;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register()
    {
        $query = 'INSERT INTO ' . $this->table . ' (username, phone, address, cityId, email, password, role) VALUES (:username, :phone, :address, :cityId, :email, :password, :role)';
        $stmt = $this->conn->prepare($query);

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':cityId', $this->cityId);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function login()
    {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1"; // Update the table name as needed
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($this->password, $user['password'])) { // Ensure passwords are hashed
            $_SESSION['userInfo'] = $user;
            return true;
        }
        return false;
    }
}
