<?php include_once('header_administrador.php');
require_once 'assets/php/classes/classProdutos.php';

$produto = new Produtos();

if (isset($_POST['edit'])) {
    $imagem = $_FILES["imagem"];

    if (!empty($imagem["name"])) {
        $ext = strtolower(substr($_FILES['imagem']['name'], -4));
        $nome_arquivo = md5(uniqid(time())) . $ext;
        $diretorio = "assets/img/";
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0777, true);
        }
        $caminho_arquivo = $diretorio . $nome_arquivo;
        move_uploaded_file($imagem["tmp_name"], $caminho_arquivo);

        $produto->setId($_POST['id']);
        $produto->setNome($_POST['nome']);
        $produto->setPreco($_POST['preco']);
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');
        $produto->setCreated($_POST['created_at']);
        $produto->setUpdated($date);
        $produto->setImagem($caminho_arquivo);

    } else {
        $produto->setId($_POST['id']);
        $produto->setNome($_POST['nome']);
        $produto->setPreco($_POST['preco']);
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');
        $produto->setCreated($_POST['created_at']);
        $produto->setUpdated($date);
        $produto->setImagem($_POST['img_old']);
    }

    if ($produto->edit() == 1) {
        $result = "Editado com sucesso!";
    } else {
        $error = "Erro ao editar. Tente novamente";
    }
}

if (isset($_POST['excluir'])) {
    $produto->setId($_POST['id']);
    if ($produto->delete() == 1) {
        $result = "Produto deletado com sucesso!";
    } else {
        $error = "Erro ao deletar. Tente novamente";
    }
}
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Produtos Cadastrados</h3>
    </div>
    <div class="box-body">
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
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th width="20%">Imagem</th>
                <th width="15%">Ação</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $stmt = $produto->index();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                ?>
                <tr>
                    <td><?php echo $row->nome; ?></td>
                    <td><?php echo $row->preco; ?></td>
                    <td><img src="<?php echo $row->imagem ?>" class="img-responsive" width="50%"></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#editar<?php echo $row->id ?>">Editar
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#deletar<?php echo $row->id ?>">
                            Excluir
                        </button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <?php
        $stmt = $produto->index();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div class="modal fade" id="editar<?php echo $row->id ?>" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Editar Produto</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" action="produto_gerenciar.php" method="post"
                                  enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="nome">Nome</label>
                                        <input type="text" class="form-control" name="nome" id="nome"
                                               value="<?php echo $row->nome ?>" placeholder="Nome do produto">
                                    </div>
                                    <div class="form-group">
                                        <label for="preco">Preço</label>
                                        <input type="text" class="form-control" name="preco" id="preco"
                                               value="<?php echo $row->preco ?>" placeholder="R$ 100,00">
                                    </div>
                                    <div class="form-group">
                                        <label for="imagem">Imagem</label>
                                        <img src="<?php echo $row->imagem ?>" class="img-responsive" width="25%">
                                        <input type="hidden" name="id" id="id" value="<?php echo $row->id ?>">
                                        <input type="hidden" name="img_old" id="img_old" value="<?php echo $row->imagem ?>">
                                        <input type="hidden" name="created_at" id="created_at" value="<?php echo $row->created_at ?>">
                                        <input type="file" name="imagem" id="imagem">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" name="edit" class="btn btn-primary">Editar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php
        $stmt = $produto->index();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div class="modal fade" id="deletar<?php echo $row->id ?>" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Excluir Produto</h4>
                        </div>
                        <form role="form" action="produto_gerenciar.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <p>Deseja excluir o produto <?php echo $row->nome ?>?</p>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id" value="<?php echo $row->id ?>">
                                <button type="submit" name="excluir" class="btn btn-primary">Sim</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</div>

<?php include_once('footer.php') ?>




