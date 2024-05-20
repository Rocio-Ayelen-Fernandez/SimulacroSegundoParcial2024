<?php

include_once 'Moto.php';

//Para el caso de las motos importadas, se debe almacenar el país
//desde el que se importa y el importe correspondiente a los impuestos
//de importación que la empresa paga por el ingreso al país.

class Moto_Importada extends Moto
{
    private $pais; //STRING
    private $impuestos; //FLOAT

    public function __construct(
        $codigoIng,
        $costoIng,
        $anio,
        $desc,
        $porcentaje,
        $valActiva,
        $pais,
        $impuestos
    ) {
        parent::__construct(
            $codigoIng,
            $costoIng,
            $anio,
            $desc,
            $porcentaje,
            $valActiva
        );
        $this->pais = $pais;
        $this->impuestos = $impuestos;
    }

    //METODOS DE ACCESO
    public function getPais()
    {
        return $this->pais;
    }
    public function getImpuestos()
    {
        return $this->impuestos;
    }

    public function setPais($pais)
    {
        $this->pais = $pais;
    }
    public function setImpuestos($impuestos)
    {
        $this->impuestos = $impuestos;
    }

    /**
     * Al valor calculado se debe sumar el impuesto que pagó
     * la empresa por su importación.
     * @return FLOAT
     */
    public function darPrecioVenta()
    {
        $precio = parent::darPrecioVenta();

        //Para que mantenga el 0 si la moto no esta disponible para la venta
        if ($precio != 0) {
            $precio += $this->getImpuestos();
        }

        return $precio;
    }

    //STRING
    public function __toString()
    {
        $string = parent::__toString();
        $string .=
            ', Pais de origen: ' .
            $this->getPais() .
            ', Impuestos de Importacion: ' .
            $this->getImpuestos();

        return $string;
    }
}
?>
