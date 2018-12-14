<?php include_once('header_cliente.php');
require_once 'assets/php/classes/classProdutos.php';
require_once 'assets/php/classes/classUsers.php';

$produto = new Produtos();
?>

<section class="content-header">
    <h1 align="center">Seja bem-vindo(a) <?php echo $_SESSION['name']; ?>!</h1>
    <h2>Carrinho de compras</h2>
</section>
<div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th width="20%">Imagem</th>
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
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</div>

<?php include_once('footer.php') ?>




