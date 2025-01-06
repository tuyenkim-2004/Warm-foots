<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/Warm-foots/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="public/css/Products.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="public/js/filterProducts.js"></script>
</head>

<body>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success" style="text-align: center; color: green;">
            <?php echo $_SESSION['message']; ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="container">
        <a href="" title="home">Home</a>
        <span aria-hidden="true">/</span>
        <span>Products</span>
    </div>

    <div class="banner">
        <img src="public/imgs/slider4.webp" alt="Shoe" class="banner-image">
        <div class="banner-content">
            <h1>Products</h1>
        </div>
    </div>

    <div class="category">
        <div class="from_group">
            <div class="img">
                <img src="public/imgs/AthleticFootwear/slider.webp" alt="">
            </div>
            <div class="title">
                <a href="#" class="category-link" data-category-id="1">Athletic Footwear</a>
            </div>
        </div>

        <div class="from_group">
            <div class="img">
                <img src="public/imgs/BootsforEveryOccasion/slider.webp" alt="">
            </div>
            <div class="title">
                <a href="#" class="category-link" data-category-id="2">Boots for Every Occasion</a>
            </div>
        </div>

        <div class="from_group">
            <div class="img">
                <img src="public/imgs/LuxuryLeatherShoes/slider.webp" alt="">
            </div>
            <div class="title">
                <a href="#" class="category-link" data-category-id="3">Luxury Leather Shoes</a>
            </div>
        </div>

        <div class="from_group">
            <div class="img">
                <img src="public/imgs/SandalsSlides/slider.webp" alt="">
            </div>
            <div class="title">
                <a href="#" class="category-link" data-category-id="4">Sandals & Slides</a>
            </div>
        </div>

        <div class="from_group">
            <div class="img">
                <img src="public/imgs/SneakerheadsHaven/slider.webp" alt="">
            </div>
            <div class="title">
                <a href="#" class="category-link" data-category-id="5">Sneakers Haven</a>
            </div>
        </div>
    </div>

    <div class="infor_product">
        <h1>How to Style Your Favorite Sneakers</h1>
    </div>

    <div class="categories">
        <ul id="category-list">
            <li><a href="#" class="category-link" data-category-id="1">Athletic Footwear</a></li>
            <li><a href="#" class="category-link" data-category-id="2">Boots for Every Occasion</a></li>
            <li><a href="#" class="category-link" data-category-id="3">Luxury Leather Shoes</a></li>
            <li><a href="#" class="category-link" data-category-id="4">Sandals & Slides</a></li>
            <li><a href="#" class="category-link" data-category-id="5">Sneakers Haven</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="product-list">
            <?php if (empty($data["productList"])): ?>
                <p>No products found<?php echo isset($data["searchKeyword"]) ? ' for "' . htmlspecialchars($data["searchKeyword"]) . '"' : ''; ?>.</p>
            <?php else: ?>
                <div id="product-list">
                    <?php foreach ($data["productList"] as $product): ?>
                        <div class="product-card">
                            <div class="image">
                                <a href="ProductController/detail?id=<?php echo $product['product_id']; ?>">
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
                                            echo '<img src="public/imgs/default-image" alt="Default Image" class="image">';
                                        }
                                    ?>
                                </a>
                            </div>
                            <div class="item_list">
                                <span class="price text-success"><?php echo $product['price']; ?> USD</span>
                            </div>
                            <div class="item_list">
                                <h4 class="title-cart"><?php echo htmlspecialchars($product['product_name']); ?></h4>
                            </div>
                            <div class="item_list">
                                <span class="brand text-muted"><?php echo htmlspecialchars($product['brand']); ?></span>
                            </div>
                            <div class="submit">
                                <form method="POST" action="./ShoppingCartController/addToCart">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>">
                                    <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="add-to-cart">Add to Cart</button>
                                </form>
                                <button class="buy-now"> Buy Now</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>