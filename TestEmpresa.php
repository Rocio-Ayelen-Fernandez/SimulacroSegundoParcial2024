<?php
include 'Moto_Importada.php';
include 'Moto_Nacional.php';
include 'Empresa.php';
include 'Cliente.php';

// Cree 2 instancias de la clase Cliente: $objCliente1, $objCliente2

//INSTACIAS DE OBJ CLIENTE
//($nombreIng, $apellidoIng, $estado, $tipo, $num)
$objCliente1 = new Cliente('Nahuel', 'Fernandez', true, 'DNI', 48123843);
$objCliente2 = new Cliente('Rocio', 'Fernandez', false, 'DNI', 44238322);

/**
 * Cree 4 objetos Motos con la información visualizada en las
 * siguientes tablas: código, costo, año fabricación,
 * descripción, porcentaje incremento anual, activo entre otros.
 */
//INSTANCIAS DE OBJ MOTO NACIONAL
//__construct($codigoIng,$costoIng,$anio,$desc,$porcentaje,$valActiva,$descuento)
$obMotoNacional1 = new Moto_Nacional(
    11,
    2230000,
    2022,
    'Benelli Imperiale 400',
    85,
    true,
    10
);
$obMotoNacional2 = new Moto_Nacional(
    12,
    584000,
    2021,
    'Zanella Zr 150 Ohc',
    70,
    true,
    10
);
$obMotoNacional3 = new Moto_Nacional(
    13,
    999900,
    2023,
    'Zanella Patagonian Eagle 250',
    55,
    false,
    15
);

//INSTANCIAS DE OBJ MOTO IMPORTADA
//($codigoIng, $costoIng, $anio, $desc, $porcentaje, $estado, $pais, $impuestos)
$obMotoImportada = new Moto_Importada(
    14,
    12499900,
    2020,
    'Pitbike Enduro Motocross Apollo Aiii 190cc Plr',
    100,
    true,
    'Francia',
    6244400
);

/**
 * Se crea un objeto Empresa con la siguiente información: denominación =” Alta Gama”,
 * dirección= “Av Argenetina 123”, colección de motos= [$obMoto11, $obMoto12, $obMoto13, $obMoto14] ,
 * colección de clientes = [$objCliente1, $objCliente2 ], la colección de ventas realizadas=[].
 */

//INSTACIA DE OBJ EMPRESA
//($nombre, $direccionIng, $clientes, $motos, $ventas)
$objEmpresa = new Empresa(
    'Alta Gama',
    'Av Argenetina 123',
    [$objCliente1, $objCliente2],
    [$obMotoNacional1, $obMotoNacional2, $obMotoNacional3, $obMotoImportada],
    []
);

/**
 * Invocar al método registrarVenta($colCodigosMoto, $objCliente) de la Clase Empresa
 * donde el $objCliente es una referencia a la clase Cliente almacenada en la variable
 * $objCliente2 (creada en el punto 1) y la colección de códigos de motos es la siguiente
 * [11,12,13,14]. Visualizar el resultado obtenido.
 */

echo 'Registrar Venta: Cliente 2, Coleccion 11,12,13 y 14: $' .
    $objEmpresa->registrarVenta([11, 12, 13, 14], $objCliente2) .
    "\n";

/**
 * Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa
 * donde el $objCliente es una referencia a la clase Cliente almacenada en la variable
 * $objCliente2 (creada en el punto 1) y la colección de códigos de motos es la siguiente
 * [13,14]. Visualizar el resultado obtenido.
 */

echo 'Registrar Venta: Cliente 2, Coleccion 13,14: $' .
    $objEmpresa->registrarVenta([13, 14], $objCliente2) .
    "\n";

/**
 * Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde
 *  el $objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2
 * (creada en el punto 1) y la colección de códigos de motos es la siguiente [14,2].
 * Visualizar el resultado obtenido.
 */
echo 'Registrar Venta: Cliente 2, Codigos 14,2: $' .
    $objEmpresa->registrarVenta([14, 2], $objCliente2) .
    "\n";

/**
 * Invocar al método informarVentasImportadas(). Visualizar el resultado obtenido.
 */
echo "Informar Ventas Importadas:\n";
print_r($objEmpresa->informarVentasImportadas());
echo "\n";

/**
 * Invocar al método informarSumaVentasNacionales(). Visualizar el resultado obtenido.
 */
echo 'Informar Suma Ventas Nacionales: $' .
    $objEmpresa->informarSumaVentasNacionales() .
    "\n";

/**
 * Realizar un echo de la variable Empresa creada en 2.
 */

echo "EMPRESA\n" . $objEmpresa . "\n";

?>
