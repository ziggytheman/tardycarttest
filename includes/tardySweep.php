<?php
include('includes/fn_insert_validations.php');
include('includes/fn_getTardyInfo.php');
$hasError = $rollBack = FALSE;
$tardySweep = false;
$returnMsg = "Enter Student ID";

$styleError = "background-color:red;border-color:red";

$studentId = $StudentIdErrorMsg = $StudentIdError = "";

if ($dbSuccess) {

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $sId = filter_input(INPUT_GET, 'sid', FILTER_SANITIZE_SPECIAL_CHARS);
        if (ISSET($sId)) {
            $studentName = getStudentName($dbSelected, $sId);
            $footerMsg = "Tardy for " . $studentName . " " . $sId . " was inserted ";
            $tardySweep = true;
            include('includes/principalPassViolation.php');
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $studentId = clean_input($_POST["studentId"]);
        $studentId = format_studentId($studentId);
        $reason = "Tardy Sweep";

        $hasError = FALSE;
        if (empty($studentId)) {
            $studentIdError = $styleError;
            $returnMsg = " Enter Student ID";
            $studentIdError .= " Enter Student ID";
            $hasError = TRUE;
        } else {
            if (doesStudentExist($dbSelected, $studentId)) {
                include('includes/common_tardyInsert.php');
                if (mysqli_query($dbSelected, $sql_insert)) {
                    header("Location: index.php?content=tardySweep&sid=$studentId");
                } else {
                    $errorMsg = "FAILED to add insert TARDY information.<br />";
                    $errorMsg .= mysqli_error($dbSelected) . "<br />";
                    $returnMsg = dataError($errorMsg);
                }
            } else {
                $returnMsg .= " Student not Found";
                $studentIdError = $styleError;
                $studentIdError .= " Enter Student ID";
                $hasError = TRUE;
            }
        }
    }
}
?>
<form method="post" action="index.php?content=tardySweep" >
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
    <input type="submit" value="Submit Tardy">
    <input type="reset" value="Cancel">
</form>

<script>
    $("#pageTitle").text("Tardy Sweep");
</script>


