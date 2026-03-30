<?php

class CategoryModel{
    protected $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    // Lấy tất cả danh mục
    public function getAll(){
        $sql = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh mục theo ID
    public function getById($id){
        $sql = "SELECT * FROM categories WHERE category_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm danh mục mới
    public function add($name, $description = null){
        $sql = "INSERT INTO categories (category_name, description) VALUES (:name, :description)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    // Cập nhật danh mục
    public function update($id, $name, $description = null){
        $sql = "UPDATE categories SET category_name = :name, description = :description WHERE category_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    // Xóa danh mục không có liên kết với sản phẩm
    public function delete($id){
        $sql = 'DELETE FROM categories WHERE category_id = :id AND NOT EXISTS (SELECT 1 FROM books WHERE category_id = :id)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // Kiểm tra số dòng bị ảnh hưởng
        return $stmt->rowCount() > 0;
    }
}