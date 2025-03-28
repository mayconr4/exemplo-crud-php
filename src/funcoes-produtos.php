<?php 
require_once "conecta.php"; 

function listarProdutos(PDO $conexao):array { 
    $sql = " SELECT  
    produtos.id , produtos.nome  AS produto, 
    produtos.preco, produtos.quantidade, 
    fabricantes.nome AS fabricante , 
    produtos.preco, produtos.quantidade, 
    (produtos.preco * produtos.quantidade) AS total         
    FROM produtos 
    INNER JOIN fabricantes ON produtos.fabricante_id =fabricantes.id 
    ORDER BY produto";                                

    try {
        $consulta = $conexao->prepare($sql); 
        $consulta->execute(); 
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ao excluir fabricante: ".$erro->getMessage());
    }
}    

function inseririrProduto( 
    PDO $conexao, string $nome, float $preco, 
     float $quantidade , int $idfabricante, string $descricao 
    ):void {  
        $sql = "INSERT INTO produtos(nome , preco, quantidade, fabricante_id, descricao) 
        VALUES(:nome), (:preco), (:quantidade), (:fabricante), (:descricao)";

        try {
         $consulta = $conexao->prepare($sql);  
         
         $consulta->bindValue(":nome , :preco, :quantidade, :fabricante, :descricao", $nome, $preco, $quantidade, $idfabricante, $descricao, PDO::PARAM_STR); 
         
         $consulta->execute();
        } 
        catch(Exception $erro){ 
            die ("Erro ao inserir: ". $erro->getMessage());
        }
        
        
    }
