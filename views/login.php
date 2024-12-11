<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/login.css"> 
</head>
<body>
    <form action="#">
    <div class="container">
        <div class="content">
            <div class="tittle">
                <h2 class="text-center">Login</h2>
                <label for="">Email:</label>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Nhập email" required />
                </div>
                <label for="password">Password:</label>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required />
                </div>
                <button type="submit" name="login" class="btn-primary">Login</button>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <label for="">New custommer?</label>
                        <label class="custom-control-label">Register</label>
                    </div>
            </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>