<?php

class ProductController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function showAll()
    {
        $keyword = $_GET['keyword'] ?? '';
        $products = $this->productModel->getAll($keyword);
        require_once PATH_CLIENT . 'home.php';
    }

    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = "Sản phẩm không tồn tại";
            header('Location: ' . BASE_URL);
            return;
        }
        $productModel = new ProductModel();
        // $commentModel = new CommentModel();

        $product = $productModel->findById($id);
        // $comments = $commentModel->getByBookId($id);

        require_once PATH_CLIENT . 'product/detail.php';
    }

//     public function sendComment()
//     {
//         if (!isset($_SESSION['user'])) {
//             header('Location: index.php?act=login');
//             exit;
//         }

//         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//             $user_id = $_SESSION['user']['user_id'];
//             $book_id = $_POST['book_id'] ?? null;
//             $comment_text = trim($_POST['comment_text'] ?? '');

//             if ($book_id && $comment_text !== '') {
//                 $commentModel = new CommentModel();
//                 $commentModel->addComment($user_id, $book_id, $comment_text);
//             }
//             header('Location: index.php?act=product_detail&id=' . $book_id);
//             exit;
//         }
//         // Nếu không phải POST, chuyển về trang chủ
//         header('Location: index.php');
//         exit;
//     }

//     public function byCategory()
//     {
//         $category_id = $_GET['category_id'] ?? null;
//         if (!$category_id) {
//             $_SESSION['error'] = "Danh mục không tồn tại";
//             header('Location: index.php');
//             exit;
//         }
//         $products = $this->productModel->getByCategory($category_id);
//         require_once PATH_CLIENT . 'product/list.php';
//     }
}