<?php
/* 
Template Name: sidebar-bottom
*/

//custom hooks below here...

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'custom_loop');

function custom_loop() {
	
		global $loop_counter;

	$loop_counter = 0;

	if ( have_posts() ) : while ( have_posts() ) : the_post();

	do_action( 'genesis_before_post' );
	?>
	<div <?php post_class(); ?>>

		<?php do_action( 'genesis_before_post_title' ); ?>
		<?php do_action( 'genesis_post_title' ); ?>
		<?php do_action( 'genesis_after_post_title' ); ?>

		<?php do_action( 'genesis_before_post_content' ); ?>
		<div class="entry-content">
			<?php do_action( 'genesis_post_content' ); ?>
		</div><!-- end .entry-content -->
		<?php do_action( 'genesis_after_post_content' ); ?>

	</div><!-- end .postclass -->
	<?php

	do_action( 'genesis_after_post' );
	$loop_counter++;

	endwhile; /** end of one post **/
	do_action( 'genesis_after_endwhile' );

	else : /** if no posts exist **/
	do_action( 'genesis_loop_else' );
	endif; /** end loop **/


$returnto="courts";
//echo $returnto;

	// check for login
if ($_SESSION['userid']>0) {
// echo "woo!";
}
else {
if ($_GET['e']=='99'){ ?>
<span class="loginFailed">Login failed</span><BR />
<a href="forgot-password">Forgot Username/Password? </a>
<?php }
require ('include/login_block.php');
}
//
?>
<script>
jQuery(function() {
  jQuery('#myaccount').addClass('current-menu-item');
});
</script>
	<form action="procs/process_signup.php" method="post">
      <div class="widget"><table width="100%" align="center" class="widget-wrap">             
                <tr>
                  <td>&nbsp;</td>
                  <td><input name="trialbox" type="checkbox" value="trial" />
                  &nbsp;Trial Membership</td>
                </tr>
                <tr>
                  <td valign="top"><p><strong>Username:</strong></p></td>
                         <td valign="top">
                    <span id="sprytextfield1">
                    <input name="username" id="username" autocomplete="off" type="text" size="40" />
                    <span class="textfieldRequiredMsg"><br />
                    A value is required.</span></span>                  
                  <div id="msgbox"></div>     
                    </td>
         </tr>
                <tr>
                  <td valign="top"><p><strong>Password:</strong></p></td>
                    <td valign="top">     
                    <span id="sprytextfield2">
                    <input name="password" type="password" id="password" size="40" />
                    <span class="textfieldRequiredMsg"><br />
                    A value is required.</span></span></p></td>
                </tr>

                <tr>
                  <td valign="top"><p><strong>First Name:</strong></p></td>
                         <td valign="top">
                    <span id="sprytextfield5">
                    <input name="firstname" id="firstname" autocomplete="off" type="text" size="40" />
                    <span class="textfieldRequiredMsg"><br />
                    A value is required.</span></span>                   <div id="msgbox"></div>     
                    </td>
         </tr>
                <tr>
                  <td valign="top"><p><strong>Last Name:</strong></p></td>
                    <td valign="top">     
                    <span id="sprytextfield6">
                    <input name="lastname" type="text" id="lastname" size="40" />
                    <span class="textfieldRequiredMsg"><br />
                    A value is required.</span></span></td>
                </tr>


                <tr>
                  <td valign="top"><p><strong>Email:</strong></p></td>
                <td valign="top"><?php if ($totalRows_attornys_cart > 0) { ?>
 						<?php echo $masteremail; ?>
                  <input type="hidden" name="email" id="email" value="<?php echo $masteremail; ?>" /> <?php } else { ?>
                    <span id="sprytextfield3">
                    <input name="email" type="text" id="email" size="40" />
                    <br />
                    <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>
                    <div id="msgbox2"></div>
                    </td><?php } ?></tr>
                <tr>
                  <td valign="top" nowrap="nowrap"><p><strong>Firm/Practice Name:</strong></p></td>
                  <td valign="top"><p>
                    <span id="sprytextfield4">
                    <input name="firm" type="text" id="firm" size="40" />
                    <br />
                  <span class="textfieldRequiredMsg">A value is required.</span></span></p></td>
                </tr>
                <tr>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td class="confirmbuttonstyle" ><input type="submit" name="submit" id="submit" value="Next"></td>
                </tr>
              </table>
 </div>
              <input name="stateIDs" type="hidden" value="<?php echo $stateIDs; ?>" />
              <input name="courtIDs" type="hidden" value="<?php echo $courtIDs; ?>" />
              </form>
              
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["submit"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["submit"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email", {validateOn:["submit"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["submit"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["submit"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["submit"]});

</script>

<?php



}

genesis();
?>
