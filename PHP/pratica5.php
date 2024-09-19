<?php

    $salario01 = 1000;
    $salario02 = 2000;

    for ($x = 0; $x < 100; $x++){
        ++$salario01;
        echo "Valor $salario01 <br>";

        if ($x==50){
            break;
        }
    }

    if ($salario01 < $salario02){
        echo "Salario 1 é menor que o salario 2, valor do salario 1 $salario01";
    }

?>