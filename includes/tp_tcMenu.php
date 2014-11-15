<?php

/* 		INCLUDE FILE:   tp_nhiMenu.php
 *
 * 		folder:			includes/
 *
 * 		used in:        index.php
 *
 * 		version:    	0901   date: 2010-07-01
 *
 * 		purpose:		MENU for the TEMPLATE version of alpha CRM
 *
 * 	===========================================================================
 */
echo '<li id="active"><a href="#">Home</a></li>';

if (isset($accessLevel) AND $accessLevel >= 21) {
    echo '<li><a href="index.php?content=tardySweep">Tardy Sweep</a></li>';
    echo '<li><a href="index.php?content=autoTardy">Auto Tardy</a></li>';
    echo '<li><a href="index.php?content=tardy">Enter Tardy</a></li>';
    echo '<li><a href="index.php?content=tardyReport">Reports</a></li>';
    echo '<li><a href="index.php?content=listTardys">List</a></li>';
    echo '<li><a href="index.php?content=principalPass">Principal Pass</a></li>';
    echo '<li><a href="principalPassExport.php">Principal Pass Export</a></li>';
    /* echo '<li><a href="index.php?content=list">Search</a></li>'; */
    echo '<li id="active"><a href="#">File System</a></li>';
    echo '<li><a href="export.php">Export</a></li>';
}

echo '<li><a href="index.php?status=logout">Logout</a></li>';