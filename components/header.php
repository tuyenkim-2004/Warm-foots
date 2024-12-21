<!DOCTYPE html>
<html lang="en">

<head>
  <base href="/Warm-foots/">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./public/css/header.css?v=<?php echo time() ?>">
  <title>Document</title>
  <style>
    .active {
      display: block;
    }
  </style>
</head>

<body>
  <header class="header">
    <div class="navbar">
      <div class="logo">
        <img src="./public/imgs/logo.png" alt="shoe" class="logo-icon">
      </div>
      <nav>
        <ul class="nav-menu">
          <li><a href="HomeController/index">HOME</a></li>
          <li><a href="#">SHOP</a></li>
          <li><a href="ProductController/index">PRODUCTS</a></li>
          <li><a href="#">BLOG</a></li>
          <li><a href="#">ABOUT US</a></li>
        </ul>
      </nav>
      <div class="icons">
        <a href="#"><i class="fa fa-search"></i></a>
        <a href="ShoppingCartController/index"><i class="fa fa-shopping-cart"></i></a>
        <div class="dropdown">
          <a href="#" class="dropdown-toggle userButton">
            <i class="fa fa-user"></i>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#">Profile</a></li>
            <li><a href="AuthenticationController/login">Log in</a></li>
            <li><a href="#">Log out</a></li>
             <li><a href="AuthenticationController/register">Register</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <script>
    const userButton = document.querySelector('.userButton');
    const dropdownMenu = document.querySelector('.dropdown-menu');
    userButton.addEventListener('click', () => {
      dropdownMenu.classList.toggle('active');
    });

    // Đóng menu khi click ra ngoài
    document.addEventListener('click', (event) => {
      if (!event.target.closest('.dropdown')) {
        dropdownMenu.classList.remove('active');
      }
    });
  </script>
</body>

</html>