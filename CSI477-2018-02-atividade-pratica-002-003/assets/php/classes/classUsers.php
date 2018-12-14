<?php

require_once "database.php";

class Users
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $type;
    private $remember_token;
    private $created_at;
    private $updated_at;

    public function __construct() {
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }

    function setId($value){
        $this->id = $value;
    }

    function setName($value){
        $this->name = $value;
    }

    function setEmail($value){
        $this->email = $value;
    }

    function setPassword($value){
        $this->password = $value;
    }

    function setType($value){
        $this->type = $value;
    }

    function setRemember($value){
        $this->remember_token = $value;
    }

    function setCreated($value){
        $this->created_at = $value;
    }

    function setUpdated($value){
        $this->updated_at = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `users`(`name`,`email`,`password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES (:name, :email, :password,:type, :remember_token, :created_at, :updated_at)");
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":remember_token", $this->remember_token);
            $stmt->bindParam(":created_at", $this->created_at);
            $stmt->bindParam(":updated_at", $this->updated_at);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `users` SET `name` = :name, `email` = :email, `password` = :password, `type` = :type, `remember_token` = :remember_token, `created_at` = :created_at, `updated_at` = :updated_at  WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":remember_token", $this->remember_token);
            $stmt->bindParam(":created_at", $this->created_at);
            $stmt->bindParam(":updated_at", $this->updated_at);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function indexEmail($email){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `email` = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            return $row;
        }catch(PDOException $e){
            return $e;
        }
    }

    public function locate(){
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `email` = :email");
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }
}