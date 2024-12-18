<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="/public/css/ShoppingCart.css">
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
                    <tr>
                    <td>
                        <div class="infor-product-order">
                            <img src="/public/imgs/Athletic Footwear/Classic Leather Sneakers.webp" alt="image product cart" class="image-product">
                            <div class="info-detail-order">
                                <div class="name">Premium Leather Chelsea Boots</div>
                                <i class="fas fa-trash icon-delete"></i>

                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="quantity-controls">
                            <button id="decrease">-</button>
                            <input type="number" id="quantity" class="quantity-display" value="1" readonly>
                            <button id="increase">+</button>
                        </div>
                    </td>
                    <td>
                        <div class="price">$45</div>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <div class="infor-product-order">
                            <img src="/public/imgs/Athletic Footwear/Classic Leather Sneakers.webp" alt="image product cart" class="image-product">
                            <div class="info-detail-order">
                                <div class="name">Premium Leather Chelsea Boots</div>
                                <i class="fas fa-trash icon-delete"></i>

                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="quantity-controls">
                            <button id="decrease">-</button>
                            <input type="number" id="quantity" class="quantity-display" value="1" readonly>
                            <button id="increase">+</button>
                        </div>
                    </td>
                    <td>
                        <div class="price">$45</div>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <div class="infor-product-order">
                            <img src="/public/imgs/Athletic Footwear/Classic Leather Sneakers.webp" alt="image product cart" class="image-product">
                            <div class="info-detail-order">
                                <div class="name">Premium Leather Chelsea Boots</div>
                                <i class="fas fa-trash icon-delete"></i>

                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="quantity-controls">
                            <button id="decrease">-</button>
                            <input type="number" id="quantity" class="quantity-display" value="1" readonly>
                            <button id="increase">+</button>
                        </div>
                    </td>
                    <td>
                        <div class="price">$45</div>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <div class="infor-product-order">
                            <img src="/public/imgs/Athletic Footwear/Classic Leather Sneakers.webp" alt="image product cart" class="image-product">
                            <div class="info-detail-order">
                                <div class="name">Premium Leather Chelsea Boots</div>
                                <i class="fas fa-trash icon-delete"></i>

                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="quantity-controls">
                            <button id="decrease">-</button>
                            <input type="number" id="quantity" class="quantity-display" value="1" readonly>
                            <button id="increase">+</button>
                        </div>
                    </td>
                    <td>
                        <div class="price">$45</div>
                    </td>
                    </tr>
               </tbody>
                
            </table>
            <div class="info-total-order">
                <div class="order">Order Summary</div>
                <div>Shipping Free</div>
                <div class="total-detail">
                    <div>Total:</div>
                    <div class="total">$654</div>
                </div>
                <div class="action">
                    <button class="back"><a href="#"><i class="fas fa-arrow-left"></i>   Continue Shopping</a></button>
                    <button class="checkout"><a href="#">Checkout</a></button>
                </div>
            </div>
        </div>
   </div>
   <a href="/public/imgs/LuxuryLeatherShoes/WaterproofBoots.webp"></a>
    <script src="/public/js/ShoppingCart.js"></script>
</body>
</html>