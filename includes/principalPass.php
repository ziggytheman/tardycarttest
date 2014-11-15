<?php

$returnMsg = "Enter Student Id to search or select row to edit";

if ($dbSuccess) {
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
	
	echo "\n<table id='list' class='display' cellspacing='0' width='100%'>\n";
    include('includes/common_createTable.php');
}
?>
<script>
    $("#pageTitle").text("List");
</script>

