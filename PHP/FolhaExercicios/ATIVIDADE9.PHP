<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="ATIVIDADE9.PHP" method = 'POST'>
            <div>
                <label for="moto">Valor da moto</label>
                <input type="number" step = "any" name="moto" id="moto">
            </div>

            
        <input id ='submit' type="submit" value="Calcular">
    </form>


        <?php

        function exibemensagem($mensagem){
            echo $mensagem;
        }

        function conta($moto){
            
            $opcoes = [
                24 => 0.02,
                36 => 0.023,
                48 => 0.026,
                60 => 0.029
            ];
            
            foreach ($opcoes as $tempo => $taxa) {
                $montante = $moto * pow((1 + $taxa), $tempo);
                $parcela = $montante / $tempo;
                $resultados[$tempo] = round($parcela, 2);
             }

            return $resultados;
         }

        if (isset($_POST['moto'])){

        $moto = $_POST['moto']?:0;

        $parcelas = conta($moto);

        exibemensagem("Valor das Parcelas para Juquinha:<br>");
        foreach ($parcelas as $tempo => $valor) {
            exibemensagem("Para {$tempo} vezes: R$ {$valor}<br>");
        }
        

        }
        
        ?>

</body>
</html>
