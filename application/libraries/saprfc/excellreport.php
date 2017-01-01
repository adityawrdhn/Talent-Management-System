

<?php include("connect.php"); ?>
<?php
if( $data_row > 0){
?>
<?php
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
 
$objPHPExcel = new PHPExcel();

$objPHPExcel->createSheet();


$objWorksheet0 = $objPHPExcel->getActiveSheet();
$objPHPExcel->setActiveSheetIndex(0);
$rowCount1 = 2; 


function replaceSpace($string)                                     // remove spaces in the incoming data set
{
   $string = preg_replace("/\s+/", " ", $string);
   $string = trim($string);
   return $string;
}
					   for ($i=1; $i<=$data_row; $i++)
                                           {
                                           $DATA = saprfc_table_read ($fce1,"DATA",$i);
$ROW = SPLIT("/",$DATA[WA]);   
$date =new DateTime($ROW[1]);              // incoming database row : ex. Time = 01.00 - Objective Function : ex. 01.00 to 01:00
$TIME = $date->format('H:i');                                      
$TOTALPRODUCTION = replaceSpace($ROW[0]);


$objPHPExcel->getActiveSheet(0)->SetCellValue('A1','Time');
$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->SetCellValue('A'.$rowCount1,$TIME); 

$objPHPExcel->getActiveSheet(0)->SetCellValue('B1','Total Production');
$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(30);
$objPHPExcel->getActiveSheet(0)->SetCellValue('B'.$rowCount1, $TOTALPRODUCTION); 

$rowCount1++; 
} 
// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('Reports');
$objPHPExcel->setActiveSheetIndex(1);
$objWorksheet1 = $objPHPExcel->getActiveSheet();
$objPHPExcel->getActiveSheet()->setTitle('Chart');

$data_row1 = $data_row+1;
$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Reports!$B$1', NULL, 1),	//	2010

);

$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Reports!$A$2:$A'.$data_row1, NULL, 4),	//	Q1 to Q4
);

$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Reports!$B$2:$B'.$data_row1, NULL, 4),

);

//	Build the dataseries
$series = new PHPExcel_Chart_DataSeries(
	PHPExcel_Chart_DataSeries::TYPE_LINECHART,		// plotType
	PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
	range(0, count($dataSeriesValues)-1),			// plotOrder
	$dataseriesLabels,								// plotLabel
	$xAxisTickValues,								// plotCategory
	$dataSeriesValues								// plotValues
);

$plotarea = new PHPExcel_Chart_PlotArea(NULL, array($series));

$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_TOPRIGHT, NULL, false);

$title = new PHPExcel_Chart_Title('Total Production Chart');
$yAxisLabel = new PHPExcel_Chart_Title('Total Production');


//	Create the chart
$chart = new PHPExcel_Chart(
	'chart1',		// name
	$title,			// title
	$legend,		// legend
	$plotarea,		// plotArea
	true,			// plotVisibleOnly
	0,				// displayBlanksAs
	NULL,			// xAxisLabel
	$yAxisLabel		// yAxisLabel
);


$chart->setTopLeftPosition('C4');
$chart->setBottomRightPosition('Q18');

//	Add the chart to the worksheet


//	Add the chart to the worksheet

$objWorksheet1->addChart($chart);

$tarih = date("d-m-Y");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReportExcell '.$tarih.'.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save('php://output');
?>
<?php
	}else{
		 echo "<script language='javascript'>alert('No DATA'); history.back();</script>"; 
	}
	?>	