<?php
/*
Template Name: Demo Request Completed
 */

//custom hooks below here...

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'custom_loop');

function custom_loop() {

	require_once 'Connections/docketData.php';
	include 'globals/global_courts.php';
	global $docketData;

	if (!function_exists("GetSQLValueString")) {
		function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
			if (PHP_VERSION < 6) {
				$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
			}

			$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

			switch ($theType) {
			case "text":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
				break;
			case "long":
			case "int":
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
				break;
			case "double":
				$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
				break;
			case "date":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
				break;
			case "defined":
				$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
				break;
			}
			return $theValue;
		}
	}

?>    <h1 class="entry-title" style="float: left;">Request a Demo Form</h1>
    <div style="float: left;">
Thank you for your interest in Calendar Rules for Outlook! Someone will contact you shortly to schedule a demonstration.
</div>
<?php 
}

genesis(); // <- everything important: make sure to include this.

?>