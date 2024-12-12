<?php

    class Database{
        private $host ="localhost";
        private $dbname ="warm-foots";
        private $user= "root";
        private $password = "1234";
        // private $password = "";
        private $connection;

        public function __construct()
        {
           $this->connection= $this->connect();; 
        }

        private function connect()
        {
            try{
                $connection = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $connection;
            }catch(PDOException $e){
                throw new Exception("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
            }
        }

        public function getConnection()
        {
            return $this->connection;
        }


        public function getData($tableName, $params)
        {
            $conditions ='';
            foreach($params as $key => $value){
                $conditions = "$key = :$key AND ";
            }
            $conditions = trim($conditions, ' AND ');

            $query ="SELECT * FROM $tableName WHERE $conditions";
            $stmt=$this->connection->prepare($query);
            foreach($params as $key => $value){
                $stmt->bindValue(":$key", $value, PDO::PARAM_STR);
            }
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        public function getAll($tableName)
        {
            $query = "SELECT * FROM $tableName";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        public function getDataByQuery($query, $params =[])
        {
            $stmt = $this->connection->prepare($query);
            if($params){
                foreach($params as $key => $value){
                    $stmt->bindParam('key', $value, PDO::PARAM_INT);
                }
            }
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        public function insertData($tableName, $data)
        {
            try {
                $fields = implode(", ", array_keys($data));
                $values = ":" . implode(", :", array_keys($data));

                $query = "INSERT INTO $tableName ($fields) VALUES ($values)";
                $stmt = $this->connection->prepare($query);

                foreach ($data as $key => $value) {
                    $stmt->bindValue(":$key", $value, PDO::PARAM_STR);
                }

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }

        public function updateData($tableName, $data, $condition, $params)
        {
            try {
                $setClause = "";
                foreach ($data as $key => $value) {
                    $setClause .= "$key = :$key, ";
                }
                $setClause = rtrim($setClause, ', ');

                $query = "UPDATE $tableName SET $setClause WHERE $condition";

                $stmt = $this->connection->prepare($query);

                // Binding data values
                foreach ($data as $key => $value) {
                    $stmt->bindValue(":$key", $value);
                }

                // Binding condition parameters
                foreach ($params as $paramKey => $paramValue) {
                    $stmt->bindValue($paramKey, $paramValue);
                }

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function deleteData($tableName, $condition, $params = [])
        {
            try {
                $this->connection->beginTransaction();

                $query = "DELETE FROM $tableName WHERE $condition";
                $stmt = $this->connection->prepare($query);

                // Bind condition parameters
                foreach ($params as $paramKey => $paramValue) {
                    $stmt->bindValue($paramKey, $paramValue);
                }

                $stmt->execute();

                $this->connection->commit();

                return true;
            } catch (Exception $e) {
                $this->connection->rollBack();
                return false;
            }
        }

        public function executeQuery($sql)
        {
            try {
                $result = $this->connection->query($sql);
                return $result;
            } catch (PDOException $e) {
                throw new Exception("Query failed: " . $e->getMessage());
            }
        }

        public function query($sql, $params = [])
        {
            try {
                $statement = $this->connection->prepare($sql);
                $statement->execute($params);
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Lỗi truy vấn cơ sở dữ liệu: " . $e->getMessage());
            }
        }
}

?>