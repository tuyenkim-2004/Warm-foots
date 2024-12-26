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
        <form method="POST" action="/OrderController/placeOrder">
            <div class="content">
                <div class="title-payment">
                    <h2>Contact Information</h2>
                    <span><i class="fa-solid fa-circle-user"></i> Login</span>
                </div>
                <div class="form">
                    <div class="input-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="phone" placeholder="Your phone" required>
                    </div>
                    <div class="input-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="address" placeholder="Enter your address" required>
                    </div>
                </div>
                <div class="button-container">
                    <button type="submit" class="submit-btn">PAYMENT</button>
                </div>
            </div>

            <!-- Product details -->
            <div class="product_item">
                <h3>Your Products:</h3>
                <?php if (isset($data["orderDetails"]) && is_array($data["orderDetails"])): ?>
                    <?php foreach ($data["orderDetails"] as $item): ?>
                        <div class="frm-item">
                            <div class="img">
                            <img src="public/imgs/<?php echo htmlspecialchars($item['img_url']); ?>.webp" 
                            alt="Hình sản phẩm" class="image-product">
                            </div>
                            <div class="title">
                                <p><?php echo htmlspecialchars($item['product_name']); ?></p>
                            </div>
                            <div class="price">
                                <p>$<?php echo number_format($item['price'], 2); ?></p>
                            </div>
                            <div class="quantity">
                                <p>Quantity: <?php echo $item['quantity']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (isset($data["totalAmount"]) && is_numeric($data["totalAmount"])): ?>
                    <div class="total-item">
                        <div class="sub-total">
                            <p>Subtotal: <?php echo count($data["orderDetails"]); ?> item(s)</p>
                            <p>$<?php echo number_format($data["totalAmount"], 2); ?></p>
                        </div>
                        <div class="ship">
                            <p>Shipping:</p>
                            <p>Free ship</p>
                        </div>
                        <div class="Total">
                            <p>Total:</p>
                            <p>$<?php echo number_format($data["totalAmount"], 2); ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <p>Total amount is not available.</p>
                <?php endif; ?>
                <?php else: ?>
                    <p>Your cart is empty.</p>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>
</html>
