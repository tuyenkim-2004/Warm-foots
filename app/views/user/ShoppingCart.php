<?php
session_start();
require_once __DIR__ . '/../../core/Database.php';

// Lấy user_id từ session, nếu không có thì mặc định là 1
$userId = $_SESSION['user_id'] ?? 1;
$db = new Database();

// Lấy danh sách sản phẩm từ giỏ hàng
$query = $db->prepare("SELECT c.*, p.product_name, p.img_url, p.price, u.user_name, u.email 
                       FROM cart c
                       JOIN products p ON c.product_id = p.product_id
                       JOIN users u ON c.user_id = u.user_id
                       WHERE c.user_id = ?");
if ($query) {
    $query->bind_param("i", $userId);

    if ($query->execute()) {
        $result = $query->get_result();
        $cartItems = $result->fetch_all(MYSQLI_ASSOC);

        // Tính tổng tiền
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['quantity'] * $item['price'];
        }, $cartItems));
    } else {
        die("Lỗi khi lấy danh sách sản phẩm từ giỏ hàng: " . $query->error);
    }
} else {
    die("Lỗi khi chuẩn bị câu truy vấn: " . $db->con->error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/Warm-foots/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="public/css/ShoppingCart.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <h2>Shopping Cart</h2>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php if (!empty($cartItems)): ?>
                        <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td>
                                    <div class="infor-product-order">
                                        <img src="public/imgs/<?php echo htmlspecialchars($item['img_url']); ?>"
                                            alt="Hình ảnh sản phẩm" class="image-product">
                                        <div class="info-detail-order">
                                            <div class="name"><?php echo htmlspecialchars($item['product_name']); ?></div>
                                            <i class="fas fa-trash icon-delete"></i>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="quantity-controls">
                                        <button id="decrease" data-id="<?php echo $item['product_id']; ?>">-</button>
                                        <input
                                            type="number"
                                            id="quantity"
                                            class="quantity-display"
                                            value="<?php echo $item['quantity']; ?>">
                                        <button id="increase" data-id="<?php echo $item['product_id']; ?>">+</button>

                                </td>
                                <td>
                                    <div class="price">$<?php echo number_format($item['price'], 2); ?></div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">Giỏ hàng của bạn trống.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="info-total-order">
            <div class="order">Order Summary</div>
                <div>Shipping Free</div>
                <div class="total-detail">
                    <div>Total:</div>
                    <div class="total">$<?php echo number_format($totalPrice, 2); ?></div>
                </div>
                <div class="action">
                    <button class="back">
                        <button class="back"><a href="/Warm-foots/Products/index"><i class="fas fa-arrow-left"></i> Continue Shopping</a></button>
                    </button>
                    <button class="checkout"><a href="#">Checkout</a></button>
                </div>
            </div>
        </div>
    </div>
    <script src="public/js/ShoppingCart.js"></script>
</body>

</html>