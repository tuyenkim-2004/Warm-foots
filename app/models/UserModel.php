<?php

    class UserModel extends Database
    {
        private $user;

        public function model(){
            return 'users';
        }

        public function registerUser($name, $email, $password)
        {
            $tableName = $this->model();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $params =[
                'user_name' => $name,
                'password' => $hashedPassword,
                'email' => $email,
                'role_id' => 2
            ];

            try{
                $result = $this->insertData($tableName, $params);

                if(!$result){
                    echo "Có lỗi khi thêm dữ liệu vào cơ sở dữ liệu.";
                }
            } catch (Exception $e){
                echo "Có lỗi xảy ra: " . $e->getMessage();
            }
            return $result;

        }

        public function create($name, $password, $email, $role)
        {
            $tableName = $this->model();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $parmas =[
                'user_name' => $name,
                'password' => $hashedPassword,
                'email' => $email,
                'role' => $role
            ];
            return $this->insertData($tableName, $parmas);
        }

        public function getUserById($user_id)
        {
            $tableName = $this->model();
            $sql = "SELECT * FROM $tableName WHERE id = :user_id";
            $params = [':user_id' => $user_id];
            $data = $this->getDataByQuery($sql, $params);
            return $data;
        }
    }
?>