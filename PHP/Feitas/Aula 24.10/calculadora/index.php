<?php

    require_once "calculadora.php";

    $calculadora = new calculadora();

    $calculadora->setoperador1(10);
    $calculadora->setoperador2(10);
    $calculadora->soma();

    echo $calculadora->escrevaresultado();

?>