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
                    <?php if (!empty($data['cartDetails'])): ?>
                        <?php foreach ($data['cartDetails'] as $item): ?>
                            <tr data-cart-id="<?php echo htmlspecialchars($item['cart_id']); ?>" data-product-id="<?php echo htmlspecialchars($item['product_id']); ?>">
                                <td>
                                    <div class="infor-product-order">
                                        <img src="public/imgs/<?php echo htmlspecialchars($item['img_url']); ?>.webp" 
                                            alt="Hình sản phẩm" class="image-product">
                                        <div class="info-detail-order">
                                            <div class="name"><?php echo htmlspecialchars($item['product_name']); ?></div>
                                            <i class="fas fa-trash icon-delete" onclick="getTotalPrice()" title="Xóa sản phẩm"></i>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="quantity-controls">
                                        <button id="decrease" onclick="updateQuantity()">-</button>
                                        <input type="number" id="quantity" class="quantity-display" value="<?php echo htmlspecialchars($item['quantity']); ?>" readonly>
                                        <button id="increase" onclick="updateQuantity()" >+</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="price">$<?php echo number_format($item['price'], 2); ?></div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="text-align: center;">Giỏ hàng của bạn trống.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                
            </table>
            <div class="info-total-order">
                <div class="order">Order Summary</div>
                <div>Shipping Free</div>
                <div class="total-detail">
                    <div>Total:</div>
                    <div class="total">$<?php echo  number_format($data['totalPrice'], 2) ?></div>
                </div>
                <div class="action">
                    <button class="back"><a href="#"><i class="fas fa-arrow-left"></i>   Continue Shopping</a></button>
                    <button class="checkout"><a href="./OrderController/Payment.php">Order</a></button>
                </div>
            </div>
        </div>
   </div>
   <a href="public/imgs/LuxuryLeatherShoes/WaterproofBoots.webp"></a>
    <script src="public/js/ShoppingCart.js?v=<?php echo time(); ?>
"></script>
</body>
</html>