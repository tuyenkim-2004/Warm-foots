<div class="right">
    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }

    if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
        unset($_SESSION['error']);
    }
    error_log("Dữ liệu đầu vào: Tên='$name', Email='$email', Vai trò='$role'");
    ?>
    <button class="add-user" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
    <table class="table table-striped w-100">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data["userList"] as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['password']); ?></td>
                    <td>
                        <div class="action">
                            <a href="#"><img src="public/imgs/icon-delete.svg" alt="Icon delete" class="delete"></a>
                            <button class="edit" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal"> <img src="public/imgs/icon-edit.svg" alt="Icon edit"></button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>

<div class="modal" id="addUserModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="./AdminController/createUser" method="POST">

                <div class="modal-body">
                    <div class="info-detail">
                        <label for="username">User Name:</label>
                        <input type="text" name="username" placeholder="Enter your name:" required>
                    </div>

                    <div class="info-detail">
                        <label for="password">Password:</label>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <div class="info-detail">
                        <label for="email">Email: </label>
                        <input type="email" name="email" placeholder="Enter your Email" required>
                    </div>

                    <div class="info-detail">
                        <label for="role">Role: </label>
                        <input type="number" name="role" placeholder="Enter your role" required>
                    </div>

                </div>



                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="create-user">Create User</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal" id="editUserModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="info-detail">
                    <label for="username">User Name:</label>
                    <input type="text" name="username">
                </div>

                <div class="info-detail">
                    <label for="password">Password:</label>
                    <input type="password" name="password">
                </div>

                <div class="info-detail">
                    <label for="email">Email: </label>
                    <input type="email" name="email">
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="create-user"><a href="ProductController/ManageProduct">Edit User</a></button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>