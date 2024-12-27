<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/Order.css">
</head>
<body>
    <div class="payment-container">
        <form method="POST" action="./OrderController/placeOrder">
        <div class="order_form">
            <div class="content">
                <div class="title-payment">
                    <h2>Contact Information</h2>
                    <span><i class="fa-solid fa-circle-user"></i> Login</span>
                </div>
                <div class="form">
                    <div class="input-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="name" placeholder="Your name" required>
                    </div>
                    <div class="input-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="phone" placeholder="Your phone" required>
                    </div>
                    <div class="input-group">
                        <label for="shipping_address">Address</label>
                        <input type="text" name="shipping_address" id="shipping_address" class="shipping_address" placeholder="Enter your address" required>
                    </div>
                </div>
            </div>

            <!-- Product details -->
            <div class="product_item">
                <h3>Your Products:</h3>
                    <?php if (isset($data["orderDetails"]) && is_array($data["orderDetails"])): ?>
                        <?php
                        $totalAmount = 0; 
                        $totalQuantity = 0;
                        foreach ($data["orderDetails"] as $item):
                            $subtotal = $item['price'] * $item['quantity']; 
                            $totalAmount += $subtotal; 
                            $totalQuantity += $item['quantity']; 
                        ?>
                        <div class="frm-item">
                            <div class="img">
                                <img src="public/imgs/<?php echo htmlspecialchars($item['img_url']); ?>.webp" alt="Hình sản phẩm" class="image-product">
                                <span class="quantity-overlay"><?php echo $item['quantity']; ?></span> <!-- Số lượng hiển thị trên hình ảnh -->
                            </div>
                            <div class="title">
                                <p><?php echo htmlspecialchars($item['product_name']); ?></p>
                            </div>
                            <div class="price">
                                <p>$<?php echo number_format($item['price'], 2); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <div class="total-item">
                            <div class="sub-total">
                                <p>Subtotal: <?php echo $totalQuantity; ?> item(s)</p>
                                <p>$<?php echo number_format($totalAmount, 2); ?></p> 
                            </div>
                            <div class="ship">
                                <p>Shipping:</p>
                                <p>Free ship</p>
                            </div>
                            <div class="Total">
                                <p>Total:</p>
                                <p>$<?php echo number_format($totalAmount, 2); ?></p> 
                            </div>
                        </div>
                    <?php else: ?>
                    <p>Your cart is empty.</p>
                <?php endif; ?>
            </div>
        </div>  
                <div class="button-container">
                    <button type="submit" class="submit-btn">Order</button>
                </div>

            
        </form>
    </div>
</body>
</html>
