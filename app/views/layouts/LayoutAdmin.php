<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/Warm-foots/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/LayoutAdmin.css">
    <link rel="stylesheet" href="public/css/<?php echo htmlspecialchars($data['admin']); ?>.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="content">
        <div class="left" id="left-panel">
            <div class="title-menu">
                <img src="public/imgs/logo.png" alt="Image logo" class="logo" id="logo">
                <img src="public/imgs/navbar.svg" alt="Image navbar" class="icon-navbar" id="navbar-icon" onclick="toggleMenu()">
            </div>
            <div class="menu" id="menu">
                <div class="menu-item">
                    <a href="#" class="menu-item-detail">
                        <img src="public/imgs/profile.svg" alt="Icon Profile">
                        <div>Profile</div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="AdminController/ManageUsers" class="menu-item-detail">
                        <img src="public/imgs/icon-user.svg" alt="Icon User">
                        <div>Manage User</div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="AdminController/ManageProducts" class="menu-item-detail">
                        <img src="public/imgs/icon-product.svg" alt="Icon Product">
                        <div>Manage Product</div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="#" class="menu-item-detail">
                        <img src="public/imgs/icon-order.svg" alt="Icon Order">
                        <div>Manage Order</div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="#" class="menu-item-detail">
                        <img src="public/imgs/icon-logout.svg" alt="Icon Logout">
                        <div>Logout</div>
                    </a>
                </div>
            </div>
        </div>


        <?php require_once "./app/views/admin/{$data['admin']}.php"; ?>
        <!-- <div class="right">
            <button class="add-product" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal"><a href="#">Add Product</a></button>
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
                    <tr>
                        <td> <img src="public/imgs/BootsforEveryOccasion/BreathableMeshSlip-Ons.webp" alt="Image Product" class="image"> </td>
                        <td>Product Name</td>
                        <td>$ 500</td>
                        <td>50</td>
                        <td>Goocies</td>
                        <td>
                            <div class="action">
                                <a href="#"><img src="public/imgs/icon-delete.svg" alt="Icon delete" class="delete"></a>
                                <button class="edit" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal"><a href="#"> <img src="public/imgs/icon-edit.svg" alt="Icon edit"></a></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
                
            </table>
        </div> -->
    </div>






    <script src="public/js/LayoutAdmin.js">

    </script>



</body>

</html>