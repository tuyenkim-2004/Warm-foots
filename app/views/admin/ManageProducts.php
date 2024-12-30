<div class="right">
    <button class="add-product" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
    <table class="table table-striped w-100">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Brand</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($data["productList"] as $product): ?>
                <tr>
                    <td>
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
                    </td>
                    <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                    <td><?php echo number_format($product['price'], 2); ?> </td>
                    <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($product['brand']); ?></td>
                    <td>
                        <div class="action">
                            <a href="./AdminController/deleteProduct?id=<?php echo htmlspecialchars($product['product_id']); ?>" class="delete-product" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                <img src="public/imgs/icon-delete.svg" alt="Icon delete" class="delete">
                            </a>
                            <button class="edit" type="button" data-bs-toggle="modal" data-bs-target="#editProductModal"
                                data-id="<?php echo htmlspecialchars($product['product_id']); ?>"
                                data-name="<?php echo htmlspecialchars($product['product_name']); ?>"
                                data-price="<?php echo htmlspecialchars($product['price']); ?>"
                                data-quantity="<?php echo htmlspecialchars($product['quantity']); ?>"
                                data-brand="<?php echo htmlspecialchars($product['brand']); ?>">
                                <img src="public/imgs/icon-edit.svg" alt="Icon edit">
                            </button>

                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<div class="modal" id="addProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="./AdminController/addProduct" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="info-detail">
                        <label for="name">Product Name:</label>
                        <input type="text" name="name" required>
                    </div>

                    <div class="info-detail">
                        <label for="name">Product Image:</label>
                        <input type="file" name="image" required>
                    </div>

                    <div class="info-detail">
                        <label for="price">Price:</label>
                        <input type="number" name="price" required>
                    </div>

                    <div class="info-detail">
                        <label for="quantity">Quantity: </label>
                        <input type="number" name="quantity" required>
                    </div>

                    <div class="info-detail">
                        <label for="brand">Brand: </label>
                        <input type="text" name="brand" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="create-product">Create Product</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal" id="editProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="./AdminController/updateProduct" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="product_id">

                    <div class="info-detail">
                        <label for="name">Product Name:</label>
                        <input type="text" name="name" id="product_name" required>
                    </div>

                    <div class="info-detail">
                        <label for="name">Product Image:</label>
                        <input type="file" name="image" required>
                    </div>

                    <div class="info-detail">
                        <label for="price">Price:</label>
                        <input type="number" name="price" id="product_price" required>
                    </div>

                    <div class="info-detail">
                        <label for="quantity">Quantity: </label>
                        <input type="number" name="quantity" id="product_quantity" required>
                    </div>

                    <div class="info-detail">
                        <label for="brand">Brand: </label>
                        <input type="text" name="brand" id="product_brand" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="create-product">Update Product</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="public/js/ManageProducts.js"></script>