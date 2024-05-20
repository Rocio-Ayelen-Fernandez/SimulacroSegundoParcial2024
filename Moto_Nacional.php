<?php

include_once 'Moto.php';
/**
 * Con el objetivo de incentivar el consumo de productos Nacionales,
 * se desea almacenar un porcentaje de descuento en las motos Nacionales que
 * será aplicado al momento de la venta (por defecto el valor del descuento es del 15%).
 */

class Moto_Nacional extends Moto
{
    private $descuento; //Porcentaje INT

    public function __construct(
        $codigoIng,
        $costoIng,
        $anio,
        $desc,
        $porcentaje,
        $valActiva,
        $descuento
    ) {
        parent::__construct(
            $codigoIng,
            $costoIng,
            $anio,
            $desc,
            $porcentaje,
            $valActiva
        );
        $this->descuento = $descuento;
    }

    //METODOS DE ACCESO
    public function getDescuento()
    {
        return $this->descuento;
    }
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    /**
     * Aplique el porcentaje de descuento
     * sobre el valor calculado inicialmente.
     * @return FLOAT
     */
    public function darPrecioVenta()
    {
        $precio = parent::darPrecioVenta();

        if ($precio != 0) {
            $descuento = $this->getDescuento() / 100;
            $precio -= $precio * $descuento;
        }

        return $precio;
    }

    //STRING
    public function __toString()
    {
        $string = parent::__toString();
        $string .= ', Descuento: ' . (int) $this->getDescuento();

        return $string;
    }
}

?>
