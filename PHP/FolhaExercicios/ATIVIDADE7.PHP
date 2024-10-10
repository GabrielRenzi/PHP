<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="ATIVIDADE7.PHP" method = 'POST'>
            <div>
                <label for="carro">Valor do Carro</label>
                <input type="number" step = "any" name="carro" id="carro">
            </div>

            <div>
                <label for="parcelas">Número de Parcelas</label>
                <select name="parcelas" id="parcelas">
                    <option value="60">60 VEZES</option>
                </select>
            </div>

            <div>
                <label for="valorp">Valor das Parcelas</label>
                <input type="number" step = "any" name="valorp" id="valorp">
            </div>
        <input id ='submit' type="submit" value="Calcular">
    </form>


        <?php

        function exibemensagem($mensagem){
            echo $mensagem;
        }

        function conta($parcelas,$valorp){
            $valortotal = $parcelas * $valorp;
            return $valortotal;
        }

        if (isset($_POST['carro'])){

        $carro = $_POST['carro']?:0;
        $parcelas = $_POST['parcelas']?:0;
        $valorp = $_POST['valorp']?:0;

        exibemensagem("<br>Valor do Carro: ".$carro.
                    "<br>Valor do Carro Parcelado: ".conta($parcelas,$valorp).
                    "<br>Juros: ".conta($parcelas,$valorp) - $carro);
       
        }
        
        ?>

</body>
</html>
