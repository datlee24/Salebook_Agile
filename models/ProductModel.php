<?php
class ProductModel
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll($keyword = '')
    {
        if ($keyword) {
            $sql = "SELECT b.*, a.author_name AS author_name, c.category_name AS category_name 
                    FROM books b 
                    LEFT JOIN authors a ON b.author_id = a.author_id 
                    LEFT JOIN categories c ON b.category_id = c.category_id
                    WHERE b.title LIKE :keyword";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['keyword' => "%$keyword%"]);
        } else {
            $sql = "SELECT b.*, a.author_name AS author_name, c.category_name AS category_name 
                    FROM books b 
                    LEFT JOIN authors a ON b.author_id = a.author_id 
                    LEFT JOIN categories c ON b.category_id = c.category_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->conn->prepare("SELECT b.*, a.author_name AS author_name, c.category_name AS category_name 
                                      FROM books b 
                                      LEFT JOIN authors a ON b.author_id = a.author_id 
                                      LEFT JOIN categories c ON b.category_id = c.category_id 
                                      WHERE b.book_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($title, $description, $price, $stock_quantity, $category_id, $author_id, $cover_image)
    {
        $sql = "INSERT INTO books (title, author_id, category_id, description, cover_image, price, stock_quantity) 
                VALUES (:title, :author_id, :category_id, :description, :cover_image, :price, :stock_quantity)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':cover_image', $cover_image);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock_quantity', $stock_quantity);
        return $stmt->execute();
    }

    public function update($id, $title, $description, $price, $stock_quantity, $category_id, $author_id, $cover_image)
    {
        $sql = "UPDATE books 
                SET title = :title, author_id = :author_id, category_id = :category_id, description = :description, cover_image = :cover_image, price = :price, stock_quantity = :stock_quantity 
                WHERE book_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':cover_image', $cover_image);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock_quantity', $stock_quantity);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM books WHERE book_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getByCategory($category_id) {
        $sql = "SELECT b.*, a.author_name AS author_name, c.category_name AS category_name 
                FROM books b 
                LEFT JOIN authors a ON b.author_id = a.author_id 
                LEFT JOIN categories c ON b.category_id = c.category_id
                WHERE b.category_id = :category_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}