<?php
class App
{

    protected $controller = "HomeController";
    protected $action = "index"; 
    protected $params = [];
    protected $dbConnection; // Thêm thuộc tính cho kết nối DB


    function __construct()
    {
         // Khởi tạo kết nối cơ sở dữ liệu
        //  $this->dbConnection = new PDO('mysql:host=localhost;dbname=your_database_name', 'username', 'password');

        $arr = $this->UrlProcess();

        if (file_exists("./app/controllers/" . $arr[0] . ".php")) {
            $this->controller = $arr[0];
            unset($arr[0]);
        }
        require_once "./app/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        if (isset($arr[1])) {                                                           
            if (method_exists($this->controller, $arr[1])) {
                $this->action = $arr[1];
            }
            unset($arr[1]);
        }

        $this->params = $arr ? array_values($arr) : [];

        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    function UrlProcess()
    {
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
    }
}
