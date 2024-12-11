<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <title>Register</title>
    <link rel="stylesheet" href="../public/css/register.css"> 
</head>
<body>
   
<form action="../controllers/AuthController.php" method="POST">
    <div class="container">
        <div class="content">
            <h2 class="text-center">Register</h2>
            <div class="frm">
                <div class="form-group">
                    <span >Họ và tên:</span>
                </div>
                <div class="input-group">
                    <input type="text" class="form-control" name="fullname"  placeholder="Nhập họ tên đầy đủ của bạn" required />
                </div>
            </div>
            <div class="frm">
                <div class="form-group">
                    <span >Email:</span>
                </div>
                <div class="input-group">
                    <input type="email" class="form-control" name="email"  placeholder="Nhập email" required />
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span>Nhập mật khẩu:</span>
                    <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required />
                </div>
                <div class="input-group">
                    <span >Nhập lại mật khẩu:</span>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu" required />
                </div>
            </div>
            <button type="submit" name="login" class="btn-primary">Login</button>
            <div class="form-group">
                <div class="custom-control custom-checkbox small">
                    <label for="">Already have an account?</label>
                    <label class="custom-control-label">Login</label>
                </div>
            </div>
        </div>
    </div>
</form>

</body>
</html>