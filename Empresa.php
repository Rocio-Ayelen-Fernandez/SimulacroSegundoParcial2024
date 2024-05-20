<?php

include 'Venta.php';

class Empresa
{
    private $denominacion;
    private $direccion;
    private $colObjClientes;
    private $colObjMotos;
    private $colObjVentas;

    //METODO CONSTRUCTOR
    public function __construct(
        $nombre,
        $direccionIng,
        $clientes,
        $motos,
        $ventas
    ) {
        $this->denominacion = $nombre;
        $this->direccion = $direccionIng;
        $this->colObjClientes = $clientes;
        $this->colObjMotos = $motos;
        $this->colObjVentas = $ventas;
    }

    //METODOS DE ACCESO
    //GETTERS
    public function getDenominacion()
    {
        return $this->denominacion;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function getColObjClientes()
    {
        return $this->colObjClientes;
    }
    public function getColObjMotos()
    {
        return $this->colObjMotos;
    }
    public function getColObjVentas()
    {
        return $this->colObjVentas;
    }

    //SETTERS
    public function setDenominacion($denominacion)
    {
        $this->denominacion = $denominacion;
    }
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }
    public function setColObjClientes($colObjClientes)
    {
        $this->colObjClientes = $colObjClientes;
    }
    public function setColObjMotos($colObjMotos)
    {
        $this->colObjMotos = $colObjMotos;
    }
    public function setColObjVentas($colObjVentas)
    {
        $this->colObjVentas = $colObjVentas;
    }

    /**
     * Devuelve la referencia al obj moto si el codigo ingresado coincide con el codigo de alguna moto
     * en el arreglo de objetos moto
     * sino devuelve -1
     * @param STRING $codigoMoto
     * @return INT
     */
    public function retornarMoto($codigoMoto)
    {
        $encontrado = false;
        $referencia = -1;
        $i = 0;
        $cantMotos = count($this->getColObjMotos());
        while ($i < $cantMotos && $referencia == -1) {
            if ($this->getColObjMotos()[$i]->getCodigo() == $codigoMoto) {
                $referencia = $i;
            }
            $i++;
        }

        return $referencia;
    }

    /**
     * Regista una venta si el cliente no esta dado de vaja, los codigos de motos se encuentran en la lista
     * y estan disponibles a la venta
     * Devuelve el precio final de la venta, 0 si no se realizo la venta
     * @param ARRAY $colCodigosMoto
     * @param OBJ $objCliente
     * @return INT
     */
    public function registrarVenta($colCodigosMoto, $objCliente)
    {
        //CREAMOS OBJ VENTA
        //($numeroVenta, $fechaVenta, $cliente, $motos, $precio)
        $fecha =
            getdate()['mday'] .
            '/' .
            getdate()['mon'] .
            '/' .
            getdate()['year'];
        $nuevaVenta = new Venta(
            count($this->getColObjVentas()),
            $fecha,
            $objCliente,
            [],
            0
        );

        //VERIFICAMOS QUE EL CLIENTE NO ESTE DE BAJA
        if ($objCliente->getEstado() === false) {
            foreach ($colCodigosMoto as $codigo) {
                //OBTENEMOS LA REFERENCIA DEL OBJ MOTO EN EL ARREGLO(si es que esta)
                $referenciaActual = $this->retornarMoto($codigo);

                if ($referenciaActual > -1) {
                    $nuevaVenta->incorporarMoto(
                        $this->getColObjMotos()[$referenciaActual]
                    );
                }
            }
        }
        //SI SE PUDO INGRESAR MOTOS (y se actualizo el precio) SE INGRESA LA NUEVA VENTA A LA COLECCION
        if ($nuevaVenta->getPrecioFinal() != 0) {
            $nuevoArregloVentas = $this->getColObjVentas();
            $nuevoArregloVentas[count($nuevoArregloVentas)] = $nuevaVenta;

            $this->setColObjVentas($nuevoArregloVentas);
        }

        return $nuevaVenta->getPrecioFinal();
    }

    /**
     * Retorna una coleccion de ventas que verifiquen tipo y numero de documento del cliente con los parametros ingresados
     * Si no se encuentran clientes se devuelve un arreglo vacio
     * @param STRING $tipo
     * @param INT $numDoc
     * @return ARRAY
     */
    public function retornarVentasXCliente($tipo, $numDoc)
    {
        $nuevoArray = [];
        foreach ($this->getColObjVentas() as $objVenta) {
            if (
                $objVenta->getObjCliente()->getTipoDoc() == $tipo &&
                $objVenta->getObjCliente()->getNumDoc() == $numDoc
            ) {
                $nuevoArray[count($nuevoArray)] = $objVenta;
            }
        }

        return $nuevoArray;
    }

    /**
     * Implementar el método informarSumaVentasNacionales() que recorre
     * la colección de ventas realizadas por la empresa y retorna el importe
     * total de ventas Nacionales realizadas por la empresa.
     * @return FLOAT
     */
    public function informarSumaVentasNacionales()
    {
        $total = 0;
        foreach ($this->getColObjVentas() as $venta) {
            $total += $venta->retornarTotalVentaNacional();
        }
        return $total;
    }

    /**
     * Implementar el método informarVentasImportadas() que recorre la colección
     * de ventas realizadas por la empresa y retorna una colección de ventas de
     * motos importadas. Si en la venta al menos una de las motos es importada la
     * venta debe ser informada
     */
    public function informarVentasImportadas()
    {
        $coleccion = [];

        foreach ($this->getColObjVentas() as $venta) {
            if ($venta->retornarMotosImportadas() !== []) {
                $coleccion[] = $venta;
            }
        }
        return $coleccion;
    }

    //STRING

    public function __toString()
    {
        $stringClientes = '';
        $stringMotos = '';
        $stringVentas = '';

        foreach ($this->getColObjClientes() as $cliente) {
            $stringClientes = $stringClientes . $cliente . "\n";
        }
        foreach ($this->getColObjMotos() as $moto) {
            $stringMotos = $stringMotos . $moto . "\n";
        }
        foreach ($this->getColObjVentas() as $venta) {
            $stringVentas = $stringVentas . $venta . "\n";
        }

        return 'Denominacion: ' .
            $this->getDenominacion() .
            ', Direccion: ' .
            $this->getDireccion() .
            ", Clientes:\n" .
            $stringClientes .
            "Motos:\n" .
            $stringMotos .
            "Ventas:\n" .
            $stringVentas;
    }
}

?>
