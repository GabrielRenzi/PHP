<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="ATIVIDADE4.PHP" method = 'POST'>
        <div>
            <label for="ladoa">Lado A</label>
            <input type="number" step = "any" name="ladoa" id="ladoa">
        </div>

        <div>
            <label for="ladob">Lado B</label>
            <input type="number" step = "any" name="ladob" id="ladob">
        </div>

        <input id ='submit' type="submit" value="Calcular">
    </form>

    <?php
        function calcula($ladoa, $ladob){
            $area = $ladoa * $ladob;
            return $area;
        }

        function exibemensagem($mensagem){
            echo $mensagem;
        }

        if (isset($_POST['ladoa'])){
            $ladoa = $_POST['ladoa']?:0;
            $ladob = $_POST['ladob']?:0;

            if (calcula($ladoa,$ladob) > 10){
                exibemensagem("<h1>A area do retângulo de lados $ladoa e $ladob metros é ".calcula($ladoa,$ladob)." metros quadrados.</h1>");
            }
            else{
                exibemensagem("<h3>A area do retângulo de lados $ladoa e $ladob metros é ".calcula($ladoa,$ladob)." metros quadrados.</h3>");
            }
        }

       

    ?>

</body>
</html>