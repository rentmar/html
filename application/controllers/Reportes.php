<?php

class Reportes extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('excel');
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Cliente_model');

        //Comprobar inicio de session
        if($this->session->sesion_activa ===  null){
            $this->session->sess_destroy();
            redirect('/');
        }
    }

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
        //Asumiendo que ya hayamos solicitado la libreria iniciamos la primera hoja
        $this->excel->setActiveSheetIndex(0);

        //Le colocamos el nombre a la primera hoja o pestaña
        $this->excel->getActiveSheet()->setTitle('Hola de Prueba');

        //Ingresamo el X's texto en la celda A1
        $this->excel->getActiveSheet()->setCellValue('A1', 'Este es mi gran texto...');

        //Cambiamos el tamaño de letra para la Celda A1
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);

        //Le colocamos negrilla a la Celda A1
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

        //Unimos las Celdas desde la A1 hasta la D1
        $this->excel->getActiveSheet()->mergeCells('A1:D1');

        //Alineamos en el centro las celdas
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Aca le asignamos el nombre al archivo
        $filename='Listado_de_clientes.xls';

        //Seteamos el mime
        header('Content-Type: application/vnd.ms-excel');

        //Le enviamos al navegador el nombre del archivo para su respectiva descarga
        header('Content-Disposition: attachment;filename="'.$filename.'"');

        //Le indicamos que no deje en cache nada
        header('Cache-Control: max-age=0');

        //Se genera la mágia, y se construye TODO
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        //forzamos la entrega del archivo a nuestro navegador (Descarga pes...)
        $objWriter->save('php://output');
    }
}