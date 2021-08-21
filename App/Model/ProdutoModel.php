<?php

namespace App\Model;

class ProdutoModel {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new ProdutoModel();
        return self::$instance;
    }

    public function findProdutoByID($id) {
        try {
            $sql = "SELECT * FROM produtos where id=:id";
            $statement_sql = Connection::getConnection()->prepare($sql);
            $statement_sql->bindValue(":id", $id);
            $statement_sql->execute();
            return $this->popular($statement_sql->fetch(\PDO::FETCH_ASSOC));
        } catch (\PDOException $e) {
            print "Erro em getProdutoPorID :: " . $e->getMessage();
        }
    }

    public function popular($linha) {
        $prod = new Produto();
        $prod->setId($linha["id"]);
        $prod->setTitulo($linha ["titulo"]);
        $prod->setDescricao($linha["descricao"]);
        $prod->setEstoque($linha["estoque"]);
        $prod->setFoto($linha["foto"]);
        $prod->setPreco($linha["preco"]);
        return $prod;
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM produtos";
            $statement_sql = Connection::getConnection()->prepare($sql);
            $statement_sql->execute();
            return $this->fech($statement_sql);
        } catch (\PDOException $e) {
            print "Erro em getAll Produtos :: " . $e->getMessage();
        }
    }

    private function fech($statement_sql) {
        $results = array();
        if ($statement_sql) {
            while ($linha = $statement_sql->fetch(\PDO::FETCH_OBJ)) {
                $prod = new Produto();
                $prod->setId($linha->id);
                $prod->setTitulo($linha->titulo);
                $prod->setDescricao($linha->descricao);
                $prod->setEstoque($linha->estoque);
                $prod->setFoto($linha->foto);
                $prod->setPreco($linha->preco);
                $results [] = $prod;
            }
        }
        return $results;
    }

}
