<?php
class OrderModel extends Database {
    
    // Lấy các sản phẩm trong giỏ hàng của người dùng
    public function getCartItems($userId) {
        $sql = "SELECT cd.product_id, p.product_name, p.img_url, cd.quantity, p.price
                FROM cart_details cd
                INNER JOIN products p ON cd.product_id = p.product_id
                INNER JOIN carts c ON cd.cart_id = c.cart_id
                WHERE c.user_id = ?";
        $stmt = $this->con->prepare($sql);
        if ($stmt === false) {
            die('Error in prepare statement: ' . $this->con->error);
        }
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result === false) {
            die('Error in execute statement: ' . $stmt->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function createOrder($userId, $orderDate, $address, $paymentMethod, $cartItems, $phone, $status = 'Processing') {
        try {
            if (empty($cartItems)) {
                throw new Exception("Cart is empty.");
            }
            $this->con->begin_transaction(); 
            $totalAmount = 0;
            foreach ($cartItems as $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }

            $sqlOrder = "INSERT INTO orders (user_id, order_date, total_amount, shipping_address, payment_method, status, phone) 
                         VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmtOrder = $this->con->prepare($sqlOrder);
            if ($stmtOrder === false) {
                throw new Exception('Error in prepare statement for order: ' . $this->con->error);
            }

            $stmtOrder->bind_param('isssssd', $userId, $orderDate, $totalAmount, $address, $paymentMethod, $status, $phone);
            $stmtOrder->execute();
            if ($stmtOrder->error) {
                throw new Exception('Error executing order statement: ' . $stmtOrder->error);
            }

            $orderId = $this->con->insert_id; 
            $sqlDetails = "INSERT INTO order_details (order_id, product_id, quantity, price) 
                           VALUES (?, ?, ?, ?)";
            $stmtDetails = $this->con->prepare($sqlDetails);
            if ($stmtDetails === false) {
                throw new Exception('Error in prepare statement for order details: ' . $this->con->error);
            }

            foreach ($cartItems as $item) {
                $stmtDetails->bind_param('iiid', $orderId, $item['product_id'], $item['quantity'], $item['price']);
                $stmtDetails->execute();
                if ($stmtDetails->error) {
                    throw new Exception('Error executing order details statement: ' . $stmtDetails->error);
                }
            }
            
            $this->con->commit(); 
            return $orderId; 
        } catch (Exception $e) {
            $this->con->rollback(); 
            echo "Error: " . $e->getMessage(); 
            return false;
        }
    }
    public function clearCart($userId) {
        $sql = "DELETE FROM cart_details WHERE cart_id IN (SELECT cart_id FROM carts WHERE user_id = ?)";
        $stmt = $this->con->prepare($sql);
        if ($stmt === false) {
            die('Error in prepare statement for clear cart: ' . $this->con->error);
        }

        $stmt->bind_param('i', $userId);
        $stmt->execute();
        if ($stmt->error) {
            die('Error executing clear cart statement: ' . $stmt->error);
        }
    }


    public function getOrders()
    {
        $sql = "
            SELECT 
            o.order_id,
            u.user_name,
            o.order_date,
            p.img_url,
            p.product_name,
            od.quantity,
            o.total_amount,
            o.shipping_address,
            o.status
        FROM 
            orders o
        JOIN 
            users u ON o.user_id = u.user_id
        JOIN 
            order_details od ON o.order_id = od.order_id
        JOIN 
            products p ON od.product_id = p.product_id
        ORDER BY 
            o.order_date DESC;
        ";

        $result = $this->con->query($sql);
        $orders = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
            $result->free();
        }
        return $orders;
    }

    public function updateOrderStatus($order_id, $status)
    {
        $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('si', $status, $order_id);
        return $stmt->execute();
    }

    public function deleteOrder($order_id)
    {
        $sqlDetail = "DELETE FROM order_details WHERE order_id = ?";
        $stmtDetail = $this->con->prepare($sqlDetail);
        $stmtDetail->bind_param('i', $order_id);
        $stmtDetail->execute();
        $stmtDetail->close();

        $sqlOrder = "DELETE FROM orders WHERE order_id = ?";
        $stmtOrder = $this->con->prepare($sqlOrder);
        $stmtOrder->bind_param('i', $order_id);
        $result = $stmtOrder->execute();
        $stmtOrder->close();
        return $result;
    }
}

?>
