<?php

    /*
    1. Cree 2 instancias de la clase Cliente: $objCliente1, $objCliente2.
2. Cree 3 objetos Motos con la información visualizada en la tabla: código, costo, año fabricación,
descripción, porcentaje incremento anual, activo.
    4. Se crea un objeto Empresa con la siguiente información: denominación =” Alta Gama”, dirección= “Av
Argenetina 123”, colección de motos= [$obMoto1, $obMoto2, $obMoto3] , colección de clientes =
[$objCliente1, $objCliente2 ], la colección de ventas realizadas=[].
5. Invocar al método registrarVenta($colCodigosMoto, $objCliente) de la Clase Empresa donde el
$objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
punto 1) y la colección de códigos de motos es la siguiente [11,12,13]. Visualizar el resultado obtenido.
6. Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el
$objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
punto 1) y la colección de códigos de motos es la siguiente [0]. Visualizar el resultado obtenido.
7. Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el
$objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
punto 1) y la colección de códigos de motos es la siguiente [2]. Visualizar el resultado obtenido.

8. Invocar al método retornarVentasXCliente($tipo,$numDoc) donde el tipo y número de documento se
corresponden con el tipo y número de documento del $objCliente1.
9. Invocar al método retornarVentasXCliente($tipo,$numDoc) donde el tipo y número de documento se
corresponden con el tipo y número de documento del $objCliente2
10. Realizar un echo de la variable Empresa creada en 2

    */

    include 'Cliente.php';
    include 'Empresa.php';
    include 'Moto.php';


    //INSTACIAS DE OBJ CLIENTE
    //($nombreIng, $apellidoIng, $estado, $tipo, $num)
    $objCliente1 = new Cliente("Nahuel", "Fernandez", true, "DNI", 48123843);
    $objCliente2 = new Cliente("Rocio", "Fernandez", false, "DNI", 44238322);

    //INSTANCIAS DE OBJ MOTO
    //($codigoIng, $costoIng, $anio, $desc, $porcentaje, $estado)
    $obMoto1 = new Moto(11, 2230000, 2022, "Benelli Imperiale 400", 85, true);
    $obMoto2 = new Moto(12, 584000, 2021, "Zanella Zr 150 Ohc", 70, true);
    $obMoto3 = new Moto(13, 999900, 2023, "Zanella Patagonian Eagle 250", 55, false);  

    //INSTACIA DE OBJ EMPRESA
    //($nombre, $direccionIng, $clientes, $motos, $ventas)
    $objEmpresa = new Empresa("Alta Gama", "Av Argenetina 123",[$objCliente1, $objCliente2 ],[$obMoto1, $obMoto2, $obMoto3], []);


    echo "Registrar Venta: Cliente 2, Codigos 11, 12, 13\n".$objEmpresa->registrarVenta([11,12,13], $objCliente2)."\n";

    echo "Registrar Venta: Cliente 2, Codigo 0 \n".$objEmpresa->registrarVenta([0], $objCliente2)."\n";

    echo "Registrar Venta: Cliente 2, Codigos 2\n".$objEmpresa->registrarVenta([2], $objCliente2)."\n";

    echo "Ventas por cliente\n";
    echo "Cliente 1:\n";
    print_r($objEmpresa->retornarVentasXCliente("DNI",48123843));
    echo "Cliente 2:\n";
    print_r($objEmpresa->retornarVentasXCliente("DNI",44238322));

    echo $objEmpresa."\n";
?>

