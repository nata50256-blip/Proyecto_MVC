<?php
require '../vendor/autoload.php';
require_once '../config/database.php';
require_once '../models/Producto.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Dompdf\Dompdf;

class ReporteController
{
    public function reporteExcel()
    {
        $database = new Database();
        $db = $database->conectar();
        $producto = new Producto($db);
        $datos = $producto->obtenerTodos();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Descripción');
        $sheet->setCellValue('D1', 'Precio');
        $sheet->setCellValue('E1', 'Stock');

        // Fase 15: Estilos de Excel
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('4F81BD');

        foreach(range('A', 'E') as $columna)
        {
            $sheet->getColumnDimension($columna)->setAutoSize(true);
        }

        $fila = 2;
        foreach($datos as $row)
        {
            $sheet->setCellValue('A' . $fila, $row['id']);
            $sheet->setCellValue('B' . $fila, $row['nombre']);
            $sheet->setCellValue('C' . $fila, $row['descripcion']);
            $sheet->setCellValue('D' . $fila, $row['precio']);
            $sheet->setCellValue('E' . $fila, $row['stock']);
            $fila++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Reporte Productos.xlsx"');
        $writer->save('php://output');
    }

  public function reportePDF()
    {
        $database = new Database();
        $db = $database->conectar();
        $producto = new Producto($db);
        $productos = $producto->obtenerTodos();

        ob_start();
        
        // Apuntamos exactamente a la ruta que muestra tu explorador de archivos
        $rutaVista = dirname(__DIR__) . '/views/productos/reportes/productos_pdf.php';

        if (file_exists($rutaVista)) {
            include $rutaVista;
        } else {
            die("Error: No se encontró la vista en: " . $rutaVista);
        }

        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $dompdf->stream(
            "Reporte Productos.pdf",
            ["Attachment" => false]
        );
    }
}