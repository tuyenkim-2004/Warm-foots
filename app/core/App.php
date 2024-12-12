<?php

class App
{
    protected $controller = 'AuthController';
    protected $action = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->urlProcess();

        // Xác định controller
        if (!empty($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';

            // Kiểm tra thư mục user
            if (file_exists('./mvc/controllers/user/' . $controllerName . '.php')) {
                $this->controller = 'user/' . $controllerName;
                unset($url[0]);
            }
            
            elseif (file_exists('./mvc/controllers/admin/' . $controllerName . '.php')) {
                $this->controller = 'admin/' . $controllerName;
                unset($url[0]);
            }
            elseif (file_exists('./mvc/controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                die("Controller not found.");
            }
        }

        require_once './mvc/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->action = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    protected function urlProcess()
    {
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
        return [];
    }
}
