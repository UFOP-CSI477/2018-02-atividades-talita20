<?php
require_once 'assets/php/classes/classUsers.php';

$user = new Users();

if (isset($_POST['insert'])) {
    $user->setName($_POST['name']);
    $user->setEmail($_POST['email']);
    $user->setType(1);
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d H:i');
    $user->setCreated($date);

    if ($_POST['password'] != null && $_POST['password2'] != null) {
        if ($_POST['password'] != $_POST['password2']) {
            $error = 'A nova senha deve ser igual a confirmação da senha!';
        } else {
            $user->setPassword(sha1($_POST['password']));
        }
    }

    if ($user->insert() == 1) {
        $result = "Inserido com sucesso!";
    } else {
        $error = "Erro ao inserir. Tente novamente";
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Petshop</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand"><b>Pet</b>shop</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <ul class="nav navbar-nav">
                                <li><a href="cadastrar.php">Cadastrar</a></li>
                                <li><a href="login.php">Login</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar Conta</h3>
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
                    <form action="cadastrar.php" method="post" role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Nome do cliente">
                            </div>
                            <div class="form-group">
                                <label for="nome">E-mail</label>
                                <input type="text" class="form-control" name="email" id="email"
                                       placeholder="E-mail do cliente">
                            </div>
                            <div class="form-group">
                                <label for="nome">Senha</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <label for="nome">Confirmar senha</label>
                                <input type="password" class="form-control" name="password2" id="password2">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="insert" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

<?php include_once('footer.php') ?>




