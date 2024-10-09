<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="ATIVIDADE6.PHP" method = 'POST'>
            <div>
                <label for="maca">Preço da Maçã</label>
                <input type="number" step = "any" name="maca" id="maca">
            </div>

            <div>
                <label for="macakg">KG Comprados</label>
                <input type="number" step = "any" name="macakg" id="macakg">
            </div>
        <br>
            <div>
                <label for="melancia">Preço da Melancia</label>
                <input type="number" step = "any" name="melancia" id="melancia">
            </div>

            <div>
                <label for="melanciakg">KG Comprados</label>
                <input type="number" step = "any" name="melanciakg" id="melanciakg">
            </div>
        <br>
            <div>
                <label for="laranja">Preço da Laranja</label>
                <input type="number" step = "any" name="laranja" id="laranja">
            </div>

            <div>
                <label for="laranjakg">KG Comprados</label>
                <input type="number" step = "any" name="laranjakg" id="laranjakg">
            </div>
        <br>
            <div>
                <label for="repolho">Preço da Repolho</label>
                <input type="number" step = "any" name="repolho" id="repolho">
            </div>

            <div>
                <label for="repolhokg">KG Comprados</label>
                <input type="number" step = "any" name="repolhokg" id="repolhokg">
            </div>
        <br>
            <div>
                <label for="cenoura">Preço da Cenoura</label>
                <input type="number" step = "any" name="cenoura" id="cenoura">
            </div>

            <div>
                <label for="cenourakg">KG Comprados</label>
                <input type="number" step = "any" name="cenourakg" id="cenourakg">
            </div>
        <br>
            <div>
                <label for="batatinha">Preço da Batatinha</label>
                <input type="number" step = "any" name="batatinha" id="batatinha">
            </div>

            <div>
                <label for="batatinhakg">KG Comprados</label>
                <input type="number" step = "any" name="batatinhakg" id="batatinhakg">
            </div>
        <br>
        <input id ='submit' type="submit" value="Calcular">
    </form>


        <?php

        function exibemensagem($mensagem){
            echo $mensagem;
        }

        function conta($precos, $valorTotal, $quantidades){
            foreach ($precos as $produto => $preco) {
                $valorTotal += $preco * $quantidades[$produto];
            }        
            return $valorTotal;
        }

        if (isset($_POST['maca'])){
        $dinheiro = 50.00;

        $precos = [
            "maçã" => $_POST['maca']?:0,    
            "melancia" => $_POST['melancia']?:0, 
            "laranja" => $_POST['laranja']?:0,  
            "repolho" => $_POST['repolho']?:0,  
            "cenoura" => $_POST['cenoura']?:0,  
            "batatinha" => $_POST['batatinha']?:0  
        ];

        $quantidades = [
            "maçã" => $_POST['macakg']?:0,    
            "melancia" => $_POST['melanciakg']?:0,  
            "laranja" => $_POST['laranjakg']?:0, 
            "repolho" => $_POST['repolhokg']?:0, 
            "cenoura" => $_POST['cenourakg']?:0,  
            "batatinha" => $_POST['batatinhakg']?:0  
        ];

        $valorTotal = 0;

        if (conta($precos,$valorTotal,$quantidades) < $dinheiro) {
            $sobrando = $dinheiro - conta($precos,$valorTotal,$quantidades);
            exibemensagem("<span style='color: blue;'>Joãozinho ainda pode gastar R$ $sobrando.</span>");
        } elseif (conta($precos,$valorTotal,$quantidades) > $dinheiro) {
            $faltando = conta($precos,$valorTotal,$quantidades) - $dinheiro;
            exibemensagem("<span style='color: red;'>Faltam R$ $faltando para pagar a conta.</span>");
        } else {
            exibemensagem("<span style='color: green;'>O saldo para compras foi esgotado.</span>");
        }

        exibemensagem("<br>A compra total foi de R$ ".conta($precos,$valorTotal,$quantidades));
        }
        
        ?>

</body>
</html>
