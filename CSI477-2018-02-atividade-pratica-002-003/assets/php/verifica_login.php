<?php
session_start();
ob_start();
require_once 'classes/classUsers.php';
$user = new Users();
$email = $_POST['email'];
$senha = $_POST['password'];
$usuario = $user->setEmail($email);
$usuario = $user->locate();
if (is_null($usuario) || empty($usuario)) {
    echo "E-mail inválido";
    exit();
}
if (sha1($senha) == $usuario->password) {
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION['id'] = $usuario->id;
    $_SESSION['email'] = $usuario->email;
    $_SESSION['name'] = $usuario->name;
    $_SESSION['password'] = $usuario->password;
    if($usuario->type == 2){
        header("Location: ../../index_administrador.php");
    }else if($usuario->type == 3){
        header("Location: ../../index_operador.php");
    }else {
        echo $_POST['carrinho'];
        if($_POST['carrinho'] != null){
            foreach ($_POST['carrinho'] as $compras){
                $carrinho = explode(",",$compras);
            }
            //header("Location: ../../comprar.php?carrinho=".$carrinho);
        }else{
            echo "oi";
            //header("Location: ../../index_cliente.php");
        }
    }
} else {
    echo "Senha inválida";
    exit();
}
?>