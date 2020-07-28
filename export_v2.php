<?php
require_once'php/core/init.php';
$user = new User();
$override = new OverideData();

$staff = $override->getData('staff');

function exportProductDatabase($staff) {
    $timestamp = time();
    $filename = 'Export_excel_' . $timestamp . '.xls';

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    $isPrintHeader = false;
    foreach ($staff as $row) {
        if (! $isPrintHeader) {
            echo implode("\t", array_keys($row)) . "\n";
            $isPrintHeader = true;
        }
        echo implode("\t", array_values($row)) . "\n";
    }
    exit();
}

print_r(exportProductDatabase($staff));