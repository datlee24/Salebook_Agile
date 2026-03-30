<?php
class UserModel
{
    protected $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM users WHERE user_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Kiểm tra email đã tồn tại trong cơ sở dữ liệu
    // Trả về thông tin người dùng nếu tồn tại, không thì trả về null
    public function checkEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return null; // Không tìm thấy người dùng
        }
    }

    // Thêm người dùng mới vào cơ sở dữ liệu
    public function addUser($full_name, $email, $password, $phone, $address)
    {
        $sql = 'INSERT INTO users (full_name, email, password, phone, address, role) VALUES (:full_name, :email, :password, :phone, :address, "user")';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        return $stmt->execute();
    }
}
