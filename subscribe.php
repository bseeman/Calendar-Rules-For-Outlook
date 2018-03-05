<?php
/* 
Template Name: subscribe
*/

//custom hooks below here...

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'custom_loop');

function custom_loop() {
	
		echo "you shouldn't be here";
}

genesis();
?>
