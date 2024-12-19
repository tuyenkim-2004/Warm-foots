<?php

class Cart {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * @param int $userId
     * @return array|false
     */
    public function getCartItems($userId) {
        $query = "SELECT cart.*, products.name AS product_name, products.img_url, products.price 
                  FROM cart
                  JOIN products ON cart.product_id = products.id
                  WHERE cart.user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Thêm sản phẩm vào giỏ hàng.
     *
     * @param int $userId
     * @param int $productId
     * @param int $quantity
     * @return bool
     */
    public function addProductToCart($userId, $productId, $quantity) {
        $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $userId, $productId, $quantity);
        return $stmt->execute();
    }

    /**
     * Thêm chi tiết đơn hàng từ giỏ hàng vào bảng order_details.
     *
     * @param int $orderId
     * @param array $cartItems
     * @return bool
     */
    public function addOrderDetails($orderId, $cartItems) {
        foreach ($cartItems as $item) {
            $query = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('iiii', $orderId, $item['product_id'], $item['quantity'], $item['price']);
            if (!$stmt->execute()) {
                return false;
            }
        }
        return true;
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng.
     *
     * @param int $cartId
     * @param int $quantity
     * @return bool
     */
    public function updateCartQuantity($cartId, $quantity) {
        $query = "UPDATE cart SET quantity = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $quantity, $cartId);
        return $stmt->execute();
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng.
     *
     * @param int $cartId
     * @return bool
     */
    public function removeProductFromCart($cartId) {
        $query = "DELETE FROM cart WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $cartId);
        return $stmt->execute();
    }

    public function __destruct() {
        $this->db->close();
    }
}

?>
