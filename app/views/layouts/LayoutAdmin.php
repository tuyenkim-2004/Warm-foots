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
                    <a href="AdminController/showChart" class="menu-item-detail">
                        <img src="public/imgs/icon-user.svg" alt="Icon User">
                        <div>Dashboard</div>
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
                    <a href="AdminController/manageOrders" class="menu-item-detail">
                        <img src="public/imgs/icon-order.svg" alt="Icon Order">
                        <div>Manage Order</div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="AuthenticationController/logout" class="menu-item-detail">
                        <img src="public/imgs/icon-logout.svg" alt="Icon Logout">
                        <div>Logout</div>
                    </a>
                </div>
            </div>
        </div>


        <?php require_once "./app/views/admin/{$data['admin']}.php"; ?>
    </div>
    <script src="public/js/LayoutAdmin.js"> </script>
</body>

</html>