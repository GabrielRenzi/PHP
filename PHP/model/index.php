<?php
    require_once "pessoa.php";
    require_once "contato.php";
    require_once "endereco.php";    

    /*Instanciar um objeto da classe pessoa*/
    $objetoPessoa = new \app\model\Pessoa();
    $objetoPessoa->setNome("Cleber");
    $objetoPessoa->setSobreNome("Nardelli");
    $objetoPessoa->setDataNascimento(new DateTime("1981-11-07"));
    $objetoPessoa->setTipo(1);
    $objetoPessoa->setCpfCnpj("000.000.000-00");

    $objetoPessoa->getTelefone()->setTipo(1);
    $objetoPessoa->getTelefone()->setNome("Telefone Pessoal");
    $objetoPessoa->getTelefone()->setValor("47 9111-1111");
    echo "Nome Completo: " . $objetoPessoa->getNomeCompleto() . "<br>"; 
    echo "Idade: " . $objetoPessoa->getIdade();
?>