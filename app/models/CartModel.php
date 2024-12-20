<?php

class CartModel extends Database {
    
    public function createCartForUser() {
        // Lấy userId từ session
        if (!isset($_SESSION['user_id'])) {
            return false; // Người dùng chưa đăng nhập
        }
        
        $userId = $_SESSION['user_id'];

        $stmt = $this->prepare("INSERT INTO carts (user_id) VALUES (?)");
        if (!$stmt) {
            echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error; // Thông báo lỗi nếu không thể chuẩn bị câu lệnh
            return false;
        }
        $stmt->bind_param("i", $userId);
        
        if ($stmt->execute()) {
            return $this->con->insert_id; // Trả về cart ID
        } else {
            echo "Lỗi thực thi câu lệnh: " . $stmt->error; // Thông báo lỗi nếu không thể thực hiện
            return false;
        }
    }

    public function addProductToCart($productId, $quantity = 1) {
        // Lấy userId từ session
        if (!isset($_SESSION['user_id'])) {
            return false; // Người dùng chưa đăng nhập
        }
        var_dump($_SESSION['user_id']); // Xem giá trị của user_id

        $userId = $_SESSION['user_id'];

        // Lấy cart ID cho người dùng
        $cartId = $this->getCartIdByUserId($userId);
        if (!$cartId) {
            // Nếu không tìm thấy giỏ hàng, tạo một cái mới
            $cartId = $this->createCartForUser();
            if (!$cartId) {
                return false; // Nếu không thể tạo giỏ hàng
            }
        }

        // Kiểm tra xem sản phẩm đã có trong cart_details chưa
        $stmt = $this->prepare("SELECT * FROM cart_details WHERE cart_id = ? AND product_id = ?");
        if (!$stmt) {
            echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
            return false;
        }
        $stmt->bind_param("ii", $cartId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Nếu sản phẩm đã có, cập nhật số lượng
            $row = $result->fetch_assoc();
            $newQuantity = $row['quantity'] + $quantity; // Tăng số lượng lên

            $stmt = $this->prepare("UPDATE cart_details SET quantity = ? WHERE cart_detail_id = ?");
            if (!$stmt) {
                echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
                return false;
            }
            $stmt->bind_param("ii", $newQuantity, $row['cart_detail_id']);
        } else {
            // Nếu sản phẩm chưa có, thêm mới vào cart_details
            $stmt = $this->prepare("INSERT INTO cart_details (cart_id, product_id, quantity) VALUES (?, ?, ?)");
            if (!$stmt) {
                echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
                return false;
            }
            $stmt->bind_param("iii", $cartId, $productId, $quantity);
        }

        return $stmt->execute(); // Thực thi truy vấn
    }

    public function getCartItems() {
        if (!isset($_SESSION['user_id'])) {
            return []; 
        }

        $userId = $_SESSION['user_id'];
        $cartId = $this->getCartIdByUserId($userId);
        if (!$cartId) {
            return []; // Không tìm thấy giỏ hàng
        }

        $stmt = $this->prepare("SELECT * FROM cart_details WHERE cart_id = ?");
        if (!$stmt) {
            echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
            return [];
        }
        $stmt->bind_param("i", $cartId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    private function getCartIdByUserId($userId) {
        $stmt = $this->prepare("SELECT cart_id FROM carts WHERE user_id = ?");
        if (!$stmt) {
            echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
            return null;
        }
        
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Lấy cart ID từ kết quả
        if ($row = $result->fetch_assoc()) {
            return $row['cart_id']; // Trả về giá trị của cột 'id'
        } else {
            return null; // Không tìm thấy cart ID
        }
    }

    public function getCartDetails() {
        if (!isset($_SESSION['user_id'])) {
            return []; // Nếu người dùng chưa đăng nhập, trả về mảng rỗng
        }
    
        $userId = $_SESSION['user_id'];
        $cartId = $this->getCartIdByUserId($userId);
        if (!$cartId) {
            return []; // Không tìm thấy giỏ hàng
        }
    
        $stmt = $this->prepare("
            SELECT cd.*, p.product_name, p.img_url, p.price 
            FROM cart_details cd 
            JOIN products p ON cd.product_id = p.product_id 
            WHERE cd.cart_id = ?
        ");
        if (!$stmt) {
            echo "Lỗi chuẩn bị câu lệnh: " . $this->con->error;
            return [];
        }
    
        $stmt->bind_param("i", $cartId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC); // Trả về tất cả các bản ghi dưới dạng mảng
    }
}
?>