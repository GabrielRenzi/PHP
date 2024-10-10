<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="ATIVIDADE3.PHP" method = 'POST'>
        <div>
            <label for="lado">Lado</label>
            <input type="number" step = "any" name="lado" id="lado">
        </div>

        <input id ='submit' type="submit" value="Calcular">
    </form>

    <?php
        function exibemensagem($mensagem){
            echo $mensagem;
        }

        function calcula($lado){
            $area = $lado * $lado;
            return $area;
        }

        if (isset($_POST['lado'])){

            $lado = $_POST['lado']?:0;

            exibemensagem ("A área do quadrado de lado $lado metros é ".calcula($lado)." metros quadrados.");
        }

        
    ?>

</body>
</html>

