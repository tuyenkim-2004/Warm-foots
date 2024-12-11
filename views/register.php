<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
   
    <form action="../controllers/AuthController.php" method="POST">
        <div class="container">
            <h2 class="text-center">Register</h2>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Họ và tên:</i></span>
                    <input type="text" class="form-control" name="fullname" placeholder="Nhập họ tên đầy đủ của bạn"
                        required />
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Tên đăng nhập:</i></span>
                    <input type="text" class="form-control" name="username" placeholder="Nhập tên đăng ký" required />
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Email:</i></span>
                    <input type="email" class="form-control" name="email" placeholder="Nhập email đăng ký" required />
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Số điện thoại:</i></span>
                    <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại đăng ký"
                        required />
                </div>
            </div>
            <div class="form-group_password">
                <div class="input-group">
                    <span class="input-group-addon">Nhập mật khẩu:</i></span>
                    <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required />
                </div>
                <div class="input-group">
                    <span class="input-group-addon">Nhập lại mật khẩu:</span>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu"
                        required />
                </div>
            </div>

</body>
</html>