<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/Products.css">
</head>
<body>

        <div class="banner">
            <img src="public/imgs/slider4.webp" alt="Shoe" class="banner-image">
            <div class="banner-content">
                <h1>Products</h1>
            </div>
        </div>
    <div class="container">
    
        <?php if (!empty($data['products'])): ?>
            <div class="product-list">
                <?php foreach ($data['products'] as $product): ?>
                    <div class="product-card">
                        <img src="public/imgs/<?php echo htmlspecialchars($product['img_url']); ?>.webp" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                        <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                        <p>$<?php echo number_format($product['price'], 2); ?></p>
                        <div class="item_list">
                                <span class="brand text-muted"><?php echo htmlspecialchars($product['brand']); ?></span>
                            </div>
                            <div class="submit">
                                <button class="add-to-cart">Add to Cart</button>
                                <button class="buy-now">Buy Now</button>
                            </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No products found in this category.</p>
        <?php endif; ?>
        
    </div>
</body>
</html>
