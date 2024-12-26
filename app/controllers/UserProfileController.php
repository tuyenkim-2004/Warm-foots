<?php
class UserProfileController extends Controller {
    private $model;

    public function __construct() {
        $this->model = $this->model("UserProfileModel"); // Khởi tạo model
        
    }

    public function displayUserProfile() {  
        $userProfile = $this->model->loadUserProfile();

        if ($userProfile) {
            // $user_data =  [
            //     'full_name' => $userProfile['full_name'],
            //     'email' => $userProfile['email'],
            //     'avatar' => $userProfile['avatar'],
            // ];

            $this->view("LayoutUser", [
                "user" => "UserProfile",
                "user_data" => $userProfile
            ]);
        } else {
            header( "location: /Warm-foots/AuthenticationController/login");
        }

    }
}
?>