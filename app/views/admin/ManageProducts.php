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
                    <td> <img src="public/imgs/<?php echo htmlspecialchars($product['img_url']); ?>.webp" alt="Image Product" class="image"> </td>
                    <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                    <td><?php echo $product['price']; ?> </td>
                    <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($product['brand']); ?></td>
                    <td>
                        <div class="action">
                            <a href="#"><img src="public/imgs/icon-delete.svg" alt="Icon delete" class="delete"></a>
                            <button class="edit" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal"> <img src="public/imgs/icon-edit.svg" alt="Icon edit"></button>
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

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="info-detail">
                    <label for="name">Product Name:</label>
                    <input type="text" name="name">
                </div>

                <div class="info-detail">
                    <label for="price">Price:</label>
                    <input type="number" name="price">
                </div>

                <div class="info-detail">
                    <label for="image">Image: </label>
                    <input type="file" name="image">
                </div>


                <div class="info-detail">
                    <label for="quantity">Quantity: </label>
                    <input type="number" name="quantity">
                </div>


                <div class="info-detail">
                    <label for="brand">Brand: </label>
                    <input type="text" name="brand">
                </div>

                <div class="info-detail">
                    <label for="category">Category: </label>
                    <input type="text" name="category">
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="create-product"><a href="#">Create Product</a></button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal" id="editProductModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="info-detail">
                    <label for="name">Product Name:</label>
                    <input type="text" name="name">
                </div>

                <div class="info-detail">
                    <label for="price">Price:</label>
                    <input type="number" name="price">
                </div>

                <div class="info-detail">
                    <label for="image">Image: </label>
                    <input type="file" name="image">
                </div>


                <div class="info-detail">
                    <label for="quantity">Quantity: </label>
                    <input type="number" name="quantity">
                </div>


                <div class="info-detail">
                    <label for="brand">Brand: </label>
                    <input type="text" name="brand">
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="create-product"><a href="ProductController/ManageProduct">Edit Product</a></button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>