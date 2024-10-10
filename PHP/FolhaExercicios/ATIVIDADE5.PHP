<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="ATIVIDADE5.PHP" method = 'POST'>
        <div>
            <label for="base">Base</label>
            <input type="number" step = "any" name="base" id="base">
        </div>

        <div>
            <label for="altura">Altura</label>
            <input type="number" step = "any" name="altura" id="altura">
        </div>

        <input id ='submit' type="submit" value="Calcular">
    </form>

        <?php

        function calcula($base, $altura){
            $resultado = ($base * $altura)/2;
            return $resultado;
        }

        function exibemensagem($mensagem){
            echo $mensagem;
        }

        if (isset($_POST['base'])){
            $base = $_POST['base']?:0;
            $altura = $_POST['altura']?:0;

            exibemensagem ("Base $base, Altura $altura. Area: ".calcula($base, $altura));
        }
        ?>

</body>
</html>