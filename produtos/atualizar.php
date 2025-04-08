<?php 
require_once "../src/funcoes-produtos.php"; 

require_once "../src/funcoes-fabricantes.php";
$listaDeFabricantes = listarFabricantes($conexao);

//obtendo o valor do parametro via url
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT); 

// chamando a função para obter dados de um produto 
$produto = listarUmproduto($conexao,  $id );   

if(isset($_POST['atualizar'])){

    $nome = filter_input( 
        INPUT_POST, "nome",FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ); 

    $preco = filter_input( 
        INPUT_POST, "preco",FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION
    );   

    $quantidade = filter_input( 
        INPUT_POST, "quantidade",FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ALLOW_FRACTION
    ); 
      
    $idFabricante = filter_input(INPUT_POST, "fabricante", FILTER_SANITIZE_NUMBER_INT);

    $detalhes = filter_input( 
        INPUT_POST, "detalhes",FILTER_SANITIZE_FULL_SPECIAL_CHARS 
    );  

    // obs.: lembre-se que capturamos na verdade o value (que na pratica é o id do fabricante)
     

    atualizarProduto($conexao, $id, $nome, $preco, $quantidade, $idFabricante , $detalhes);        

    header("location:visualizar.php");
    exit;
} 



?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Atualização</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-2 shadow-lg rounded pb-1">
        <h1><a class="btn btn-outline-dark" href="visualizar.php">&lt; Voltar</a> Produtos | SELECT/UPDATE</h1>
        <hr>

        <form action="" method="post" class="w-50"> 
            <input type="hidden" name="id" value="<?=$produto['id']?>">
            <div class="mb-3">
                <label class="form-label" for="nome">Nome:</label>
                <input value="<?=$produto['nome']?>" class="form-control" type="text" name="nome" id="nome" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="preco">Preço:</label>
                <input value="<?=$produto['preco']?>"  class="form-control" type="number" min="10" max="10000" step="0.01" name="preco" id="preco" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="quantidade">Quantidade:</label>
                <input value="<?=$produto['quantidade']?>" class="form-control" type="number" min="1" max="100" name="quantidade" id="quantidade" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="fabricante">Fabricante:</label>
                <select class="form-select" name="fabricante" id="fabricante" required>
                    <option value=""></option> 
                    <!-- sempe manter um option vazio --> 

                    <!-- Algoritimo para seleção do fabricante do produto que srá editado  
                     
                    Se a fk da tabela produtos for igual  a PK da tabela fabricantes,
                    ouseja, se o id do fabricante do produto for igual a id 
                    do fabricane, então coloque o atributo "selected" no <otion> correspondente-> -->
                     
                <?php foreach($listaDeFabricantes as $fabricante): ?>
                     <option   
        <?php if($produto['fabricante_id'] === $fabricante['id']) echo " selected "
         // botar um espaço antes e depois do atributo SEMPRE?> 

                         value="<?=$fabricante['id']?>">
                        <?=$fabricante['nome']?>    
                    </option> 
                <?php endforeach; ?>
                    
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="detalhes">Detalhes:</label> <br>
                <textarea class="form-control" name="detalhes" id="detalhes" cols="30" rows="3"><?=$produto['detalhes']?></textarea>
            </div>
            <button class="btn btn-warning" type="submit" name="atualizar">Atualizar produto</button>
        </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>