<?php
include_once './config.php';
include_once './vendor/autoload.php';

use App\Model\Produto;
use App\Controller\ProdutoController;

$prod = new Produto();
$produtoController = new ProdutoController();
$produtos = $produtoController->getProdutos();
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Shopping PreCode</title>
        <link rel="stylesheet" href="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css">
    </head>
    <body>

        <?php include_once './App/View/menu.php'; ?>

        <div class="row column text-center">
            <h2>Shopping PreCode</h2>
            <hr>
        </div>

        <div class="row small-up-2 large-up-4">
            <?php foreach ($produtos as $produto): ?>
                <div class="column">
                    <img class="thumbnail" width="270" height="270" src="<?php echo BASE_URL . 'Assets/img/' . $produto->getFoto() ?>">
                    <h5><?php echo $produto->getTitulo() ?></h5>
                    <p style="color:#ff6666 ">R$ <?php echo number_format($produto->getPreco(), 2, ",", ".") ?></p>
                    <a class="button expanded" href="<?= BASE_URL ?>App/view/detalheProduto.php?id=<?php echo $produto->getId() ?>">Comprar</a>
                </div>
            <?php endforeach; ?>
            <input type="hidden" id="URL" value="<?= BASE_URL ?>" />
        </div>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
        <script src="Assets/js/carrinho.js?id=<?= rand() ?>"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>
