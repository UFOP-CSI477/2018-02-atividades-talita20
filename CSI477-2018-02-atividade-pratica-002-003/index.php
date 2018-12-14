<?php
require_once 'assets/php/classes/classProdutos.php';

$produtos = new Produtos();

if (isset($_POST['search'])) {
    $result = $produtos->pesquisa($_POST['nome']);
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
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <form action="index.php" method="post" class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" id="navbar-search-input"
                                   placeholder="Pesquisar produtos" name="nome">
                            <button type="submit" class="btn btn-info" name="search">Pesquisar</button>
                        </div>
                    </form>
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
                        <h3 class="box-title">Veja os produtos do Petshop!</h3>
                    </div>
                    <form action="login.php" method="get">
                        <div class="box-body">
                            <h4>Para realizar a compra, inclua no carrinho de compras os produtos que deseja, e finalize
                                a compra.</h4>

                            <?php if (isset($result)) {
                                while ($rowPesquisa = $result->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                    <div class="col-md-3" align="center">
                                        <img class="img-responsive pad" src="<?php echo $rowPesquisa->imagem ?>"
                                             alt="Photo"
                                             width="50%">
                                        <h3><?php echo $rowPesquisa->nome ?></h3>
                                        <h3>R$ <?php echo $rowPesquisa->preco ?></h3>
                                        <input type="checkbox" name="carrinho[]" value="<?php echo $rowPesquisa->id ?>"> <strong>Adicionar ao carrinho</strong>
                                    </div>
                                    <?php
                                }
                            } else {
                                $stmt = $produtos->index();
                                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                    <div class="col-md-3" align="center">
                                        <img class="img-responsive pad" src="<?php echo $row->imagem ?>" alt="Photo"
                                             width="50%">
                                        <h3><?php echo $row->nome ?></h3>
                                        <h3>R$ <?php echo $row->preco ?></h3>
                                        <input type="checkbox" name="carrinho[]" value="<?php echo $row->id ?>"> <strong>Adicionar ao carrinho</strong>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                        <h4>Caro cliente, ao finalizar a compra você será direcionado para a página de login do sistema. Se não possuir uma conta, <a href="cadastrar.php"> cadastre no sistema. </a></h4>
                        <div class="form-group col-md-offset-6">
                            <button type="submit" name="compra" class="btn btn-success btn-md">Finalizar compra</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('footer.php') ?>
</div>

<!-- jQuery 3 -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
</body>
</html>
