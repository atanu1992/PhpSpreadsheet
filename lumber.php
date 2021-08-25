<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php';

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\Style\Font;
 
$result = file_get_contents('http://localhost/en/search/plated/');
$results = json_decode($result);

// echo "<pre>"; print_r($results); die;
$htmlString = '<table>';
$htmlString .=  '<tr><td><b>Species / Type</b></td>';
	$htmlString .=  '<td><b>Status</b></td>';
	$htmlString .=  '<td><b>Thickness</b></td>';
	$htmlString .=  '<td><b>Width(cm)</b></td>';
	$htmlString .=  '<td><b>Length(cm)</b></td>';
	$htmlString .=  '<td><b>Volume</b></td>';
	$htmlString .=  '<td><b>Quality</b></td>';
	$htmlString .=  '<td><b>Application</b></td>';
	$htmlString .=  '<td><b>Version</b></td>';
	$htmlString .=  '<td><b>Location</b></td>';
$htmlString .=  '<td><b>Price</b></td></tr>';
foreach ($results->details as $key => $value) {	

	$htmlString .=  '<tr>';
	$htmlString .=  '<td>'.$value->vertaling.'/'.$value->content.'</td>';
	$htmlString .=  '<td>'.'A'.'</td>';
	$htmlString .=  '<td>'.$value->thickness.'</td>';
	$htmlString .=  '<td>'.$value->width.'</td>';
	$htmlString .=  '<td>'.$value->length.'</td>';
	$htmlString .=  '<td>'.$value->volume.' '.$value->metric_unit.'</td>';
	$htmlString .=  '<td>'.$value->quality_other.'</td>';
	$htmlString .=  '<td>'.$value->toepassing_name.'</td>';
	$htmlString .=  '<td>'.''.'</td>';
	$htmlString .=  '<td>'.$value->location_name.'</td>';
	$htmlString .=  '<td>'.$value->currency_name.' '.$value->price.' '.$value->price_method_name.'</td>';
	$htmlString .=  '</tr>';
}

$htmlString .= '</table>';


mysqli_close($conn);

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
$spreadsheet = $reader->loadFromString($htmlString);
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth('25');
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth('25');
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth('25');
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth('25');
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth('25');
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth('25');
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth('25');
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth('25');
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth('25');
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth('25');
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth('25');
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('lumber.xls'); 