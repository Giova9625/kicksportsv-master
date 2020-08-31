<?php
require('../../Helpers/report.php');
require('../../Models/marcas.php');
require('../../Models/productos.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Productos por marca');

// Se instancia el módelo Categorías para obtener los datos.
$marca = new Marcas;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataMarcas = $marca->readAllMarcas()) {
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    foreach ($dataMarcas as $rowMarca) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(176,196,222);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Times', 'B', 12);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode('Marca: '.$rowMarca['nombre']), 1, 1, 'C', 1);
        // Se instancia el módelo Productos para obtener los datos.
        $producto = new Productos;
        // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
        if ($producto->setNombre($rowMarca['id_marca'])) {
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProductos = $producto->readProductosMarca()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(135,206,250);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Times', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(140, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
                $pdf->Cell(46, 10, utf8_decode('Precio (US$)'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Times', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataProductos as $rowProducto) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(140, 10, utf8_decode($rowProducto['producto']), 1, 0);
                    $pdf->Cell(46, 10, $rowProducto['precio'], 1, 1);
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay productos para esta marca'), 1, 1);
            }
        } else {
            $pdf->Cell(0, 10, utf8_decode('Ocurrió un error en una marca'), 1, 1);
        }
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay marca para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>