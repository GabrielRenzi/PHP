<?php

    class calculadora{
        private $operador1;
        private $operador2;
        private $valormemoria;
        private $operando;

        public function setoperador1($valor){
            $this->operador1 = $valor;
        }
        public function setoperador2($valor){
            $this->operador2 = $valor;
        }
        public function setoperando($operando){
            $this->operando = $operando;
        }
        public function soma(){
            return $this-> valormemoria1 = $this->operador1 + $this->operador2;
        }
        public function escrevaresultado(){
            return "Resultado= ". $this->valormemoria1;
        }
        public function
    }

?>