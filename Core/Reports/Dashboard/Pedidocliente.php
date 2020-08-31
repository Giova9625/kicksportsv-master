<?php
require('../../Helpers/report.php');
require('../../Models/pedidos.php');


// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Pedidos por cliente');

        $pedido = new Pedidos;
        
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataPedidos = $pedido->readPedidoCliente()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(135,206,250);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Times', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(95, 12, utf8_decode('Apodo del cliente'), 1, 0, 'C', 1);
                $pdf->Cell(95, 12, utf8_decode('Numero de pedidos'), 1, 1, 'C', 1);
                
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Times', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataPedidos as $rowPedido) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(95, 12, utf8_decode($rowPedido['apodo']), 1, 0);
                    $pdf->Cell(95, 12, utf8_decode($rowPedido['pedidos']), 1, 1);
                    
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay administradores '), 1, 1);
            }
        


// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>