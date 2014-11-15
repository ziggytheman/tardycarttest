<?php

//Does Student Exist
function doesStudentExist($dbSelected, $studentId) {
  
    $getStudent  = "SELECT stud_fname FROM tc_students ";
	$getStudent .= "WHERE stud_student_id = $studentId";
	
	 $SQLselect_Query = mysqli_query($dbSelected, $getStudent);


	 if (count(mysqli_fetch_assoc($SQLselect_Query)) > 0) 
    	return TRUE;
	 else
	 	return FALSE;	

	}

    //Get name
function getStudentName($dbSelected, $studentId) {
  
		$getStudentName  = "SELECT CONCAT(stud_fname, ' ', stud_lname) as name FROM tc_students ";
		$getStudentName .= "WHERE stud_student_id = $studentId";
		
		 $SQLselect_Query = mysqli_query($dbSelected, $getStudentName);
	
		$temp = "";
	
		if ($row = mysqli_fetch_assoc($SQLselect_Query)) {
			$temp = $row["name"];
		} else {
			$temp = '<span class="error">Student Not Found</span>';
		}
		return $temp;
	}
	
//Get YTD Tardys
function getYtdCount($dbSelected, $studentId) {
  	
		$getYtdTardys  = "SELECT COUNT(tardy_student_id) as total from tc_tardy ";
		$getYtdTardys .= "WHERE tardy_student_id = $studentId";
		
		 $SQLselect_Query = mysqli_query($dbSelected, $getYtdTardys);
	
		$temp = "";
	
		if ($row = mysqli_fetch_assoc($SQLselect_Query)) {
			$temp = $row["total"];
		} else {
			$temp = '<span class="error">Student Not Found</span>';
		}
		return $temp;
	}
	
//Get Last Tardy
function getLastTardy($dbSelected, $studentId) {
  	
	$getLastTardy  = "SELECT DATE_FORMAT(tardy_date, '%m/%d/%y  %h:%i %p') as Date from tc_tardy ";
	$getLastTardy .= "WHERE tardy_student_id = $studentId ";
	$getLastTardy .= "ORDER BY tardy_date DESC LIMIT 1";
	
		 $SQLselect_Query = mysqli_query($dbSelected, $getLastTardy);
	
		$temp = "";
	
		if ($row = mysqli_fetch_assoc($SQLselect_Query)) {
			$temp = $row["Date"];
		} else {
			$temp = '--';
		}
		return $temp;
	}

	
//Get Count of Tardy's this week
function getWeeklyCount($dbSelected, $studentId) {
  	
	$getWeekCount  = "SELECT COUNT(tardy_student_id) AS total from tc_tardy ";
	$getWeekCount .= "WHERE tardy_student_id = $studentId AND ";
	$getWeekCount .= " DATEDIFF(CURDATE(),tardy_date) <= 1 "; 
	
		 $SQLselect_Query = mysqli_query($dbSelected, $getWeekCount);
	
		$temp = "";
	
		if ($row = mysqli_fetch_assoc($SQLselect_Query)) {
			$temp = $row["total"];
		} else {
			$temp = '<span class="error">Student Not Found</span>';
		}
		return $temp;
	}
	
	// Get tardys This Month
function getMonthlyCount($dbSelected, $studentId) {
  	
	$getMonthCount  = "SELECT COUNT(tardy_student_id) AS total from tc_tardy ";
	$getMonthCount .= "WHERE tardy_student_id = $studentId AND ";
	$getMonthCount .= "DATEDIFF(CURDATE(),tardy_date)<=30 "; 
		
		 $SQLselect_Query = mysqli_query($dbSelected, $getMonthCount);
	
		$temp = "";
	
		if ($row = mysqli_fetch_assoc($SQLselect_Query)) {
			 $temp = $row["total"];
		} else {
			$temp = '<span class="error">Student Not Found</span>';
		}
		return $temp;
	}

function getStudentGrade($dbSelected, $studentId) {
  	
	$getStudent  = "SELECT stud_grade FROM tc_students ";
	$getStudent .= "WHERE stud_student_id = $studentId";
	
	 $SQLselect_Query = mysqli_query($dbSelected, $getStudent);

	 $temp = "";
	 
	 if ($row = (mysqli_fetch_assoc($SQLselect_Query))) {
    	$temp = $row["stud_grade"];
		
	 }else{
	 	$temp = "--";	
	}
	return $temp;
}

//return school student is located
function getStudentSchool($dbSelected, $studentId) {
  	
	$getStudent  = "SELECT stud_school FROM tc_students ";
	$getStudent .= "WHERE stud_student_id = $studentId";
	
	 $SQLselect_Query = mysqli_query($dbSelected, $getStudent);

	 $temp = "";
	 
	 if ($row = (mysqli_fetch_assoc($SQLselect_Query))) {
    	$temp = $row["stud_school"];
		
	 }else{
	 	$temp = "--";	
	}
	return $temp;
}

//returns if student is eligible for a PP
function isEligiblePrincipalPass($dbSelected, $studentId) {
/*	$getStudent  = "SELECT pp_attendance, pp_tardy_percent FROM tc_principalpass ";
	$getStudent .= "WHERE pp_student_id = $studentId";
	
	$SQLselect_Query = mysqli_query($dbSelected, $getStudent);
	
	if ($row = (mysqli_fetch_assoc($SQLselect_Query))) {
    	$ppAttendance = $row["pp_attendance"];
		$ppTardyPercent = $row["pp_tardy_percent"];
		
	 }else{
	 	return true;	
	}
	if($ppAttendance > 0.92 and $ppTardyPercent < 0.03) {
		return true;
		}
	else {
		return false;
		}
		*/
	$getStudent  = "SELECT pp_authorized FROM tc_principalpass ";
	$getStudent .= "WHERE pp_student_id = $studentId";
	
	$SQLselect_Query = mysqli_query($dbSelected, $getStudent);
	
	if ($row = (mysqli_fetch_assoc($SQLselect_Query))) {
    	$ppAuthorized = $row["pp_authorized"];
				
	 }else{
	 	return true;	
	}
	if($ppAuthorized === 'Y') {
		return true;
		}
	else {
		return false;
		}
}

//returns if student is in violation of tardy count
function isInViolation($dbSelected, $studentId) {
	if(getYtdCount($dbSelected, $studentId)%4 == 0) {
		return true;
		}
	else {
		return false;
		}
}
