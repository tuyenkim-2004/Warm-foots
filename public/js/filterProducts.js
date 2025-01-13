$(document).ready(function () {
    $(".category-link").on("click", function (e) {
        e.preventDefault();
        const category_id = $(this).data("category-id");

        $.ajax({
            url: "ProductController/filterByCategory",
            method: "GET",
            data: { category_id },
            success: function (response) {
                const products = JSON.parse(response);
                const productList = $("#product-list");
                productList.empty();

                if (products.length > 0) {
                    products.forEach(product => {
                        productList.append(`
                            <div class="product-card">
                                <div class="image">
                                    <a href="ProductController/detail?id=${product.product_id}">
                                        <img src="public/imgs/${product.img_url}.webp" alt="${product.product_name}">
                                    </a>
                                </div>
                                <div class="item_list">
                                    <span class="price text-success">${product.price} USD</span>
                                </div>
                                <div class="item_list">
                                    <h4 class="title-cart">${product.product_name}</h4>
                                </div>
                                <div class="item_list">
                                    <span class="brand text-muted">${product.brand}</span>
                                </div>
                                <div class="submit">
                                    <form method="POST" action="./ShoppingCartController/addToCart">
                                        <input type="hidden" name="product_id" value="${product.product_id}">
                                        <input type="hidden" name="product_name" value="${product.product_name}">
                                        <input type="hidden" name="price" value="${product.price}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="add-to-cart">Add to Cart</button>
                                    </form>
                                    <button class="buy-now">Buy Now</button>
                                </div>
                            </div>
                        `);
                    });
                } else {
                    productList.append("<p>No products found for this category.</p>");
                }
            },
            error: function (err) {
                console.error("Error fetching products:", err);
            }
        });
    });
});
