<?php

require_once "database.php";

class Produtos
{
    private $id;
    private $nome;
    private $preco;
    private $imagem;
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

    function setNome($value){
        $this->nome = $value;
    }

    function setPreco($value){
        $this->preco = $value;
    }

    function setImagem($value){
        $this->imagem = $value;
    }

    function setCreated($value){
        $this->created_at = $value;
    }

    function setUpdated($value){
        $this->updated_at = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `produtos`(`nome`,`preco`,`imagem`, `created_at`, `updated_at`) VALUES (:nome,:preco,:imagem, :created_at, :updated_at)");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":imagem", $this->imagem);
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
            $stmt = $this->conn->prepare("UPDATE `produtos` SET `nome` = :nome, `preco` = :preco, `imagem` = :imagem, `created_at` = :created_at, `updated_at` = :updated_at WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":imagem", $this->imagem);
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
            $stmt = $this->conn->prepare("DELETE FROM `produtos` WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `produtos` WHERE `id` = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `produtos` WHERE 1 ORDER BY `id`");
        $stmt->execute();
        return $stmt;
    }

    public function pesquisa($nome){
        $stmt = $this->conn->prepare("SELECT * FROM `produtos` WHERE `nome` LIKE '%{$nome}%'");
        $stmt->bindParam(":nome", $nome);
        $stmt->execute();
        return $stmt;
    }

}