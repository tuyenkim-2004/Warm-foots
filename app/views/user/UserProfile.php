<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
            margin-bottom: 50px;
            margin-top: 50px;

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
    $user_id = $user["user_id"];
    $fullName = $user["user_name"];
    $email = $user["email"];
    $password = $user["password"];

    ?>

    <!-- HTML phần view -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 avatar">
                <img id="avatarImage" src="<?php echo $avatar; ?>" alt="Avatar">
                <p>
                    <!-- <button type="button" id="uploadButton" class="btn btn-primary mt-2">Upload Avatar</button> -->
                    <input type="file" id="avatarInput" style="display: none;">

                    <!-- Nút bấm tải ảnh -->
                    <button type="button" id="uploadButton" class="btn btn-primary mt-2">Upload Avatar</button>

                    <!-- Hình đại diện -->

                </p>
            </div>
            <div class="col-md-8">
                <h2>Profile Settings</h2>
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control short-input" value="<?php echo $fullName; ?>" placeholder="Your full name">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control short-input password" value=<?php echo $password; ?> placeholder="Your password">
                        <input type="input" style="display : none" class="form-control short-input password" value=<?php echo $password; ?> placeholder="Your password">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control short-input" value="<?php echo $email; ?>" placeholder="Your email address">
                    </div>
                    <button type="button" class="btn btn-success ml-2" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="editProfileModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Edit Profile</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="./UserProfileController/editUserProfile" method="POST">
                <input type="hidden">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control short-input" value="<?php echo $fullName; ?>" placeholder="Your full name" name="name">
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control short-input password" value="<?php echo htmlspecialchars($password); ?>" placeholder="Your password">                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success ml-2" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>

            </div>
        </div>
    </div>

    <script>
        // Tải avatar từ localStorage khi trang được tải
        window.onload = function() {
            const avatarImage = document.getElementById('avatarImage');
            const uploadButton = document.getElementById('uploadButton');
            const avatarInput = document.getElementById('avatarInput');

            // Kiểm tra sự tồn tại của các phần tử
            if (!avatarImage) {
                console.error('Element with ID "avatarImage" not found!');
                return;
            }
            if (!uploadButton) {
                console.error('Element with ID "uploadButton" not found!');
                return;
            }
            if (!avatarInput) {
                console.error('Element with ID "avatarInput" not found!');
                return;
            }

            // Tải avatar từ localStorage (nếu có)
            const savedAvatar = localStorage.getItem('avatar');
            if (savedAvatar) {
                avatarImage.src = savedAvatar;
                console.log('Avatar loaded from localStorage.');
            } else {
                console.log('No avatar found in localStorage.');
            }

            // Gắn sự kiện click cho nút Upload Avatar
            uploadButton.addEventListener('click', function() {
                avatarInput.click(); // Mở hộp thoại chọn file
            });

            // Gắn sự kiện change cho input file
            avatarInput.addEventListener('change', loadAvatar);
        };

        // Hàm xử lý khi người dùng chọn ảnh mới
        function loadAvatar(event) {
            const avatarImage = document.getElementById('avatarImage');
            if (!avatarImage) {
                console.error('Element with ID "avatarImage" not found!');
                return;
            }

            const file = event.target.files[0]; // Lấy file đầu tiên được chọn
            if (!file) {
                console.warn('No file selected.');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                avatarImage.src = e.target.result; // Hiển thị ảnh mới
                localStorage.setItem('avatar', e.target.result); // Lưu ảnh vào localStorage
                console.log('Avatar updated and saved to localStorage.');
            };

            // Đọc tệp dưới dạng URL
            reader.readAsDataURL(file);
        }
        
        const password = document.querySelectorAll(".password");

        password[0].addEventListener("mouseout", () => {
            password[0].style.display = "block";
            password[1].style.display = "none";
        })

        password[0].addEventListener("mouseover", () => {
            password[1].style.display = "block";
            password[0].style.display = "none";
        })
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>