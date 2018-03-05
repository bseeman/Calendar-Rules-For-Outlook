<?php
/* 
Template Name: login
*/

//custom hooks below here...

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'custom_loop');

function custom_loop() {



 ?>

<?php include('/include/inc_top.php'); ?>
<h1 class="emtry-title">Login to Manage your Account</h1>
        <?php if ($_GET['e']=='99'){ ?>
        	<span class="loginFailed">Login failed</span><BR />
        	<a href="forgot-password">Forgot Username/Password? </a>
        <?php } ?>

		<?php if ($_GET['e']=='66'){ ?>
        	<span class="loginFailed">Sorry, this ID is not a valid login for this site.</span><BR />
        	<a href="forgot-password">Forgot Username/Password? </a>
        <?php } ?>
        


        <?php if ($_GET['e']=='88'){ ?>
        Your login information has been sent to <?php echo $_GET['to']; ?>.
        <?php } ?>

      	  <form id="form1" name="form1" method="post" action="/procs/process_login.php">
					<p><strong>Username</strong><br />
				<label for="usernamelog"></label>
				<span id="sprytextfielda">
				<input name="usernamelog" type="text" id="usernamelog" size="30" maxlength="50" value="<?php echo $_COOKIE['rememberme'];?>"/><br />
				<span class="textfieldRequiredMsg">A value is required.</span></span><br />
				</p>
				<p><strong>Password</strong><br />
				  <label for="passwordlog"></label>
				  <span id="sprytextfieldb">
				  <input name="passwordlog" type="password" id="passwordlog" autocomplete="off" size="30" maxlength="50" /><br />
				  <span class="textfieldRequiredMsg">A value is required.</span></span><br />
				</p>
                <p><input type="submit" name="signin" id="signin" value="Sign In"> <input type="checkbox" name="rememberme" id="rememberme" <?php if(isset($_COOKIE['rememberme'])) {
		echo 'checked="checked"';
	}
	else {
		echo '';
	}
	?>>
        Remember Me
				 <!--<p>
			 <input name="imageField" type="image" id="imageField" src="/assets/images/login_button.png" />
			</p>-->
</form>
		  <?php //print_r($_SESSION);?> 
		  <br />
			<br /><?php //print_r($_COOKIE); ?></a><br />

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfielda", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfieldb", "none", {validateOn:["blur"]});

</script>

<?php

}



genesis();
?>
