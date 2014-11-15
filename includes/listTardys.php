<?php

$returnMsg = "Enter Student Id to search or select row to view report";

if ($dbSuccess) {
    $list_SQLselect  = "SELECT ";
    $list_SQLselect .= "stud_school as 'School', ";
    $list_SQLselect .= "stud_student_id as 'Id', ";
    $list_SQLselect .= "CONCAT(stud_fname, ' ', stud_lname) as Name, ";
    $list_SQLselect .= "DATE_FORMAT(tardy_date, '%m/%d/%Y') as Date, ";
    $list_SQLselect .= "DATE_FORMAT(tardy_date, '%h:%i %p') as Time "; 
    $list_SQLselect .= "FROM ";
    $list_SQLselect .= "tc_tardy, tc_students  ";
	$list_SQLselect .= "WHERE tardy_student_id = stud_student_id "; 
    $list_SQLselect .= "ORDER BY Date desc,Time desc";

echo "\n<table id='list' class='display' cellspacing='0' width='100%'>\n";
    include('includes/common_createTable.php');
}
?>
<script>
    $("#pageTitle").text("List");
</script>

