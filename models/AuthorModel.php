<?php

class AuthorModel{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM authors");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM authors WHERE author_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($name, $bio)
    {
        $sql = "INSERT INTO authors (author_name, biography) VALUES (:author_name, :bio)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':author_name', $name);
        $stmt->bindParam(':bio', $bio);
        return $stmt->execute();
    }

    public function update($id, $name, $bio)
    {
        $sql = "UPDATE authors SET author_name = :author_name, biography = :bio WHERE author_id = :id";
        $stmt = $this->conn->prepare($sql);
        $data = [
            'author_name' => $name,
            'bio' => $bio,
            'id' => $id
        ];
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        // Kiểm tra xem author có liên kết với bảng books không
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM books WHERE author_id = ?");
        $stmt->execute([$id]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // Không thể xóa nếu có liên kết
            return false;
        }

        $stmt = $this->conn->prepare("DELETE FROM authors WHERE author_id = ?");
        return $stmt->execute([$id]);
    }

}