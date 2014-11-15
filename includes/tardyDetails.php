<?php
include('includes/fn_insert_validations.php');
include('includes/fn_getTardyInfo.php');

$hasError = $rollBack = FALSE;
$returnMsg = "Enter Tardy Data; ";
$styleError = "background-color:red;border-color:red";
$studentId = $StudentIdErrorMsg = $StudentIdError = "";
$isTardy = "";
$reason = "";


if ($dbSuccess) {

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET["studentId"]) && strlen(clean_input($_GET["studentId"])>0)) {
			$studentId = clean_input($_GET["studentId"]);
			$studentId = format_studentId($studentId);
			
           
            $studentName = getStudentName($dbSelected, $studentId);
			$studentGrade = getStudentGrade($dbSelected, $studentId);
			$studentSchool = getStudentSchool($dbSelected, $studentId);
	        $studentYtdCount = getYtdCount($dbSelected, $studentId);
	        $studentWeeklyCount = getWeeklyCount($dbSelected, $studentId);
	        $studentLastTardy = getLastTardy($dbSelected, $studentId);
			$studentMonthlyCount = getMonthlyCount($dbSelected, $studentId);
			$footerMsg = "Press Enter or Click Tardy to register a tardy for student";
		}
    }
	
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studentId = clean_input($_POST["studentId"]);
		$isTardy = clean_input($_POST["tardy"]);
		$reason = clean_input($_POST["reason"]);
		

        $hasError = FALSE;
		if ($isTardy == "Yes") {
		    include('includes/common_tardyInsert.php');
			if (mysqli_query($dbSelected, $sql_insert)) {
			    
                //$footerMsg .= ".<br />";
				  header("Location: index.php?content=tardy&sid=$studentId");
              } else {
                   $errorMsg = "FAILED to add insert TARDY information.<br />";
                   $errorMsg .= mysqli_error($dbSelected) . "<br />";
                   $returnMsg = dataError($errorMsg);
                }
		 }
		$studentName = getStudentName($dbSelected, $studentId);
		$studentGrade = getStudentGrade($dbSelected, $studentId);
		$studentSchool = getStudentSchool($dbSelected, $studentId);
	    $studentYtdCount = getYtdCount($dbSelected, $studentId);
	    $studentWeeklyCount = getWeeklyCount($dbSelected, $studentId);
	    $studentLastTardy = getLastTardy($dbSelected, $studentId);
		$studentMonthlyCount = getMonthlyCount($dbSelected, $studentId);
    }
	
			
}
?>
<form method="post" action="index.php?content=tardyDetails" id="tardyForm">
    <div class="fieldSet">
        <fieldset>
            <legend>Student Tardy Information</legend>
            <div class="column1">
                <p>
                    <label class="field" for="studentId">Student ID</label>
                    <input type="number" name="studentId" id="studentId" class="textbox-150" 
                    		readonly="readonly" autofocus value="<?php echo $studentId; ?>"
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
            <div class="column1">
                <p>
                    <label class="field" for="tardy">Tardy</label>
                    <input type="radio" name="tardy" id="tardy" value="Yes" checked/>Yes
                    <input type="radio" name="tardy" id="tardy" value="No" />No</br>
                </p>
                <p>
                    <label class="field" for="reason">Reason</label>
                    <textarea name="reason" id="reason" form_id="tardyForm" rows=5 cols=40></textarea>

                </p>
            </div>
           
        </fieldset>
    </div>  
  
    <input type="submit" value="Tardy">
  <button type="button" onclick="location.href='index.php?content=reportDetails&studentId=<?php echo $studentId ?>'">Reporting</button> 
	<input type="reset" value="Reset">
</form>
<script>
    $("#pageTitle").text("Student Tardy");
</script>
