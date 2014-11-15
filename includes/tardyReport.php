<?php
include('includes/fn_insert_validations.php');
include('includes/fn_getTardyInfo.php');
$hasError = $rollBack = FALSE;
$returnMsg = "Enter Student ID ";
$styleError = "background-color:red;border-color:red";

$studentId = $StudentIdErrorMsg = $StudentIdError = "";

if ($dbSuccess) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studentId = clean_input($_POST["studentId"]);
		$studentId = format_studentId($studentId);

        $hasError = FALSE;
        if (empty($studentId)) {
            $studentIdError = $styleError;
            $returnMsg .= " Enter Student ID";
            $hasError = TRUE;
        }
		else {
			if (doesStudentExist($dbSelected, $studentId)) {
			   header("Location: index.php?content=reportDetails&studentId=$studentId");
            }else{
             $returnMsg .= " Student not Found";		
			 $hasError = TRUE;
			}
		}
	}
	}
?>
<form method="post" action="index.php?content=tardyReport" >
    <div class="fieldSet">
        <fieldset>

            <legend>Student Tardy Information</legend>
            <div class="column1">
                <p>
                    <label class="field" for="studentId">Student ID</label>
                    <input type="number" name="studentId" id="studentId" class="textbox-150" autofocus onfocus="myFunction(this)" value="<?php echo $studentId; ?>"
                     	   style="<?php echo $StudentIdErrorMsg; ?>"/>
                </p>
            </div>
           
        </fieldset>
        </div>
  <input type="submit" value="Submit">

</form>
<script>
    $("#pageTitle").text("Tardy Reporting");
</script>
