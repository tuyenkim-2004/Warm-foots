<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/Warm-foots/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/Home.css">
</head>

<body>
  
    <div class="banner">
        <img src="public/imgs/slider1.png" alt="Shoe" class="banner-image">
        <div class="banner-content">
            <h4>Elevate Your Look</h4>
            <h1>Find The Perfect Pair <br> Of Shoes To Complete.</h1>
            <p>Explore our wide range of styles, colors, and materials to find the perfect shoes for any occasion.</p>
            <a href="#" class="shop-now-btn">Shop now →</a>
        </div>
    </div>

    <div class="products">
        <div class="product-item">
            <img src="public/imgs/giay1.png" alt="giay nam">
            <div class="text-overlay">
                <h2>Trending</h2>
                <h3>Men Collections</h3>
                <a href="#" class="shop-now-btn">Shop now →</a>
            </div>
        </div>
        <div class="product-item">
            <img src="public/imgs/giay2.png" alt="giay nu">
            <div class="text-overlay">
                <h2>Latest</h2>
                <h3>Women Collections</h3>
                <a href="#" class="shop-now-btn">Shop now →</a>
            </div>
        </div>

        <div class="product-item">
            <img src="public/imgs/giay3.png" alt="giay tre em">
            <div class="text-overlay">
                <h2>Comfort</h2>
                <h3>Kid Collections</h3>
                <a href="#" class="shop-now-btn">Shop now →</a>
            </div>
        </div>
    </div>

    <div class="text">
        <h3>THE LATEST TRENDS IN ATHLETIC FOOTWEAR</h3>
        <h1>Sneaker & Kids</h1>
    </div>

    <div class="product-sells">
    <?php foreach (array_slice($data["productList"], 1, 4) as $product): ?>

        <div class="product-sell-item">
            <div class="product-sell">
                <?php
                    $imageName = trim(htmlspecialchars($product['img_url']));
                    if (ctype_digit(substr($imageName, 0, 1))) {
                        $imagePath = "public/imgs/$imageName";
                    } else {
                        $imagePath = "public/imgs/$imageName.webp";
                    }
                    if (file_exists($imagePath)) {
                        echo '<img src="' . $imagePath . '" alt="Image Product" class="image">';
                    } else {
                        echo '<img src="public/imgs/default-image.webp" alt="Default Image" class="image">';
                    }
                ?>
                <div class="info-product">
                    <div class="price">$<?php echo htmlspecialchars($product['price']); ?></div>
                    <div class="name"><?php echo htmlspecialchars($product['product_name']); ?></div>
                    <div class="branch"><?php echo htmlspecialchars($product['brand']); ?></div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

       
    </div>

    <div class="banner-footer">
        <img src="public/imgs/banner-footer.png" alt="banner footer" class="banner-footer-image">
        <div class="banner-footer-content">
            <h4>Comfort Meets Fashion</h4>
            <h1>Discover shoes that look great<br> and feel even better.</h1>
            <p>Our collection features comfortable and stylish footwear designed to keep your feet happy all day long.
            </p>
            <a href="#" class="shop-now-btn">Shop now →</a>
        </div>
    </div>


</body>

</html>