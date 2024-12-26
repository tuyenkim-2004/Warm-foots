<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            height: 100vh;
            /* display: flex; */
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .container {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background: white;
            padding: 30px;
            width: 100%;
            max-width: 800px;
            min-height: 500px;
            margin-bottom: 50px ;
            
        }

        .avatar {
            margin-top: 80px;
            text-align: center;
            margin-bottom: 0px;
        }

        .avatar img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: lightgray;
        }

        .short-input {
            width: 80%;
            margin-top: 30px;
        }

        h2 {
            margin-top: 70px;
        }
    </style>
</head>

<body>

<?php
    $user = $data["user_data"];
    $fullName= $user["user_name"];
    $email= $user["email"];
    $password= $user["password"];

?>

<!-- HTML phần view -->
<div class="container">
    <div class="row">
        <div class="col-md-4 avatar">
            <img id="avatarImage" src="<?php echo $avatar; ?>" alt="Avatar">
            <p>
                <button class="btn btn-primary mt-2" onclick="document.getElementById('avatarInput').click();">Upload New Avatar</button>
            </p>
        </div>
        <div class="col-md-8">
            <h2>Profile Settings</h2>
            <form>
                <div class="form-group">
                    <input type="text" class="form-control short-input" value="<?php echo $fullName; ?>" placeholder="Your full name">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control short-input password"  value=  <?php echo $password; ?> placeholder="Your password">
                    <input type="input" style = "display : none" class="form-control short-input password"  value=  <?php echo $password; ?> placeholder="Your password">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control short-input" value="<?php echo $email; ?>" placeholder="Your email address">
                </div>
                <button type="submit" class="btn btn-success">Save Profile</button>
                <button type="button" class="btn btn-success ml-2">Edit</button>
            </form>
        </div>
    </div>
</div>

    <script>
        // Khi trang được tải, kiểm tra xem có avatar đã lưu trong localStorage không
        window.onload = function() {
            const savedAvatar = localStorage.getItem('avatar');
            if (savedAvatar) {
                document.getElementById('avatarImage').src = savedAvatar;
            }
        };

        function loadAvatar(event) {
            const avatarImage = document.getElementById('avatarImage');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                avatarImage.src = e.target.result;
                localStorage.setItem('avatar', e.target.result); // Lưu avatar vào localStorage
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        const password = document.querySelectorAll(".password");

            password[0].addEventListener("mouseout", () => {
                password[0].style.display = "block";
                password[1].style.display = "none";
            })

            password[0].addEventListener("mouseover", () => {
                password[1].style.display = "block";
                password[0].style.display = "none";
            }
        )
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>