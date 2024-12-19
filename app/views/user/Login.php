<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/Warm-foots/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
    <form action="./Authentication/login" class="container" method="post">
        <div class="tittle">
            <h2 class="text-center">Login</h2>
            <label for="email">Email:</label>
            <div class="form-group">
                <input type="email" id="email" class="form-control" name="email" placeholder="Nhập email" required />
            </div>
            <label for="password">Password:</label>
            <div class="form-group">
                <input type="password" id="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required />
            </div>
            <button type="submit" name="login" class="btn-primary">Login</button>
            <div class="form-group">
                <div class="custom-control">
                    <span>New customer?</span>
                    <a href="./Authentication/register" class="custom-control-link">Register</a>
                </div>
            </div>
        </div>
    </form>

</body>

</html>