<?php
class Cuadrado {
    private $lado;
    public function __construct($lado) {
        $this->lado = $lado;
    }
    //MI CODIGO
    
    
    public function obtenerPerimetro(){
        $result = (4*$this->lado);
        return "Perimetro = $result";
    }
    public function obetenerArea(){
        $result = pow($this->lado, 2);
        return "Area = $result";
    }
    public function obetenerLado(){
        $result = $this->lado;
        return "lado= $result";
    }
    
    public function imprimir() {
        echo '<div class="circulo" style="
        '.'width: '.$this->lado.'px;'.
        'height: '.$this->lado.'px;'.'"></div>';
    }
}

?>