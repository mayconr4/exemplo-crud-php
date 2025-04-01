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
//inserindo produto
function inserirProduto( 
    PDO $conexao, string $nome, float $preco, 
     int $quantidade , int $idFabricante, string $detalhes 
    ):void {  
        $sql = "INSERT INTO produtos(nome , preco, quantidade, fabricante_id, detalhes) 
        VALUES(:nome, :preco, :quantidade, :fabricante, :detalhes)";

        try {
         $consulta = $conexao->prepare($sql);  
         
         
         $consulta->bindValue(":nome",$nome, PDO::PARAM_STR); 
         $consulta->bindValue(":preco",$preco, PDO::PARAM_STR); 
         $consulta->bindValue(":quantidade",$quantidade, PDO::PARAM_INT); 
         $consulta->bindValue(":fabricante",$idFabricante, PDO::PARAM_INT); 
         $consulta->bindValue(":detalhes",$detalhes, PDO::PARAM_STR);   


         
         $consulta->execute();
        } 
        catch(Exception $erro){ 
            die ("Erro ao inserir: ". $erro->getMessage());
        }
        
        
    }
 
// listatUmProduto 
function listarUmproduto(PDO $conexao, int $idProduto ): array{ 
    $sql = "SELECT * FROM produtos WHERE id = :id" ;

    try{ 
        $consulta = $conexao->prepare($sql); 
        $consulta->bindValue(":id", $idProduto, PDO::PARAM_INT); 
        $consulta->execute(); 

        return $consulta->fetch(PDO::FETCH_ASSOC); 
    } catch(Exception $erro){ 
        die("Erro ao arregar produtos:".$erro->getMessage());
    }
}