<div class="right">
    <table class="table table-striped w-100">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Order Date</th>
                <th>Image Product</th>
                <th>NameProduct</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Shipping Address</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($data["orders"] as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                    <td>
                        <?php
                            $imageName = trim(htmlspecialchars($order['img_url']));
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
                    <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                    <td>$<?php echo htmlspecialchars($order['total_amount']); ?></td>
                    <td><?php echo htmlspecialchars($order['shipping_address']); ?></td>
                    <td>
                        <form action="./AdminController/updateOrder" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                            <select name="status" class="status-select form-select" aria-label="Order Status" onchange="this.form.submit()">
                                <option value="Processing" <?php if ($order['status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                                <option value="Shipped" <?php if ($order['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                                <option value="Delivered" <?php if ($order['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                                <option value="Canceled" <?php if ($order['status'] == 'Canceled') echo 'selected'; ?>>Canceled</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <form action="./AdminController/deleteOrder" method="POST" style="display:inline;">
                            <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="public/js/ManageOrders.js"></script>