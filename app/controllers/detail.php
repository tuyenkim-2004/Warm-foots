
<?php 

class detail extends Controller {
    function index(){

        $this->view("LayoutUser", [
            "user" => "ProductDetail"
        ]);
    }
}