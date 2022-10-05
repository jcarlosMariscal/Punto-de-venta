<?php

$html= ob_get_clean();

require_once '../../libreriapdf/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$pdf= new Dompdf();
$html = file_get_contents("http://localhost/Punto-de-venta-develop/view/imprimir_pdf/imprimir_per.php?id_personal=".$_GET['id_personal']);
$options= $pdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$pdf->setOptions($options);

$pdf->loadHtml($html);
$pdf->setPaper(array(0,0,285.61,635.15));
$pdf->render();

$pdf->stream("archivo.pdf", array("Attachment" => true));



?>
