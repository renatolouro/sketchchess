<?php
if($_GET["codigo"]=="")
    die("É necessário definir uma sala de jogo para continuar");


function montaSqlEncontraTabuleiro ($cdg) {
    return "SELECT tabuleiro FROM jogos where codigo = '".$cdg."'";

}

function montaSqlCriaNovoJogo($cdg) {
    return "INSERT INTO jogos (codigo, tabuleiro) VALUES('".$cdg."', 'TCBDRBCTPPPPPPPP                                pppppppptcbdrbct')";
}

$mysqli = new mysqli("localhost", "root", "", "xadrez");

$sqlEncontraTabuleiro = montaSqlEncontraTabuleiro($_GET["codigo"]);

$result = $mysqli->query($sqlEncontraTabuleiro);

$row = $result->fetch_row();


if(!$row) {
    $sqlNovoJogo = montaSqlCriaNovoJogo($_GET["codigo"]);
    $mysqli->query($sqlNovoJogo);
    $result = $mysqli->query($sqlEncontraTabuleiro);
    $row = $result->fetch_row();
}

$tabuleiro = $row[0]

?>


<html>
<head>
    <style>
        table {
            border-spacing:0px;
        }
        .casa { 
            height: 60px;
            width: 60px;
            margin:0px;
            padding: 0px;
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover; /* Resize the background image to cover the entire container */
        }
        .casa.preta {
            background-image: url("chess_assets/blackwood.png");
        }
        .casa.preta:hover {
            background-image: url("chess_assets/blackwood_azul.png");
        }
        .casa.branca {
            background-image: url("chess_assets/whitewood.png");
        }
        .casa.branca:hover {
            background-image: url("chess_assets/whitewood_azul.png");
            
        }
        .toolbar { 
            height : 50;
             width : 50; 

                position: absolute;
                 top: 10px;
                  left: 500px;      
            }            
    </style>

</head>
<body>
<table>
    <tr>
        <td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td>
        <td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td>
    </tr>
    <tr>
        <td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td>
        <td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td>
    </tr>
    <tr>
        <td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td>
        <td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td>
    </tr>
    <tr>
        <td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td>
        <td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td>
    </tr>
    <tr>
        <td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td>
        <td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td>
    </tr>
    <tr>
        <td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td>
        <td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td>
    </tr>
    <tr>
        <td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td>
        <td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td>
    </tr>
    <tr>
        <td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td>
        <td class="casa preta"></td><td class="casa branca"></td><td class="casa preta"></td><td class="casa branca"></td>
    </tr>
</table>
<div class = "toolbar"><img src="./icons/eraser.png" alt="borracha" width="25" height="35"></div>
<script>
 const casas = document.getElementsByClassName("casa");

 function posicionaPeca(nome, cor, posicao) {
    const peca = document.createElement('img');
    peca.setAttribute('src', 'chess_assets/'+nome+'_'+cor+'.png');
    peca.setAttribute('height', 60); // 👈️ height in px
    peca.setAttribute('width', 60); // 👈️ width in px
    casas[posicao].innerHTML = "" 
    casas[posicao].appendChild(peca);

 }

 function montaTabuleiro (tabu){
    a = Array.from (tabu);
    for (var i=0;i<=63;i++){

        switch (a[i]){
            case "p":posicionaPeca ('peao'  , 'b', i);break;
            case "t":posicionaPeca ('torre' , 'b', i);break;
            case "b":posicionaPeca ('bispo' , 'b', i);break;
            case "c":posicionaPeca ('cavalo', 'b', i);break;
            case "r":posicionaPeca ('rei'   , 'b', i);break;
            case "d":posicionaPeca ('rainha', 'b', i);break;
            case "P":posicionaPeca ('peao'  , 'p', i);break;
            case "T":posicionaPeca ('torre' , 'p', i);break;
            case "B":posicionaPeca ('bispo' , 'p', i);break;
            case "C":posicionaPeca ('cavalo', 'p', i);break;
            case "R":posicionaPeca ('rei'   , 'p', i);break;
            case "D":posicionaPeca ('rainha', 'p', i);break;
            
        }

    }
 }
var movimentoJaComecou =false
var posinicial=-1

function clicktrigger (pos) {
    
    

    if(movimentoJaComecou) {
        console.log('Movendo de pos '+posinicial+ ' ate a posicao final:' + pos)
        casas[pos].innerHTML = casas[posinicial].innerHTML
        movimentoJaComecou = false
        if (pos != posinicial) {
        casas[posinicial].innerHTML = ""}
    } else {

        if (casas[pos].innerHTML == "") {

        return

        }
        console.log('Inicio do movimento da pos:' + pos)
        posinicial = pos
        movimentoJaComecou = true
    }
    /*
       se movimentoJaComecou entao
            o innerhtml da casa da posicao de agora recebe o innerhtml da casa da posicao inicial
    */


}

montaTabuleiro ("<?php echo($tabuleiro) ?>")

for (i=0;i<=63;i++){
    casas[i].setAttribute("onclick","clicktrigger (" + i + ")") 

}
/* tarefas: 
criar as funções:

montaTabuleiro 
receberá 1 parametro:
string de 64 posições com a seguinte codificação:
- a posição na string significa a casa. ou seja, 1a posição ->casas[0]; última posição->casas[63]
- espaço em branco - casa vazia
- caracter minúsculo - peça branca
- caracter maiúsculo - peça preta
- (p,P) - Peão
- (c,C) - Cavalo
- (b,B) - Bispo
- (r,R) - Rei
- (d,D) - Rainha (dama)
- (t,T) - Torre
Então a string "TCBDRBCTPPPPPPPP                                pppppppptcbdrbct" representa o tabuleiro de abertura de um jogo.


*/ 



</script>
    
</body>
</html>