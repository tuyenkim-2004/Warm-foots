<?php
class OrderModel extends Database {
    
    // Lấy thông tin sản phẩm trong giỏ hàng
    public function getCartItems($userId) {
        $sql = "SELECT cd.product_id, p.product_name, p.img_url, cd.quantity, p.price
        FROM cart_details cd
        INNER JOIN products p ON cd.product_id = p.product_id
        INNER JOIN carts c ON cd.cart_id = c.cart_id
        WHERE c.user_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Tạo đơn hàng mới
    public function createOrder($userId, $orderDate, $address, $paymentMethod, $status, $cartItems) {
        try {
            // Bắt đầu transaction
            $this->con->begin_transaction();  // Dùng $this->con để kết nối

            // Thêm đơn hàng vào bảng `orders`
            $sqlOrder = "INSERT INTO orders (user_id, order_date, shipping_address, payment_method, status) 
                         VALUES (?, ?, ?, ?, ?)";
            $stmtOrder = $this->con->prepare($sqlOrder);  // Dùng $this->con để kết nối
            $stmtOrder->bind_param('issss', $userId, $orderDate, $address, $paymentMethod, $status);
            $stmtOrder->execute();

            // Lấy ID của đơn hàng vừa tạo
            $orderId = $this->con->insert_id;  // Dùng $this->con->insert_id để lấy ID của đơn hàng mới

            // Thêm chi tiết đơn hàng vào bảng `order_details`
            $sqlDetails = "INSERT INTO order_details (order_id, product_id, quantity, price) 
                           VALUES (?, ?, ?, ?)";
            $stmtDetails = $this->con->prepare($sqlDetails);  // Dùng $this->con để kết nối

            foreach ($cartItems as $item) {
                $stmtDetails->bind_param('iiid', $orderId, $item['product_id'], $item['quantity'], $item['price']);
                $stmtDetails->execute();
            }

            // Hoàn tất transaction
            $this->con->commit();  // Dùng $this->con để kết nối

            return $orderId;
        } catch (Exception $e) {
            $this->con->rollback();  
            throw $e; 
        }
    }

    // Xóa giỏ hàng sau khi thanh toán
    public function clearCart($userId) {
        $sql = "DELETE FROM cart_details WHERE user_id = ?";  // Sử dụng tên bảng cart_details
        $stmt = $this->con->prepare($sql);  // Dùng $this->con để kết nối
        $stmt->bind_param('i', $userId);  // 'i' cho kiểu dữ liệu integer
        $stmt->execute();
    }
}

?>
