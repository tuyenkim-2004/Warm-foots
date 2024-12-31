<?php

    class Database{

    public $con;
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    // protected $password = "";
    protected $dbname = "warm-foots";

    public function __construct()
    {
        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->con->connect_error) {
            die("Kết nối thất bại: " . $this->con->connect_error);
        }

        $this->con->set_charset("utf8");
    }

    public function query($query)
    {
        return $this->con->query($query);
    }

    // Phương thức để lấy dữ liệu
    public function fetch($result)
    {
        return $result->fetch_assoc();
    }

    // Phương thức để chuẩn bị truy vấn
    public function prepare($query)
    {
        return $this->con->prepare($query);
    }

    // Phương thức để đóng kết nối
    public function close()
    {
        $this->con->close();
    }

}

?>