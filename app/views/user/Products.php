<!DOCTYPE html>
<html lang="en">
<head>
<base href="/Warm-foots/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="public/css/Products.css">
</head>
<body>
        <div class="container">
            <a href ="" title ="home">Home</a>
            <span aria-hidden="true">/</span>
            <span>Products</span>
        </div>

        <div class="banner">
            <img src="public/imgs/slider4.webp" alt="Shoe" class="banner-image">
            <div class="banner-content">
                <h1>Products</h1>
            </div>
        </div>

        <div class="categories">
            <a href="#" class="category">Athletic Footwear </a>
            <a href="#" class="category">Boots for Every Occasion </a>
            <a href="#" class="category">Luxury Leather Shoes </a>
            <a href="#" class="category">Sandals & Slides </a>
            <a href="#" class="category">Sneakers Haven </a>
        </div>
        
        <div class="category">
            <div class="from_group">
                <div class="img">
                    <img src="public/imgs/AthleticFootwear/slider.webp" alt="">
                </div>
                <div class="title">
                    <a href="#"><span>Athletic Footwear</span></a>
                </div>
                
            </div>

            <div class="from_group">
                <div class="img">
                    <img src="public/imgs/BootsforEveryOccasion/slider.webp" alt="">
                </div>
                <div class="title">
                    <a href="#"><span> Boots for Every Occasion</span></a>
                </div>
            </div>

            <div class="from_group">
                <div class="img">
                    <img src="public/imgs/LuxuryLeatherShoes/slider.webp" alt="">
                </div>
                <div class="title">
                    <a href="#"><span>Luxury Leather Shoes</span></a>
                </div>
            </div>

            <div class="from_group">
                <div class="img">
                    <img src="public/imgs/Sandals&Slides/slider.webp" alt="">
                </div>
                <div class="title">
                    <a href="#"><span> Sandals & Slides</span></a>
                </div>
            </div>

            <div class="from_group">
                <div class="img">
                    <img src="public/imgs/SneakerheadsHaven/slider.webp" alt="">
                </div>
                <div class="title">
                    <a href="#"><span> Sneakerhead's Haven</span></a>
                </div>
            </div>
        </div>
        <div class="infor_product">
            <span><h1>How to Style Your Favorite Sneakers</h1>
            </span>
            <span> Augue ut lectus arcu bibendum at varius vel. Ipsum nunc aliquet bibendum enim facilisis. Quam elementum pulvinar etiam non quam...</span>
        </div>

        <div class="container">
            <div class="product-list">
                <?php foreach ($data["productList"] as $product): ?>
                        <div class="product-card">
                            <div class="image">
                            <img src="public/imgs/<?php echo htmlspecialchars($product['img_url']); ?>.webp" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
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
                                <form method="POST" action="./ShoppingCart/addToCart">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>">
                                    <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                                    <input type="hidden" name="quantity" value="1"> 
                                    <button type="submit" class="add-to-cart">Add to Cart</button>
                                </form>
                                <button class="buy-now">Buy Now</button>
                            </div>  
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
</body>
</html>
