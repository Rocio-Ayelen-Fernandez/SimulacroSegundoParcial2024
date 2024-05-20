<?php

class Venta
{
    private $numero;
    private $fecha;
    private $objCliente;
    private $colObjMoto;
    private $precioFinal;

    //METODO CONSTRUCTO
    public function __construct(
        $numeroVenta,
        $fechaVenta,
        $cliente,
        $motos,
        $precio
    ) {
        $this->numero = $numeroVenta;
        $this->fecha = $fechaVenta;
        $this->objCliente = $cliente;
        $this->colObjMoto = $motos;
        $this->precioFinal = $precio;
    }
    //METODOS DE ACCESO
    //GETTERS
    public function getNumero()
    {
        return $this->numero;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function getObjCliente()
    {
        return $this->objCliente;
    }
    public function getColObjMoto()
    {
        return $this->colObjMoto;
    }
    public function getPrecioFinal()
    {
        return $this->precioFinal;
    }

    //SETTERS
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    public function setObjCliente($objCliente)
    {
        $this->objCliente = $objCliente;
    }
    public function setColObjMoto($colObjMoto)
    {
        $this->colObjMoto = $colObjMoto;
    }
    public function setPrecioFinal($precioFinal)
    {
        $this->precioFinal = $precioFinal;
    }

    /**
     * Incorpora una moto ingresada por parametro a la coleccion de motos si esta disponible
     * y actualiza el precio final de la venta
     * @param OBJ $objMoto
     */
    public function incorporarMoto($objMoto)
    {
        if ($objMoto->getActiva()) {
            //AGREGAMOS LA MOTO A LA COLECCION DE MOTOS
            $nuevoArray = $this->getColObjMoto();
            $nuevoArray[count($nuevoArray)] = $objMoto;
            $this->setColObjMoto($nuevoArray);

            //ACTUALIZAMOS EL PRECIO
            $precio = $this->getPrecioFinal() + $objMoto->darPrecioVenta();
            $this->setPrecioFinal($precio);
        }
    }

    /**
     * Implementar el método retornarTotalVentaNacional() que retorna
     * la sumatoria del precio venta de cada una de las motos Nacionales
     * vinculadas a la venta
     * @return FLOAT
     */
    public function retornarTotalVentaNacional()
    {
        $precioTotal = 0;
        foreach ($this->getColObjMoto() as $moto) {
            if (is_a($moto, 'Moto_Nacional')) {
                $precioTotal += $moto->darPrecioVenta();
            }
        }
        return $precioTotal;
    }

    /**
     * Implementar el método retornarMotosImportadas() que retorna
     * una colección de motos importadas vinculadas a la venta. Si la venta
     * solo se corresponde con motos Nacionales la colección retornada debe ser vacía.
     * @return ARRAY
     */
    public function retornarMotosImportadas()
    {
        $coleccion = [];
        foreach ($this->getColObjMoto() as $moto) {
            if (is_a($moto, 'Moto_Importada')) {
                $coleccion[] = $moto;
            }
        }
        return $coleccion;
    }

    //STRING
    public function __toString()
    {
        $stringMoto = '';
        foreach ($this->getColObjMoto() as $moto) {
            $stringMoto = $stringMoto . $moto . "\n";
        }

        return 'Numero: ' .
            $this->getNumero() .
            ', Fecha: ' .
            $this->getFecha() .
            ", Cliente:\n" .
            $this->getObjCliente() .
            "\nMotos:\n" .
            $stringMoto .
            'Precio final: ' .
            $this->getPrecioFinal();
    }
}

?>
