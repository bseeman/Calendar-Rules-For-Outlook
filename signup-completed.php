<?php
/* 
Template Name: signup completed
*/

//custom hooks below here...

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'custom_loop');

function custom_loop() {

global $docketData;

include('globals/global_courts.php');
?>

<?php include('inc_top.php'); ?>
<h1>Signup Completed</h1>

           Thank you for completing the sign up process.  You will receive an email with instructions for installing the add-in, as well as a user guide.  If you do not receive an email shortly, please check your spam folder.  
<?php


include ('include/inc_generic_mysql.php');



mysql_free_result($cart);


?>

<?php
}

genesis();
?>