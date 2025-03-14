<?php 
require_once "conecta.php";

/* Lógica das funções para o CRUD de Fabricantes */ 

//listarFabricante: usada pelá página fabricantes/visualizar.php 
function listarFabricantes(PDO $conexao):array{ 
    $sql = "SELECT * FROM fabricantes"; 


    /* Preparando o comando SQL antes de executar no servidor e guardando 
    em memória (váriavel consulta ou query) */
    $consulta = $conexao->prepare($sql); 
     
    /* Executando o comando no banco de dados  */
    $consulta->execute(); 
    
    
    /* Busca/retorna todos os dados provenientes da execução da consulta e os transforma em um array associativo */
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}