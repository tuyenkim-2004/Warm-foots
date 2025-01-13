<div class="right">
    <div class="content-action d-flex justify-content-between align-items-center mb-3">
        <button class="add-product" type="button" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
        <form method="GET" action="./AdminController/searchProduct">
            <input type="text" name="search" class="form-control" placeholder="Search Product" style="width: 100%;"
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        </form>
    </div>

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
            <?php if (empty($data['productList'])): ?>
                <tr>
                    <td colspan="6" class="text-center">Không tìm thấy sản phẩm nào khớp với từ khóa.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($data['productList'] as $product): ?>
                    <tr>
                        <td>
                            <?php
                            $imageName = trim(htmlspecialchars($product['img_url']));
                            $imagePath = (ctype_digit(substr($imageName, 0, 1)))
                                ? "public/imgs/$imageName"
                                : "public/imgs/$imageName.webp";

                            $defaultImage = "public/imgs/default-image.webp"; // Adjusted to ensure a valid default image
                            echo '<img src="' . (file_exists($imagePath) ? $imagePath : $defaultImage) . '" alt="Image Product" class="image">';
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                        <td><?php echo number_format($product['price'], 2); ?></td>
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
            <?php endif; ?>
        </tbody>
    </table>
    <div class="pagination">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php
                if ($data['resultsPerPage'] > 0) {
                    $numberOfPages = $data['totalProducts'] > 0 ? ceil($data['totalProducts'] / $data['resultsPerPage']) : 1;
                    if ($data['currentPage'] > 1) {
                        echo '<li class="page-item"><a class="page-link" href="./AdminController/ManageProducts?page=' . ($data['currentPage'] - 1) . '">&laquo; Previous</a></li>';
                    }
                    for ($page_number = 1; $page_number <= $numberOfPages; $page_number++) {
                        if ($page_number == $data['currentPage']) {
                            echo '<li class="page-item active" aria-current="page"><span class="page-link">' . $page_number . '</span></li>'; 
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="./AdminController/ManageProducts?page=' . $page_number . '">' . $page_number . '</a></li>'; 
                        }
                    }
                    if ($data['currentPage'] < $numberOfPages) {
                        echo '<li class="page-item"><a class="page-link" href="./AdminController/ManageProducts?page=' . ($data['currentPage'] + 1) . '">Next &raquo;</a></li>';
                    }
                } else {
                    echo '<strong>No products available.</strong>';
                }
                ?>
            </ul>
        </nav>
    </div>
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
                        <label for="image">Product Image:</label>
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
                        <label for="image">Product Image:</label>
                        <input type="file" name="image">
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