<?php
require 'PHPExcel/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Your Name")
                             ->setLastModifiedBy("Your Name")
                             ->setTitle("HackerRank Scores")
                             ->setSubject("HackerRank Scores")
                             ->setDescription("HackerRank Scores")
                             ->setKeywords("excel hackerank scores")
                             ->setCategory("HackerRank");

// Add data from POST request (assuming it contains the table data)
$data = $_POST['data'];

// Add table headers
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Name')
            ->setCellValue('B1', 'Registration Number')
            ->setCellValue('C1', 'Java Score')
            ->setCellValue('D1', 'Python Score')
            ->setCellValue('E1', 'C Score');

// Add table data
$row = 2;
foreach ($data as $student) {
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $student['name'])
                ->setCellValue('B' . $row, $student['regno'])
                ->setCellValue('C' . $row, $student['javaScore'])
                ->setCellValue('D' . $row, $student['pythonScore'])
                ->setCellValue('E' . $row, $student['cScore']);
    $row++;
}

// Set active sheet index to the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Save Excel file
$filename = 'hackerank_scores.xlsx';
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($filename);

// Return file URL
echo json_encode(['fileUrl' => $filename]);
?>
