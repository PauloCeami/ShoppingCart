<?php

include_once '../config.php';
include_once '../vendor/autoload.php';

use App\Controller\ProdutoController;
use App\Controller\CartController;
use App\Model\ProdutoModel;
use App\Model\Produto;

$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);

switch ($acao) {

    case 'add':
        $produto_id = filter_input(INPUT_POST, 'produto', FILTER_SANITIZE_STRING);
        $quantidade = filter_input(INPUT_POST, 'qtd', FILTER_SANITIZE_NUMBER_INT);
        $ID_SESSION = md5($produto_id);

        $prod = new Produto();
        $produtoController = new ProdutoController();

        $prod = $produtoController->getProdutoPorID($produto_id);

        // O PRODUTO PASSADO NA URL PRECISA EXISTIR NO BANCO 
        if (is_null($prod->getId())) {
            echo json_encode('PRDNOTENC');
            return;
        }

        // O PRODUTO PRECISA TER ESTOQUE
        if ($prod->getEstoque() < $quantidade) {
            echo json_encode('PRDNOT');
            return;
        }

        // SE A SESSAO DO PRODUTO NAO EXISTIR, CRIA UMA SESSION COM ARRAY VAZIO
        if (!isset($_SESSION[SESSION_CART])) {
            $_SESSION[SESSION_CART] = array();
        }

        // ATRIBUI VALORES AO ITEM DO CARRINHO NA SESSAO CRIADA
        if (empty($_SESSION[SESSION_CART][$ID_SESSION])) {
            $_SESSION[SESSION_CART][$ID_SESSION] = array(
                'id' => $produto_id,
                'qtd' => $quantidade
            );
        } else {
            $_SESSION[SESSION_CART][$ID_SESSION]['qtd'] = $quantidade;
        }

        $cart = new CartController();
        echo $cart->getCart();
        break;

    case 'loadItens':
        $cart = new CartController();
        echo $cart->getCart();
        break;

    case 'deleteItem':

        $produto_key_session = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        if (isset($_SESSION[SESSION_CART][$produto_key_session])) {
            unset($_SESSION[SESSION_CART][$produto_key_session]);
            echo json_encode("ok");
        }
        break;

    default :
        echo 'nenhuma acao foi definida';
}


