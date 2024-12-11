<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* .content{
            display:flex;
            border-radius:5px;
            justify-content: center;
            height:80%;
            width:80%;
            padding-top:50px;
      
        }
        img{
            border-radius:5px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
        }
        .text-center{
            text-align:center;
            font-size:40px;
        }
        .tittle{
            margin-left:40px;
        }
        .form-group input {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            border-radius: 4px 0 0 4px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
        } */
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background: #f4f4f9;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        
    }
    .container {
    width: 100%;
    max-width: 800px; 
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    display: flex;
    overflow: hidden;
    justify-content: center; 
    margin-left:200px;
    margin-top:150px;
    }
    .content {
        display: flex;
        flex: 1;
        justify-content: center; 
        
    }
    .content_sub {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f8f9fa;
    }
    .content_sub img {
        width: 400px;
        height:400px;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .tittle {
        flex: 1;
        padding: 0px 30px 0px;
        
        
    }
    .text-center {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 20px;
        color: #333;
    }
    label {
        font-size: 1rem;
        color: #555;
        display: block;
        margin-bottom: 5px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group input {
        width: 100%;
        padding: 12px 15px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 1rem;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .form-group input:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
    .btn-primary {
        background-color: #ae3f4f;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        width:100%;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .custom-control {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }
    .custom-control label {
        font-size: 0.9rem;
        color: #007bff;
        cursor: pointer;
    }
    .custom-control label:hover {
        text-decoration: underline;
    }
</style>

    </style>
</head>
<body>
    <form action="#">
    <div class="container">
        <div class="content">
            <div class="content_sub">
                <img src="https://file.hstatic.net/200000201143/file/cach-chup-hinh-giay-dep__13__aaa5140765694f9bbf734cc32c9e829a_grande.jpg" alt="">
            </div>
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