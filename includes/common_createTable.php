<?php
/* This common include creates a HTML table that contains the values from a view
 * The barcode is a hyper-link to the edit function. 
 * 
 * The table that is created uses the jQuery plug in Datatable to create the 
 * tables
 */ {
    $list_SQLselect_Query = mysqli_query($dbSelected, $list_SQLselect);
    //echo "\n<table class='dataTable' id='list'>\n";
  // echo "\n<table id='list' class='display' cellspacing='0' width='100%'>\n";
    $line = "";

    $indx = TRUE;
    $rowCount = 0;
    while ($row = mysqli_fetch_assoc($list_SQLselect_Query)) {
        if ($indx) {
            //printer header row style='background-color:#6600CC'
            echo "<thead> \n   \t<tr>\n";
            foreach ($row as $idx => $r) {
				//	echo "\t\t<th style='background-color:#6600CC;color:#FFCC00;font-size:125%'>$idx</th>\n";
		echo "\t\t<th style='#6600CC; color:#6600CC;font-size:125%'>$idx</th>\n";
            }
            echo "\t</tr>\n</thead>\n<tbody>\n";
            $indx = FALSE;
        }

 			 echo "\t<tr>\n";
        foreach ($row as $idx => $r) {
				if($idx === "Id") {
					echo "\t\t<td><a href=\"index.php?content=reportDetails&studentId=$r\">$r</a></td>\n";
				}
				else{
					echo "\t\t<td>$r</td>\n";
				}

	    }
        echo "\t</tr>\n";
        $rowCount++;
    }
    echo " </tbody>\n</table>\n";
    mysqli_free_result($list_SQLselect_Query);
}
?>

