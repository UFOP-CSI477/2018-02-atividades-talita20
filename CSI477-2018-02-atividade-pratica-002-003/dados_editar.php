<?php include_once('header_cliente.php');
require_once 'assets/php/classes/classUsers.php';

$user = new Users();
/*if(isset($_GET['email'])){
    $usuario = $user->setEmail($_GET['email']);
}*/
$usuario = $user->setEmail($_SESSION['email']);
$usuario = $user->locate();

if (isset($_POST['edit'])) {
    $user->setId($_POST['id']);
    $user->setName($_POST['name']);
    $user->setEmail($_POST['email']);
    $user->setType($_POST['type']);
    $user->setRemember($_POST['remember_token']);
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d H:i');
    $user->setCreated($_POST['created_at']);
    $user->setUpdated($date);

    if ($_POST['password'] != null && $_POST['password2'] != null) {
        if ($_POST['password'] != $_POST['password2']) {
            $error = 'A nova senha deve ser igual a confirmação da senha!';
        } else {
            $user->setPassword(sha1($_POST['password']));
        }
    } else {
        $user->setPassword(sha1($_POST['senha_antiga']));
    }
    if ($user->edit() == 1) {
        $result = "Editado com sucesso!";
    } else {
        $error = "Erro ao editar. Tente novamente";
    }

}

?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Dados</h3>
                </div>
                <?php
                if (isset($result)) {
                    ?>
                    <div class="alert alert-success">
                        <?php echo $result; ?>
                    </div>
                    <?php
                } else if (isset($error)) {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                    <?php
                }
                ?>
                <form action="dados_editar.php" method="post" role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nome do cliente"
                                   value="<?php echo $usuario->name ?>">
                        </div>
                        <div class="form-group">
                            <label for="nome">E-mail</label>
                            <input type="text" class="form-control" name="email" id="email"
                                   placeholder="E-mail do cliente" value="<?php echo $usuario->email ?>">
                        </div>
                        <div class="form-group">
                            <label for="nome">Nova senha</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="nome">Confirmar senha</label>
                            <input type="password" class="form-control" name="password2" id="password2">
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>">
                        <input type="hidden" name="type" value="1">
                        <input type="hidden" name="senha_antiga" value="<?php echo $usuario->password ?>">
                        <input type="hidden" name="remember_token" value="<?php echo $usuario->remember_token ?>">
                        <input type="hidden" name="created_at" value="<?php echo $usuario->created_at ?>">
                        <button type="submit" name="edit" class="btn btn-primary">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</div>

<?php include_once('footer.php') ?>




