<?php

require_once "database.php";

class Compras
{
    private $id;
    private $quantidade;
    private $data;
    private $produtos_id;
    private $users_id;
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

    function setQuantidade($value){
        $this->quantidade = $value;
    }

    function setData($value){
        $this->data = $value;
    }

    function setProdutos_id($value){
        $this->produtos_id = $value;
    }

    function setUsers_id($value){
        $this->produtos_id = $value;
    }

    function setCreated($value){
        $this->created_at = $value;
    }

    function setUpdated($value){
        $this->updated_at = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `compras`(`quantidade`,`data`,`produtos_id`, `users_id`, `created_at`, `updated_at`) VALUES (:quantidade,:data,:produtos_id, :users_id, :created_at, :updated_at)");
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":produtos_id", $this->produtos_id);
            $stmt->bindParam(":users_id", $this->users_id);
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
            $stmt = $this->conn->prepare("UPDATE `compras` SET `quantidade` = :quantidade, `data` = :data, `produtos_id` = :produtos_id, `users_id` = :users_id, `created_at` = :created_at, `updated_at` = :updated_at WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":produtos_id", $this->produtos_id);
            $stmt->bindParam(":users_id", $this->users_id);
            $stmt->bindParam(":created_at", $this->created_at);
            $stmt->bindParam(":updated_at", $this->updated_at);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `compras` WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `compras` WHERE `id` = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `compras` WHERE 1 ORDER BY `id`");
        $stmt->execute();
        return $stmt;
    }

}