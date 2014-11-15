<?php
//	Secure Connection Script

include('htconfig/dbConfig.php');
include('includes/dbaccess.php');
//	END	Secure Connection Script
if ($dbSuccess) {
    include_once('includes/fn_authorise.php');

    $menuFile = '';
	$returnMsg = "Enter Student Id; ";
	
    $contentFile = '';
    $contentMsg = '';
	$userName = "";
    $loginAuthorised = filter_input(INPUT_COOKIE, 'loginAuthorised', FILTER_SANITIZE_SPECIAL_CHARS);
	
    if ($loginAuthorised) {
        $accessLevel = filter_input(INPUT_COOKIE, 'accessLevel', FILTER_SANITIZE_SPECIAL_CHARS);
        $userID = filter_input(INPUT_COOKIE, 'userID', FILTER_SANITIZE_SPECIAL_CHARS);
		$status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
		$userName = filter_input(INPUT_COOKIE, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
		$welcome = filter_input(INPUT_GET, 'welcome', FILTER_SANITIZE_SPECIAL_CHARS);
		
		if (isset($welcome) AND ($welcome == "1")) {
			$footerMsg = "Welcome " .  ucfirst($userName) ;
			}
		
	
		if (isset($status) AND ($status == "logout")) {
		    setcookie("loginAuthorised", "", time() - 7200, "/");
            header("Location: index.php");
        } else {

            //		This is where we manage CONTENT for LOGGED-IN users
            $menuFile = 'includes/tp_tcMenu.php';

            $contentCode = filter_input(INPUT_GET, 'content', FILTER_SANITIZE_SPECIAL_CHARS);

            //  DO SOMETHING depending on the $contentCode.  
            //		update code:   0905 Content management 
            switch ($contentCode) {
				case "tardy":
                    $contentFile = "includes/tardy.php";
                    break; 	
				case "listTardys":
                    $contentFile = "includes/listTardys.php";
                    break; 
				case "reportDetails":
                    $contentFile = "includes/reportDetails.php";
                    break; 
				case "tardyReport":
                    $contentFile = "includes/tardyReport.php";
                    break; 
				case "autoTardy":
                    $contentFile = "includes/autoTardy.php";
                    break; 	
				case "principalPass":
                    $contentFile = "includes/principalPass.php";
                    break;
				case "principalPassExport":
                    $contentFile = "includes/principalPassExport.php";
                    break;
				 case "tardyDetails":
                    $contentFile = "includes/tardyDetails.php";
                    break;  
                default:
                    $contentFile = "includes/autoTardy.php";
                    break;
            }
		}
        
    } else {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        if (userAuthorised($username, $password, $dbSelected)) {
            header("Location: index.php?welcome=1");

        } else {
			$returnMsg = "Please Login ";
			$footerMsg = "Please enter your User Name and Password";
            $contentFile = 'includes/tp_loginForm.php';

        }
    }
} else {
    $contentMsg = 'No database connection.';
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>North High School Tardy Cart</title>
       <link rel="stylesheet" type="text/css" href="css/reset.css" />  
      <link rel="stylesheet" type="text/css" href="css/tc.css" /> 
     
        
      <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" 
              href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.css">
              
		  <link rel="stylesheet" type="text/css" 
              href="http://code1.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
		  
		  <link rel="stylesheet" type="text/css" 			
				  href="http://cdn1.datatables.net/plug-ins/a5734b29083/integration/jqueryui/dataTables.jqueryui.css>">


        <!-- jQuery -->
				<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>




        <!-- DataTables -->
       
		 <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		 <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
       <script type="text/javascript" src="http://cdn1.datatables.net/plug-ins/a5734b29083/integration/jqueryui/dataTables.jqueryui.js"></script>
			
    </head>
    <body>
        <header>
        <h1 id="pageHeader">NHS Tardy Cart</h1>
        <h2 id="pageTitle"></h2>
        <div id="message">
            <p><span id="returnMsg"></span></p>
        </div>

    </header> 
<div id="mainContent">	
    <div class="lhs_menu">

        <ul>
            <?php
            if (file_exists($menuFile)) {
                include($menuFile);
            }
            ?>
        </ul>
    </div>
    <div id="main_area">
        <?php
        if (file_exists($contentFile)) {
            include($contentFile);
        }
        
        if (!empty($contentMsg)) {
            echo $contentMsg;
        }
        ?>
    </div><!-- end contentColumn -->
</div>


    <footer>
            <p><span id="footerMsg"></span></p>
	<!-- <p><span id="userMsg"><?php echo "Welcome " .  ucfirst($userName) ; ?></span></p> -->
    </footer><!-- end footer -->

    </body>
</html>
<script>
    $(document).ready(function() {

        document.getElementById('returnMsg').innerHTML = "<?php echo $returnMsg; ?>";

    });
</script>
<script>
    $(document).ready(function() {

        document.getElementById('footerMsg').innerHTML = "<?php echo $footerMsg; ?>";

    });
</script>
<script>
function myFunction(x) {
    x.style.background = "beige";
}
</script>

<script>
$(document).ready(function() {
    $('#list').dataTable({
    	  "scrollY":        "300px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
</script>
<script>
$(document).ready(function() {
    $('#report').dataTable(
            {"bAutoWidth": false}
        );
	 $('div.dataTables_filter input').focus();
});
</script>