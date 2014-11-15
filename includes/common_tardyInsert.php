<?php
	$userId =  filter_input(INPUT_COOKIE, 'userID', FILTER_SANITIZE_SPECIAL_CHARS);
	$sql_insert = "";
	$tardyDate = date('Y-m-d');	
	$tardyTime = date("H:i:s");

	$sql_insert = "INSERT INTO tc_tardy (";
	$sql_insert .= "tardy_student_id, ";
	$sql_insert .= "tardy_date, ";
	$sql_insert .= "tardy_reason, ";
	$sql_insert .= "tardy_user";
	$sql_insert .= ") ";
	$sql_insert .= "VALUES (";
    $sql_insert .= "'" . $studentId . "', ";
    $sql_insert .= "'" . $tardyDate . " " . $tardyTime . "', ";
    $sql_insert .= "'" . $reason . "', ";
	$sql_insert .= "'" . $userId . "' ";
    $sql_insert .= ") ";
?>