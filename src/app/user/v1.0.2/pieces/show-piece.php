<?php
// check if Get request dirId is numeric and get the integer value
$dirId = isset($_GET['dirId']) && is_numeric($_GET['dirId']) ? intval($_GET['dirId']) : -1;
// check if Get request srcId is numeric and get the integer value
$srcId = isset($_GET['srcId']) && is_numeric($_GET['srcId']) ? intval($_GET['srcId']) : -1;
// check the direction and source id
if ($dirId != -1 && $srcId != -1) {
    // get source info
    $srcRows = selectSpecificColumn('`piece_ip`, `piece_name`', '`pieces`', 'WHERE `piece_id` = ' . $srcId);
    // get direction info
    $dirRows = selectSpecificColumn('`direction_name`', '`direction`', 'WHERE `direction_id` = ' . $dirId);
    // piece name
    $pieceName = $srcRows[0]['piece_name'];
    // piece ip
    $pieceIp = $srcRows[0]['piece_ip'];
    // direction name
    $dirName = $dirRows[0]['direction_name'];
    // include data table module
    include_once 'includes/data-table.php';
} else {
    // include data error
    include_once 'global-modules/data-error.php';
}
?>