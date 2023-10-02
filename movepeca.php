<?php 
function trocaLetra($texto, $posicao, $letra ) {
    return substr($texto, 0, $posicao).$letra.substr($texto, $posicao+1);
}
function movePeca($tabuleiro, $origem, $destino) {
    $peca = substr($tabuleiro,$origem,1);
    $resp = $tabuleiro;
    $resp  = trocaLetra($resp , $origem, " ");
    $resp  = trocaLetra($resp , $destino, $peca);
    return $resp ;
}

function montaSqlEncontraTabuleiro ($cdg) {
    return "SELECT tabuleiro FROM jogos where codigo = '".$cdg."'";

}

function montaSqlAtualizaTabuleiro($codigo, $novoTabuleiro) {
    return "UPDATE jogos SET tabuleiro='".$novoTabuleiro."' where codigo='".$codigo."'";
}


$mysqli = new mysqli("localhost", "root", "", "xadrez");

$sqlEncontraTabuleiro = montaSqlEncontraTabuleiro($_GET["codigo"]);

$result = $mysqli->query($sqlEncontraTabuleiro);

$row = $result->fetch_row();

if(!$row) {
    die("sala de jogos inexistente");
}

$tabuleiro = $row[0];
$novoTabuleiro = movePeca($tabuleiro, $_GET["ori"], $_GET["dest"]);

$sqlAtualizaTabuleiro = montaSqlAtualizaTabuleiro($_GET["codigo"], $novoTabuleiro);

$mysqli->query($sqlAtualizaTabuleiro);

echo($novoTabuleiro)
?>

