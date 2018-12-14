<?php include_once('header_administrador.php');
require_once 'assets/php/classes/classProdutos.php';

$produto = new Produtos();

if(isset($_POST['insert'])) {
    $produto->setNome($_POST['nome']);
    $produto->setPreco($_POST['preco']);
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d H:i');
    $produto->setCreated($date);

    $imagem = $_FILES["imagem"];
    if (!empty($imagem["name"])) {
        $ext = strtolower(substr($_FILES['imagem']['name'],-4));
        $nome_arquivo = md5(uniqid(time())) . $ext;
        $diretorio = "assets/img/";
        if (!file_exists($diretorio)){
            mkdir($diretorio, 0777, true);
        }
        $caminho_arquivo = $diretorio . $nome_arquivo;
        move_uploaded_file($imagem["tmp_name"], $caminho_arquivo);
        $produto->setImagem($caminho_arquivo);
    }

    if($produto->insert() == 1){
        $result = "Inserido com sucesso!";
    }else{
        $error = "Erro ao inserir. Tente novamente";
    }
}
?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastrar Produto</h3>
                </div>
                <?php
                if (isset($result)) {
                    ?>
                    <div class="alert alert-success">
                        <?php echo $result; ?>
                    </div>
                    <?php
                }else if(isset($error)){
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                    <?php
                }
                ?>
                <form action="produto_cadastrar.php" method="post" role="form" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do produto">
                        </div>
                        <div class="form-group">
                            <label for="preco">Preço</label>
                            <input type="text" class="form-control" name="preco" id="dinheiro" placeholder="R$ 100,00">
                        </div>
                        <div class="form-group">
                            <label for="imagem">Imagem</label>
                            <input type="file" name="imagem" id="imagem">
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
</div>

<?php include_once('footer.php') ?>




