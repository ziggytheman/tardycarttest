<?php

include('htconfig/dbConfig.php');
include('includes/dbaccess.php');
$output = "";
	$list_SQLselect = "SELECT ";
	$list_SQLselect .= "school as 'School',  ";
    $list_SQLselect .= "tc_principalPassStatus.student_id as 'Id',  ";
    $list_SQLselect .= "name as Name,  ";
	$list_SQLselect .= "grade as 'Grade',  "; 	
	$list_SQLselect .= "status as 'Status',  ";
    $list_SQLselect .= "count as 'Count' ";
	$list_SQLselect .= "from tc_principalPassStatus left outer join  ";
	$list_SQLselect .= "tc_tardybystudent on tc_principalpassstatus.student_id = tc_tardybystudent.student_id  ";
	$list_SQLselect .= "ORDER BY School desc, Id asc ";


$sql = mysqli_query($dbSelected, $list_SQLselect);
$filename = "tc_principalPass_" . date("Y-m-d H:i:s") . ".csv";

$indx = TRUE;

while ($row = mysqli_fetch_assoc($sql)) {
    if ($indx) {

        foreach ($row as $idx => $r) {
  //          $output .= '"' . strtoupper(str_replace("ass_", "", $idx)) . '",';
            $output .= '"' . $idx . '",';
        }
        $indx = FALSE;
        $output .= "\n";
    }
    foreach ($row as $idx => $r) {
       $output .='"' . $r . '",';
    } 
    $output .= "\n";
}
header('Content-type: text/csv; charset=utf-8');
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header('Content-Disposition: attachment; filename=' . $filename);
echo $output;
exit;
?> 