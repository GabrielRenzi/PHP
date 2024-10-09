<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="ATIVIDADE8.PHP" method = 'POST'>
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

            $opcao = [
                24 => 0.015,
                36 => 0.020,
                48 => 0.025,
                60 => 0.030
            ];

            foreach ($opcao as $tempo => $taxa){
                $juros = ($moto * $taxa) * $tempo;
                $resultado[$tempo] = number_format(($juros + $moto)/$tempo,2);
            }
            return $resultado;
        }

        if (isset($_POST['moto'])){

        $moto = $_POST['moto']?:0;

        $parcelas = conta($moto);

        exibemensagem("Valor das Parcelas para Paulinho:<br>");
        foreach ($parcelas as $tempo => $valor) {
            exibemensagem("Para {$tempo} vezes: R$ {$valor}<br>");
        }

        }
        
        ?>

</body>
</html>
