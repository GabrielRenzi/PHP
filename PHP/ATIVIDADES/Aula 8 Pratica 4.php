<?php

    $salario01 = 1000;
    $salario02 = 1050;

    for ($x = 0; $x < 100; $x++){
        if ($x==50){
            break;
        }
        ++$salario01;
        echo "Valor $salario01 <br>";

    }

    if ($salario01 < $salario02){
        echo "Salario 1 é menor que o salario 2, valor do salario 1: $salario01";
    }
    else{
        echo "Salario 1 é maior que o salario 2, valor do salario 1: $salario01";
    }

?>