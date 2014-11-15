<?php

include('htconfig/dbConfig.php');
include('includes/dbaccess.php');
$output = "";


$tc_query = "SELECT stud_student_id as 'Student ID', stud_fname as 'First Name', stud_mInitial as 'Middle Initial', stud_lname as 'Last Name', stud_grade as 'Grade', ";
$tc_query .= "stud_school as 'School', tardy_date as 'Tardy Date', tardy_reason as 'Tardy Reason', username as 'User Name' ";
$tc_query .= "FROM tc_students, tc_tardy ";
$tc_query .= "LEFT JOIN tc_user ";
$tc_query .= " on tardy_user = ID ";
$tc_query .= "WHERE stud_student_id = tardy_student_id ";
$tc_query .= "ORDER BY stud_lname ASC, tardy_date ASC ";

$sql = mysqli_query($dbSelected, $tc_query);
$filename = "tc_dump_" . date("Y-m-d H:i:s") . ".csv";

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