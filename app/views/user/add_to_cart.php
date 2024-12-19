<?php
session_start();
require_once __DIR__ . '/core/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $db = new Database();

    $query = $db->prepare("INSERT INTO cart (user_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    if ($query) {
        $userId = 1; // Mặc định là user_id 1
        $query->bind_param("iiid", $userId, $productId, $quantity, $price);

        if ($query->execute()) {
            header("Location: /Warm-foots/cart.php"); 
            exit();
        } else {
            die("Lỗi khi thêm vào giỏ hàng: " . $query->error);
        }
    } else {
        die("Lỗi chuẩn bị câu truy vấn: " . $db->con->error);
    }
}
?>
