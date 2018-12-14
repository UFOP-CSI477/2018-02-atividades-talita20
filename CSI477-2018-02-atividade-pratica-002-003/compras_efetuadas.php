<?php include_once('header_cliente.php');
require_once 'assets/php/classes/classCompras.php';
require_once 'assets/php/classes/classProdutos.php';

$compras = new Compras();
$produtos = new Produtos();
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Compras Efetuadas</h3>
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
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $stmt = $compras->index();
                        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                            $rowProd = $produtos->view();
                            ?>
                            <tr>
                                <td><?php echo $row->data; ?></td>
                                <td><?php echo $rowProd->nome; ?></td>
                                <td><?php echo $row->quantidade; ?></td>
                                <td><?php echo $row->quantidade * $rowProd->preco; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<?php include_once('footer.php') ?>




