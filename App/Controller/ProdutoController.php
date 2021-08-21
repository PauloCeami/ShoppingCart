<?php

namespace App\Controller;

use App\Model\ProdutoModel;

class ProdutoController {

    function __construct() {
        
    }

    public function getProdutoPorID($id) {
        return ProdutoModel::getInstance()->findProdutoByID($id);
    }

    public function getProdutos() {
        return ProdutoModel::getInstance()->getAll();
    }

    public function save() {
        
    }

    public function update() {
        
    }

    public function delete() {
        
    }

}
