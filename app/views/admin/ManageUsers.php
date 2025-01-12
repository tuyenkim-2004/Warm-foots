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
    ?>
    <div class="content-action d-flex justify-content-between align-items-center mb-3">
        <button class="add-user" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
        <form method="GET" action="./AdminController/searchUsers">
            <input type="text" name="search" class="form-control" placeholder="Search User" style="width: 100%;"
                value="<?php echo isset($_GET['search']) ? '' : ''; ?>">
        </form>
    </div>
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
                            <a href="AdminController/deleteUser?id=<?php echo htmlspecialchars($user['user_id']); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">
                                <img src="public/imgs/icon-delete.svg" alt="Icon delete">
                            </a>
                            <button class="edit" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal"
                                data-id="<?php echo htmlspecialchars($user['user_id']); ?>"
                                data-username="<?php echo htmlspecialchars($user['user_name']); ?>"
                                data-email="<?php echo htmlspecialchars($user['email']); ?>"
                                data-password="<?php echo htmlspecialchars($user['password']); ?>">
                                <img src="public/imgs/icon-edit.svg" alt="Icon edit">
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($data['currentPage'] > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="AdminController/ManageUsers?page=<?php echo $data['currentPage'] - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                <li class="page-item <?php echo ($i == $data['currentPage']) ? 'active' : ''; ?>">
                    <a class="page-link" href="AdminController/ManageUsers?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($data['currentPage'] < $data['totalPages']): ?>
                <li class="page-item">
                    <a class="page-link" href="AdminController/ManageUsers?page=<?php echo $data['currentPage'] + 1; ?>" aria-label="Next">
                        <span aria-hidden="true"> Next &raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<script></script>
<div class="modal" id="addUserModal">
    <div class="modal-dialog">
        <div class="modal-content">

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

            <form action="./AdminController/updateUser" method="POST" id="editUserForm">
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <div class="info-detail">
                        <label for="username">User Name:</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="info-detail">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" required>
                    </div>

                    <div class="info-detail">
                        <label for="email">Email: </label>
                        <input type="email" name="email" id="email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="create-user">Update User</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="public/js/ManageUsers.js"></script>