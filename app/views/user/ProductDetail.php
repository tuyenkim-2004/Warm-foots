<?php
session_start();
$quantity = isset($_SESSION['quantity']) ? $_SESSION['quantity'] : 1;

if (isset($_POST['increase'])) {
    $_SESSION['quantity']++;
    $quantity = $_SESSION['quantity'];
} elseif (isset($_POST['decrease']) && $quantity > 1) {
    $_SESSION['quantity']--;
    $quantity = $_SESSION['quantity'];
}
$_SESSION['quantity'] = $quantity;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/Warm-foots/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/ProductDetail.css">
</head>

<body>
    <div class="container">
        <div class="content">
            <?php if (!empty($data["product"])): ?>
                <div class="left">
                    <?php
                    $imageName = trim(htmlspecialchars($data["product"]['img_url']));
                    if (ctype_digit(substr($imageName, 0, 1))) {
                        $imagePath = "public/imgs/$imageName";
                    } else {
                        $imagePath = "public/imgs/$imageName.webp";
                    }
                    if (file_exists($imagePath)) {
                        echo '<img src="' . $imagePath . '" alt="Image Product" class="image">';
                    } else {
                        echo '<img src="public/imgs/default-image" alt="Default Image" class="image">';
                    }
                    ?>
                </div>
                <div class="right">
                    <div class="name-title"><?php echo htmlspecialchars($data["product"]['product_name'] ?? 'Unknown Product'); ?></div>
                    <div class="plan">$<?php echo number_format($data["product"]['price'] ?? 0, 2); ?></div>
                    <div class="brand text-muted"><?php echo htmlspecialchars($data["product"]['brand']); ?></div>

                    <div class="size-title">Size</div>
                    <div class="size-detail">

                        <div class="size-detail-item">S</div>
                        <div class="size-detail-item">M</div>
                        <div class="size-detail-item">L</div>
                    </div>
                    <div class="action">
                        <div class="quantity-controls">
                            <button type="button" id="decrease">-</button>
                            <input type="number" name="quantity" class="quantity-display" id="quantity-input" value="<?php echo $quantity; ?>" readonly>
                            <button type="button" id="increase">+</button>
                        </div>
                        <!-- <button class="cart" >ADD TO CART</button> -->
                        <form method="POST" action="./ShoppingCartController/addToCart">
                            <input type="hidden" name="product_id" value="<?php echo $data["product"]['product_id']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($data["product"]['product_name'] ?? 'Product Image'); ?>">
                            <input type="hidden" name="quantity" id="quantityInCart">
                            <input type="hidden" name="price" id="hidden-quantity" value="<?php echo $quantity; ?>">
                            <button type="submit" class="cart">ADD TO CART</button>
                        </form>
                        <button class="checkout">BUY IT NOW</button>

                    </div>
                    <div class="type-for-product">
                        <div class="vendor">
                            <div class="title">Vendor</div>
                            <div class="name">UrbanStep</div>
                        </div>

                        <div class="type">
                            <div class="title">Type:</div>
                            <div class="name">Sneakers</div>
                        </div>

                        <div class="sku">
                            <div class="title">Sku:</div>
                            <div class="name">Unknown SKU</div>
                        </div>
                        <div class="available">
                            <div class="title">Available:</div>
                            <div class="name">Available</div>
                        </div>

                    </div>
                    <div class="shipping-infomation">
                        <div class="title">Shipping information</div>
                        <div class="info-detail">
                            <div>- No EU import duties.</div>
                            <div>- Ships within 1-2 business days.</div>
                            <div>- Ships in our fully recyclable and biodegradable signature boxes.</div>
                        </div>
                    </div>

                </div>
            <?php else: ?>
                <p>Product details not available.</p>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <div class="description">
        <div class="info-des">
            <div class="title">Timeless Styles with a Modern Edge</div>
            <div class="des-detail">Experience the best of both worlds with our collection that seamlessly
                blends timeless classics with modern twists. Elevate your wardrobe with pieces that stand the test of time while embracing the latest fashion innovations. Shop now for exclusive discounts.</div>
        </div>
    </div>
    </div>
    <script src="public/js/ProductDetail.js?"></script>
</body>

</html>