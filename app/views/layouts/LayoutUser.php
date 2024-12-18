<?php

    if($data['user'] === 'Register')
    {
        require_once "./app/views/user/{$data['user']}.php";
    }
    elseif ($data['user'] === 'Login')
    {
        require_once "./app/views/user/{$data['user']}.php";
    }else
    {
        require_once './components/header.php';
        require_once "./app/views/user/{$data['user']}.php";
        require_once './components/footer.php';
    }
    
?>
