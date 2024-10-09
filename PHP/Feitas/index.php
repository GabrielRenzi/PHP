<?php

require_once("funcoes.php");

define("notas",array(8,9,5,7));
define("frequencia", array(0,0,1,0,1,0,0,0,1,1));

exibeMensagem("Média Notas: " . calcularMedia() . "<br>" . 
              "Status notas: " . statusNotas() . "<br>" .
              "Frequencia: " . calculaFrequencia() . "<br>" .
              "Status Frequencia: " . statusFrequencia() )

?>