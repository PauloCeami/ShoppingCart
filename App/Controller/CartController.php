<?php

namespace App\Controller;

use App\Controller\ProdutoController;
use App\Model\Produto;

class CartController {

    function __construct() {
        
    }

    public function getCart() {

        $jsonCart = array();
        $jsonCart['count'] = 0;
        $jsonCart['subTotalCart'] = 0;
        $subtotalcart = 0;

        // if cart exists and not null
        if (isset($_SESSION[SESSION_CART]) && !empty($_SESSION[SESSION_CART])) {

            $jsonCart['count'] = count($_SESSION[SESSION_CART]);

            foreach ($_SESSION[SESSION_CART] as $keySession => $itemCart) {
                $produto = new Produto();
                $prodController = new ProdutoController();
                $produto = $prodController->getProdutoPorID($itemCart['id']);
                
                $jsonCart['dados'][] = array(
                    'id' => $keySession,
                    'titulo' => $produto->getTitulo(),
                    'qtd' => $itemCart['qtd'],
                    'valor' => number_format($produto->getPreco(), 2, ",", "."),
                    'total' => number_format($produto->getPreco() * $itemCart['qtd'], 2, ",", "."),
                    'foto' => BASE_URL . 'Assets/img/' . $produto->getFoto()
                );
                $subtotalcart += $produto->getPreco() * $itemCart['qtd'];
                $jsonCart['subTotalCart'] = number_format($subtotalcart, 2, ",", ".");
            }
        }

        return json_encode($jsonCart);
    }

}
