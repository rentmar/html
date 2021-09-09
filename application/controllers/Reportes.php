<?php


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Reportes extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        //$this->load->library('excel');
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->model('Cliente_model');
        $this->load->model('Factura_model');

        //Comprobar inicio de session
        if($this->session->sesion_activa ===  null){
            $this->session->sess_destroy();
            redirect('/');
        }
    }

    //Funcion por defecto
    public function index(){

        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('reportes/vreporte_index.php');

        /**** PIE ****/
        $this->load->view('html/pie.php');


    }

    //Ejemplo de uso de la libreria PHPExcel
    public function generarReporte()
    {
        $facturas = $this->Factura_model->leerFacturas();
        $filename = "facturas.xlsx";
        $ruta = 'assets/';
        $plantilla = $ruta.'reporte-plantilla.xlsx';

        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet‌​ml.sheet");
        header('Content-Disposition: attachment; filename="' . $filename. '"');
        header('Cache-Control: max-age=0');
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($plantilla);
        $sheet = $spreadsheet->getSheet(0)->setTitle('Facturas');

        $worksheet = $spreadsheet->getActiveSheet();
        $eje_y = 6;

        foreach ($facturas as $f):
            $sheet->setCellValue('A'.$eje_y, $f->idfactura);
            $sheet->setCellValue('B'.$eje_y, mdate('%m-%d-%Y', $f->fecha_facturacion));
            $sheet->setCellValue('C'.$eje_y, $f->numero_factura);
            $sheet->setCellValue('D'.$eje_y, $f->numero_autorizacion);
            $sheet->setCellValue('E'.$eje_y, $f->estado);
            $sheet->setCellValue('F'.$eje_y, $f->cod_control);
            $sheet->setCellValue('G'.$eje_y, mdate('%m-%d-%Y', $f->fecha_limite_emision) );
            $sheet->setCellValue('H'.$eje_y, $f->llave_dosificacion );
            $sheet->setCellValue('I'.$eje_y, $f->codigo_qr );
            $eje_y++;
        endforeach;


        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save("php://output");


       /* $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);

        $filename = 'name-of-the-generated-file';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output'); // download file*/




    }
}
