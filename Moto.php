<?php

class Moto
{
    private $codigo;
    private $costo;
    private $anioFabricacion;
    private $descripcion;
    private $porcIncAnual;
    private $activa; //Contiene tipo BOOLEAN (Si la moto esta a la venta)

    //METODO CONSTRUCTOR
    public function __construct(
        $codigoIng,
        $costoIng,
        $anio,
        $desc,
        $porcentaje,
        $valActiva
    ) {
        $this->codigo = $codigoIng;
        $this->costo = $costoIng;
        $this->anioFabricacion = $anio;
        $this->descripcion = $desc;
        $this->porcIncAnual = $porcentaje;
        $this->activa = $valActiva;
    }

    //METODOS DE ACCESO
    //GETTERS
    public function getCodigo()
    {
        return $this->codigo;
    }
    public function getCosto()
    {
        return $this->costo;
    }
    public function getAnio()
    {
        return $this->anioFabricacion;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getPorcentaje()
    {
        return $this->porcIncAnual;
    }
    public function getActiva()
    {
        return $this->activa;
    }

    //SETTERS
    public function setCodigo($codigoIng)
    {
        $this->codigo = $codigoIng;
    }
    public function setCosto($costoIng)
    {
        $this->costo = $costoIng;
    }
    public function setAnio($anio)
    {
        $this->anioFabricacion = $anio;
    }
    public function setDescripcion($desc)
    {
        $this->descripcion = $desc;
    }
    public function setPorcentaje($porcentaje)
    {
        $this->porcIncAnual = $porcentaje;
    }
    public function setActiva($valActiva)
    {
        $this->activa = $valActiva;
    }

    /**
     * Devuelve el precio de la moto con respecto a su incremento anual,
     * solo si esta disponible a la venta
     * @return FLOAT
     */
    public function darPrecioVenta()
    {
        $anio = getdate()['year'] - $this->getAnio();
        $por_inc_anual = $this->getPorcentaje() / 100;
        $_venta = 0;

        if ($this->getActiva()) {
            $_venta =
                $this->getCosto() +
                $this->getCosto() * ($anio * $por_inc_anual);
        }

        return $_venta;
    }

    //STRING
    public function __toString()
    {
        $stringActiva = 'No';
        if ($this->getActiva()) {
            $stringActiva = 'Si';
        }
        return 'Codigo: ' .
            $this->getCodigo() .
            ', Costo: ' .
            $this->getCosto() .
            ', Año de Fabricacion: ' .
            $this->getAnio() .
            ", Descripcion:\n" .
            $this->getDescripcion() .
            ', Porcentaje de Incremento Anual: ' .
            $this->getPorcentaje() .
            '%, Esta Disponible: ' .
            $stringActiva;
    }
}

?>
