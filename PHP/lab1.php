<?php

    try {
        $dbconn = pg_connect("host=localhost 
                             port=5432
                             dbname=lab1
                             user=postgres
                             password=1234");

        if($dbconn){
            $termobusca = $_POST['campo_primeiro_nome'];

            $result = pg_query($dbconn, "SELECT * FROM tbpessoa WHERE PESNOME ILIKE '%$termobusca%'");

            while($row = pg_fetch_assoc($result)){
                echo print_r($row);
            }
        }
    } catch (Exception $e){
        echo $e->getMessage();
    }

?>