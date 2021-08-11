<?php 
//--------------------------------------------- datos empresa
$emp=strtoupper($empresa->nombre_empresa);
$rs=$empresa->razon_social;
$dir=$empresa->direccion;
$tel=$empresa->telefono;
$cel=$empresa->celular;
$nitemp=$empresa->nit;
$actividad=$empresa->actividad;
$nomfactura='factura '.$factura->numero_factura;
ob_end_clean();
//---------------------------------------------- configuracion de documento
//----------- tamaño pagina
$anchopag=210;
$altopag=300;
//----------- margenes
$margen=3;
$margenarriba=5;
//---------------------- campos detalle
$campo_descrip=floor($anchopag*0.50);
$campos_det=floor($anchopag*0.15);
//---------------------- tamños
$bordecab=1; // brode cabecera detalle
$borde = 0; //1 con borde 0 sin borde
$tamtxtnormal=10;
$tamtxtdetalle=8;
$tamtxtpie=9;
$altura=3;
//$altocel=3;
/*$sizetexto=6;
$anchocel=42;
$linea=$anchocel/2;*/
$medidas = array($anchopag, $altopag);
$pdf = new TCPDF('P','mm',$medidas,true,'UTF-8',false);
//------------------------------------------------- metadatos
$pdf->SetTitle('Factura');
$pdf->SetAuthor('ARO');
//-------------------------------------------------configuracion pagina
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

$pdf->SetMargins($margen,$margenarriba,$margen,true);
$pdf->SetAutoPageBreak(TRUE,0);
//-------------------------------------------------- armado de pagina
$pdf->AddPage();

//-----------------------------------------cabeza
$pdf->SetFont('times', '', $tamtxtnormal);
$pdf->Write($altura, $emp,'',0,'C',true);
$pdf->Write($altura, $rs,'',0,'C',true);
$pdf->Write($altura, $dir,'',0,'C',true);
$pdf->Write($altura, $tel,'',0,'C',true);
$pdf->Write($altura, $cel,'',0,'C',true);
$pdf->Write($altura, 'Zona Sur','',0,'C',true);
$pdf->Write($altura, 'La Paz-Bolivia','',0,'C',true);
$pdf->Write($altura, 'FACTURA','',0,'C',true);
$pdf->Write($altura, '--------------------------------------------------','',0,'C',true,0);
$pdf->Write($altura, 'NIT:'.$nitemp,'',0,'C',true);
$pdf->Write($altura, 'FACTURA Nro.: '.$factura->numero_factura,'',0,'C',true);
$pdf->Write($altura, 'AUTORIZACION Nro.: '.$factura->numero_autorizacion,'',0,'C',true);
$pdf->Write($altura, '--------------------------------------------------','',0,'C',true,0);
$pdf->Write($altura, 'ACTIVIDAD ECONOMICA','',0,'C',true);
$pdf->Write($altura, $actividad,'',0,'C',true);
$pdf->Write($altura, 'FECHA: '.mdate('%M  %d, %Y',$registro_venta->fecha),'',0,'C',true);
$pdf->Write($altura, 'NOMBRE: '.$registro_venta->razon_social,'',0,'C',true);
$pdf->Write($altura, 'NIT: '.$registro_venta->nit,'',0,'C',true);
$pdf->Write($altura, '---------------------------------------------------','',0,'C',true,0);

//-----------------------------------------detalle
$pdf->Cell($campo_descrip, 0, 'DESCRIPCION', $bordecab, 0, 'L', 0, '', 1);
$pdf->Cell($campos_det, 0, 'CANT', $bordecab, 0, 'L', 0, '', 1);
$pdf->Cell($campos_det, 0, 'PRECIO/U', $bordecab, 0, 'L', 0, '', 1);
$pdf->Cell($campos_det, 0, 'IMPORTE', $bordecab, 1, 'R', 0, '', 1);
$pdf->Ln($altura);
$pdf->SetFont('times', '', $tamtxtdetalle);
foreach ($detalle_venta as $v) {
    $incremento_item = ($v->precio)*($v->incremento/100);
    $descuento_item = ($v->precio)*($v->descuento_producto/100);
    $precio_unitario = ($v->precio + $incremento_item) - $descuento_item;

    $pdf->Cell($campo_descrip, 0, $v->item.' '.$v->dimension, $borde, 0, 'L', 0, '', 1);
    $pdf->Cell($campos_det, 0, $v->cantidad_producto, $borde, 0, 'L', 0, '', 1);
    $pdf->Cell($campos_det, 0, number_format($precio_unitario, 2, ',', ''), $borde, 0, 'L', 0, '', 1);
    $pdf->Cell($campos_det, 0, number_format($v->total_producto, 2, ',', ''), $borde, 1, 'R', 0, '', 1);
}
$pdf->Ln($altura);
$pdf->SetFont('times', '', $tamtxtnormal);
$pdf->Write($altura, 'SON:'.$literal.' '.$centavos.'/100 Bolivianos','',0,'C',true);
$pdf->Write($altura, '--------------------------------------------------','',0,'C',true,0);

//-------------------------------------------------- datos factura
$pdf->Write($altura, 'Codigo de Control: '.$factura->cod_control,'',0,'C',true);
$pdf->Write($altura, 'Fecha Limite de Emision: '.mdate('%d/%m/%Y', $factura->fecha_limite_emision),'',0,'C',true);
$style = array(
    'border' => 0,
    'padding' => 'auto',
);
$pdf->write2DBarcode($factura->codigo_qr, 'QRCODE,M', $anchopag/2-12, '', 25, 25, $style, 'M');
$pdf->Ln($altura);

//----------------------------------------------------- pie
$pdf->Ln($altura);
$pdf->Ln($altura);
$pdf->Ln($altura);
$pdf->SetFont('times', '', $tamtxtpie);
$pdf->MultiCell($anchopag-10, 0, $datos_facturacion->pie, 0, 'L', false, 1, '', '', true);
$pdf->Ln($altura);
$pdf->MultiCell($anchopag-10, 0, $datos_facturacion->pie_ley453, 0, 'L', false, 1, '', '', true);
$pdf->OutPut($nomfactura.'.pdf');