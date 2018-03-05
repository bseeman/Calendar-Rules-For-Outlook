<?php
/*
Template Name: Get a Quote Form
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

	$count_court_list = count($_POST['court_list']);
	if ($count_court_list == 0) {?>
		<script type="text/javascript">window.location.href='get-a-quote?err=1';</script>
	<?php }?>
<style>
  .inputtextfield {
     width:450px;height: 22px;
  }
  .inputtextlabel {
     width:300px;
  }
  .textfieldRequiredMsgErr{
    float: left;
  }
</style>
<form  id="quote_form" method="POST" action="procs/process_get_quote.php" class="widget">
    <h1 class="entry-title" style="float: left;">Get a Quote Form</h1>
    <div style="float: right;"><a href='get-a-quote'>Get a Quote</a></div>
    <br clear="all" />
    <fieldset class="grpBox">
    <table>
        <tr>
            <td>
                <table>
                 <tr><td>
                  <?php $court_list_array = implode(",", $_POST['court_list']);?>
                  <table cellpadding="5">
                    <tr><td valign="top" class="inputtextlabel">Name :<span style="color:red;">*</span></td><td valign="top">
                      <span id="sprytextfield1">
                        <input type="text" name="name" id="name" class="inputtextfield" placeholder="Please enter your full name">
                      <span class="textfieldRequiredMsg textfieldRequiredMsgErr">A value is required.</span></span>
                    </td></tr>
                    <tr><td valign="top" class="inputtextlabel">Email :<span style="color:red;">*</span></td><td valign="top">
                      <span id="sprytextfield2">
                      <input type="text" name="email" id="email" class="inputtextfield" placeholder="Please enter your valid email address">
                      <span class="textfieldRequiredMsg textfieldRequiredMsgErr">A value is required.</span></span>
                    </td></tr>
                    <tr><td valign="top" class="inputtextlabel">Phone :<span style="color:red;">*</span></td><td valign="top">
                     <span id="sprytextfield3">
                      <input type="text" name="phone" id="phone" style="width:240px;height: 22px;" placeholder="Please enter your phone number">
                      <span class="textfieldRequiredMsg">A value is required.</span></span>
                    </td></tr>
                    <tr><td valign="top" class="inputtextlabel">Firm Name :<span style="color:red;">*</span></td><td valign="top">
                      <span id="sprytextfield4">
                      <input type="text" name="firm_name" id="firm_name" class="inputtextfield" placeholder="Please enter firm name">
                      <span class="textfieldRequiredMsg textfieldRequiredMsgErr">A value is required.</span></span>
                    </td></tr>
                    <tr><td valign="top" class="inputtextlabel">Firm Address :</td><td valign="top"><input type="text" name="firm_address" id="firm_address" class="inputtextfield"></td></tr>
                    <tr><td valign="top" class="inputtextlabel">Firm City, State, Zip :</td><td valign="top"><input type="text" name="firm_city" id="firm_city" style="width:190px;height: 22px;" placeholder="City">&nbsp;<input type="text" name="firm_state" id="firm_state" placeholder="State" style="width:155px;height: 22px;">&nbsp;<input type="text" name="firm_zip" id="firm_zip" style="width:85px;height: 22px;" placeholder="Zip"></td></tr>
                    <tr><td valign="top" class="inputtextlabel">Current Calendaring or Case Management System, if any</td><td valign="top"><input type="text" name="current_calendar" id="current_calendar" class="inputtextfield"></td></tr>
                    <tr><td valign="top" class="inputtextlabel">Calendaring or Case Management System you are considering, if different than above :</td><td valign="top"><input type="text" name="case_management" id="case_management" class="inputtextfield"></td></tr>
                    <tr><td valign="top" class="inputtextlabel">Comments or questions :</td><td valign="top"><textarea id="comments" name="comments" style="width:450px;    height: 90px;"></textarea></td></tr>
                    <tr><td colspan="2" style="padding-left:650px;"><input type="submit" name="submit" id="submit" value="submit"></td></tr>
                    <input type="hidden" name="court_list" id="court_list" value="<?php echo $court_list_array; ?>">
                  </table>
                 </td></tr>
                 </table>
              </td>
         </tr>
    </table>
  </fieldset>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
</script>
<?php
}

genesis(); // <- everything important: make sure to include this.

?>