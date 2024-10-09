<?php

function getDesconto(){
    return $_REQUEST["desconto"];
}

function getValor(){
    return $_REQUEST["valor"];
}

function calculaValorFinal(){
    return getValor() - getDesconto();
}

function exibeMensagens($mensagem){
    echo $mensagem;
}

exibeMensagem("Valor Final: " . calculaValorFinal());

exibeMensagem(var_dump($_REQUEST));

?>