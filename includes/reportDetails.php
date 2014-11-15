<?php
include('includes/fn_insert_validations.php');
include('includes/fn_getTardyInfo.php');

$hasError = $rollBack = FALSE;
$returnMsg = "Enter Student ID ";
$styleError = "background-color:red;border-color:red";
$studentId = $StudentIdErrorMsg = $StudentIdError = "";
$isTardy = "";
$reason = "";
$studentName = $studentId = $studentGrade = $studentYtdCount = $studentWeeklyCount = $studentLastTardy = $studentMonthlyCount="";

if ($dbSuccess) {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET["studentId"]) && strlen(clean_input($_GET["studentId"])>0)) {
			$studentId = clean_input($_GET["studentId"]);
			$studentId = format_studentId($studentId);
			$studentSchool = getStudentSchool($dbSelected, $studentId);
           
            $studentName = getStudentName($dbSelected, $studentId);
			$studentGrade = getStudentGrade($dbSelected, $studentId);
	        $studentYtdCount = getYtdCount($dbSelected, $studentId);
	        $studentWeeklyCount = getWeeklyCount($dbSelected, $studentId);
	        $studentLastTardy = getLastTardy($dbSelected, $studentId);
			$studentMonthlyCount = getMonthlyCount($dbSelected, $studentId);
		}
    }

}
?>
<form method="post" action="index.php?content=reportDetails" id="tardyForm">
    <div class="fieldSet">
        <fieldset>
            <legend>Student Tardy Information</legend>
            <div class="column1">
                <p>
                    <label class="field" for="studentId">Student ID</label>
                    <input type="number" name="studentId" id="studentId" class="textbox-150" 
                    		readonly="readonly" value="<?php echo $studentId; ?>"
                     style="<?php echo $StudentIdErrorMsg; ?>"/>
                </p>
            </div>
           
        </fieldset>
    </div>  
    <div class="fieldSet">
            <fieldset>
                <legend>Tardy Student Details</legend>
                <table id="checkDetails">
                    <thead>
                        <tr>
							<th class="rowHeader">School</th>
                            <th class="rowHeaderLong">Student Name</th>
							<th class="rowHeader">Grade</th>
                            <th class="rowHeader">YTD</th>
                            <th class="rowHeaderLong">Last</th>
                            <th class="rowHeader">This Week</th>
                            <th class="rowHeader">30 days</th>
                                                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr class = "row">
							<td class="rowDetail">
                               <?php echo $studentSchool; ?>
                            </td>

                            <td class="rowDetailLong">
                               <?php echo $studentName; ?>
                            </td>
                            
							<td class="rowDetail">
                               <?php echo $studentGrade; ?>
                            </td>
							
                            <td class="rowDetail">
                               <?php echo $studentYtdCount; ?>
                            </td>
                            
							<td class="rowDetailLong">
                               <?php echo $studentLastTardy; ?>
                            </td>
                            
                            <td class="rowDetail">
                               <?php echo $studentWeeklyCount; ?>
                            </td>
                            
                            <td class="rowDetail">
                               <?php echo $studentMonthlyCount; ?>
                            </td>
			         </tr>
                    </tbody>
              </table>
          </fieldset>
		  
     </div>

    <div class="fieldSet">
        <fieldset>
            <legend>Tardy Details</legend>
            <?php
             $list_SQLselect = "SELECT  ";
    $list_SQLselect .= "DATE_FORMAT(tardy_date, '%m/%d/%Y') as Date, ";
	$list_SQLselect .= "DATE_FORMAT(tardy_date,'%h:%i %p') as Time, tardy_reason as Reason ";
    $list_SQLselect .= "FROM ";
    $list_SQLselect .= "tc_tardy ";  
	$list_SQLselect .= "WHERE tardy_student_id = $studentId ";
    $list_SQLselect .= "ORDER BY Date desc";
echo "\n<table id='list' class='display' cellspacing='0' width='100%'>\n";
    include('includes/common_createTable.php');
           ?>
        </fieldset>
    </div>  
  	   <button type="button" onclick="location.href='index.php?content=tardyDetails&studentId=<?php echo $studentId ?>'">Tardy</button>
</form>
<script>
    $("#pageTitle").text("Report Details");
</script>
