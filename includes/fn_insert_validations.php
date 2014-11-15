<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function clean_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function format_studentId($data)
{
$temp = $data;
  if (strlen($data)== 14) {	
	$temp = substr($data,7,6);
	
  }
  return $temp;
}

function dataError($subject)
{				
        $returnText = '<span class="dataError">'.$subject.'</span>';

        return $returnText;
}

?>