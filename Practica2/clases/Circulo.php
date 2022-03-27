<?php
final class Circulo {

    private $x;
    private $y;
    private $tamano;
    private $icono;
    private $color;

    public function __construct( $x, $y, $tamano = 100, $icono="", $color="#cccccc" ) {
        $this->x = $x;
        $this->y = $y;
        $this->tamano = $tamano;
        $this->icono = $icono;
        $this->color = $color;
    }

    public function imprimir() {
        echo '<div class="circulo" style="'.
        'left: '.$this->x.'px;'.
        'top: '.$this->y.'px;'.
        'width: '.$this->tamano.'px;'.
        'height: '.$this->tamano.'px;'.
        'background-color: '.$this->color.
        '"><i class="fas fa-'.$this->icono.'"></i></div>';
    }
    
}
?>