<?php
 class rectangulo {

    private $posicion_x;
    private $posicion_y;
    private $ancho;
    private $alto;
    private $color;

    public function __construct(  $posicion_x,  $posicion_y, $ancho ,
                                    $alto,$color) {
        $this->posicion_x = $posicion_x;
        $this->posicion_y = $posicion_y;
        $this->ancho = $ancho;
        $this->alto = $alto;
        $this->color = $color;
    }

    public function imprimir() {
        echo '<div class="circulo" style="
        '.'margin-left: '.$this->posicion_x.'px;'.
        'margin-top: '.$this->posicion_y.'px;'.
        'width: '.$this->ancho.'px;'.
        'height: '.$this->alto.'px;'.
        'background-color: #'.$this->color.'"></div>';
    }
    
}
?>