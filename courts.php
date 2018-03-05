<?php
/* 
Template Name: courts
*/

//custom hooks below here...

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'custom_loop');

function custom_loop() {
include('Connections/docketData.php');
global $docketData;

$state_list = array (''=>"US",'United States'=>"US",'Alabama'=>"AL", 'Alaska'=>"AK", 'Arizona'=>"AZ", 'Arkansas'=>"AR", 'California'=>"CA", 'Colorado'=>"CO", 'Connecticut'=>"CT", 'Delaware'=>"DE", 'District Of Columbia'=>"DC", 'Florida'=>"FL", 'Georgia'=>"GA", 'Hawaii'=>"HI", 'Idaho'=>"ID", 'Illinois'=>"IL", 'Indiana'=>"IN", 'Iowa'=>"IA", 'Kansas'=>"KS", 'Kentucky'=>"KY", 'Louisiana'=>"LA", 'Maine'=>"ME", 'Maryland'=>"MD", 'Massachusetts'=>"MA", 'Michigan'=>"MI", 'Minnesota'=>"MN", 'Mississippi'=>"MS", 'Missouri'=>"MO", 'Montana'=>"MT", 'Nebraska'=>"NE", 'Nevada'=>"NV", 'New Hampshire'=>"NH", 'New Jersey'=>"NJ", 'New Mexico'=>"NM", 'New York'=>"NY", 'North Carolina'=>"NC", 'North Dakota'=>"ND", 'Ohio'=>"OH", 'Oklahoma'=>"OK", 'Oregon'=>"OR", 'Pennsylvania'=>"PA", 'Rhode Island'=>"RI", 'South Carolina'=>"SC", 'South Dakota'=>"SD", 'Tennessee'=>"TN", 'Texas'=>"TX", 'Utah'=>"UT", 'Vermont'=>"VT", 'Virginia'=>"VA", 'Washington'=>"WA", 'West Virginia'=>"WV", 'Wisconsin'=>"WI", 'Wyoming'=>"WY");

require('globals/global_courts.php');

	mysql_select_db($database_docketData, $docketData);
	$query_cartStateSub = sprintf("SELECT DISTINCT
	cart.id,
	cart.sessionid,
	cart.systemid,
	cart.courttype,
	courts.courtSystem_Description,
	court_pricing.Price
	FROM
	cart
	Inner Join courts ON cart.systemid = courts.courtSystem_SystemID
	Inner Join court_pricing ON courts.courtSystem_Description = court_pricing.State
	WHERE cart.subscribed =  '". $_SESSION['userid'] ."' AND cart.courttype = 'state'");
	$cartStateSub = mysql_query($query_cartStateSub, $docketData) or die(mysql_error());
	$row_cartStateSub = mysql_fetch_assoc($cartStateSub);
	$totalRows_cartStateSub = mysql_num_rows($cartStateSub);
//echo $totalRows_cartStateSub;
//print_r($_SESSION);
	
	mysql_select_db($database_docketData, $docketData);
	$query_cartSub = sprintf("SELECT cart.id, cart.sessionid, cart.systemid, cart.courttype, courts.courtid, courts.code, courts.courtSystem_Description, courts.courtSystem_SystemID, courts.courtSystem_Code, courts.description, courts.price, courts.systemID, courts.type_Description, courts.type_SystemID FROM cart Inner Join courts ON cart.systemid = courts.systemID WHERE cart.sessionid = '". $_SESSION['sessionID']."' AND cart.subscribed =  '". $_SESSION['userid'] ."' AND cart.courttype <> 'state'");

	$cartSub = mysql_query($query_cartSub, $docketData) or die(mysql_error());
	$row_cartSub = mysql_fetch_assoc($cartSub);
	$totalRows_cartSub = mysql_num_rows($cartSub);

mysql_select_db($database_docketData, $docketData);
$query_cartState = sprintf("SELECT DISTINCT
cart.id,
cart.sessionid,
cart.systemid,
cart.courttype,
courts.courtSystem_Description,
court_pricing.Price
FROM
cart
Inner Join courts ON cart.systemid = courts.courtSystem_SystemID
Inner Join court_pricing ON courts.courtSystem_Description = court_pricing.State
WHERE cart.subscribed = '0' AND cart.courttype = 'state' and cart.sessionid = %s", GetSQLValueString(session_id(), "text"));
$cartState = mysql_query($query_cartState, $docketData) or die(mysql_error());
$row_cartState = mysql_fetch_assoc($cartState);
$totalRows_cartState = mysql_num_rows($cartState);

mysql_select_db($database_docketData, $docketData);
$query_cart = sprintf("SELECT cart.id, cart.sessionid, cart.systemid, cart.courttype, courts.courtid, courts.code, courts.courtSystem_Description, courts.courtSystem_SystemID, courts.courtSystem_Code, courts.description, courts.price, courts.systemID, courts.type_Description, courts.type_SystemID FROM cart Inner Join courts ON cart.systemid = courts.systemID WHERE  cart.subscribed = 0 AND cart.courttype <> 'state' and cart.sessionid = %s", GetSQLValueString($_SESSION['sessionID'], "text"));

//echo $query_cart;

$cart = mysql_query($query_cart, $docketData) or die(mysql_error());
$cart2 = mysql_query($query_cart, $docketData) or die(mysql_error());
$row_cart = mysql_fetch_assoc($cart);
$row_cart2 = mysql_fetch_assoc($cart2);
$totalRows_cart = mysql_num_rows($cart);
$totalRows_cart2 = mysql_num_rows($cart2);

//print_r($_SESSION);

mysql_select_db($database_docketData, $docketData);
	$query_cartStateSub = sprintf("SELECT DISTINCT
	cart.id,
	cart.sessionid,
	cart.systemid,
	cart.courttype,
	courts.courtSystem_Description,
	court_pricing.Price
	FROM
	cart
	Inner Join courts ON cart.systemid = courts.courtSystem_SystemID
	Inner Join court_pricing ON courts.courtSystem_Description = court_pricing.State
	WHERE cart.subscribed =  '". $_SESSION['userid'] ."' AND cart.courttype = 'state'");
	$cartStateSub = mysql_query($query_cartStateSub, $docketData) or die(mysql_error());
	$row_cartStateSub = mysql_fetch_assoc($cartStateSub);
	$totalRows_cartStateSub = mysql_num_rows($cartStateSub);
	
mysql_select_db($database_docketData, $docketData);
	$query_SubbedCourts = sprintf("SELECT 
	systemid, id
	FROM cart
	WHERE subscribed =  '". $_SESSION['userid']."'");
	$SubbedCourts = mysql_query($query_SubbedCourts, $docketData) or die(mysql_error());
	$row_SubbedCourt = mysql_fetch_assoc($SubbedCourts);
	$subbedCourtList=array();
	do {
		
		
	} while ($row_SubbedCourt = mysql_fetch_assoc($SubbedCourts));
echo"<pre>";
//	print_r($subbedCourtList);
echo"</pre>";
?>
<script>
jQuery(function() {
  jQuery('#myaccount').addClass('current-menu-item');
});
</script>

				  		  	               <?php //print_r($_COOKIE); ?>
<h1>Manage your Subscription</h1>
 <?php  //print_r($_SESSION); ?>
<?php // echo 'state: '. $_SESSION['state']; ?>
<?php  //echo $_SESSION['auth_shipping_id']; ?>
<table width="100%">
  <tr>
  
    <td align="left" valign="top" width="596"><div class="scrolldiv" style="width:566px;">
        <form id="search" name="search" method="get" action="">
        </label><?php if ($state_list[$_SESSION['state']] != "") { ?>
<div style="float: left; width: 110px; overflow: hidden; text-align:center;"><img class="stateImage" src="assets/States_DL/<?php echo $state_list[$_GET['state']]; ?>.jpg"  />  </div> <?php }?>

<select name="state" class="stateselector" id="state" onchange="this.form.submit();">
          <option value="United States">United States</option>
          <?php
do {  
?>
          <option value="<?php echo $row_States['State']?>"<?php if (!(strcmp($row_States['State'], $colname_Courts))) {echo "selected=\"selected\"";} ?>><?php echo $row_States['State']?></option>
          <?php
} while ($row_States = mysql_fetch_assoc($States));
  $rows = mysql_num_rows($States);
  if($rows > 0) {
      mysql_data_seek($States, 0);
	  $row_States = mysql_fetch_assoc($States);
  }
?>
        </select>
        </form>
        
        
   <br clear="all" /><?php if (number_format($row_SelectedState['RecurringPrice'],2) == 0.00){ ?>
     
<?php 
if ($_GET['state'] == 'United States'){ ?>
	<h4><?php echo $_GET['state']; ?></h4>
        The following US Federal courts are available for individual subscription.
        <?php }
else{ ?>
    We currently do not offer rule-sets in this state, however we are constantly adding new jurisdictions. Please contact us if you would like to see this state prioritized as we release rule-sets based on customer demand.<br />
<?php
} ?>
	    <?php }else{ ?>
        <form id="state2" name="state" method="post" action="">
          <input name="court" type="hidden" value="<?php echo $row_Courts['courtSystem_SystemID']; ?>" />
            <?php //echo $totalRows_cartState; 
				  if ($totalRows_cartState < 1){
					   $row_cartState = array("empty");
				  }
				  if ($totalRows_cartStateSub < 1){
					   $row_cartStateSub = array("empty");
				  }
				  if ($totalRows_cartSub < 1){
					   $row_cartSub = array("empty");
				  }
				  //echo $row_Courts['courtSystem_SystemID']. '<BR>';
				  //print_r($row_cartStateSub).'<BR><BR>';
				  //print_r($row_cartSub).'<BR><BR>';
				  if (checkStateCourt($row_Courts['courtSystem_SystemID']) =='no') { ?>
                  <?php  if (in_array($row_Courts['courtSystem_SystemID'], $row_cartSub)){ ?>
                  
                  	  <?php   if ($_SESSION['parent']!="N" && $row_SelectedState['courtSystem_Description'] != NULL)  { ?>
                  
                   	  <a href="#" title="<?php echo $row_SelectedState['courtSystem_Description']; ?>" class="addStateLink"><img src="assets/icons/add.gif"  /></a> <?php } ?>
				  <?php }else{ ?>   <?php   if ($_SESSION['parent']!="N" && $row_SelectedState['courtSystem_Description'] != NULL) { ?>
                  
                   	  <input name="" type="image" src="assets/icons/add.gif" /> <?php } ?>
                  <?php } ?>
             <?php }else{ ?>
            <?php $hasState = 1; ?>
            	  <?php   if ($_SESSION['parent']!="N") { 
            	   if (in_array($row_Courts['courtSystem_SystemID'],$subbedCourtList)) { ?>
            	    <a href="procs/remove_subscribed_court_php?state=<?php echo $colname_Courts; ?>&id=<?php echo $row_Courts['courtSystem_SystemID']; ?>"><img src="assets/icons/delete.gif"  align="absmiddle" /></a> <?php
            	   } else { ?>
            <a href="procs/remove_court_fromlist.php?state=<?php echo $colname_Courts; ?>&systemid=<?php echo $row_Courts['courtSystem_SystemID']; ?>"><img src="assets/icons/delete.gif"  align="absmiddle" /></a> <?php } }?>
            <?php } ?>
            <strong><?php echo $row_SelectedState['courtSystem_Description']; ?></label>
          - $<?php echo number_format($row_SelectedState['RecurringPrice'],2); ?>*</strong><br />
  <span class="stateDescription"><p><?php echo $row_SelectedState['StateText']; ?></p></span>
  <input type="hidden" name="MM_insert" value="state" />
        </form>
        <?php } ?>
               	       <?php
//			   if ($totalRows_cart2 < 1){
//                   $row_cart2 = array("empty"); 
//                }
				?>
        <?php //if ($row_Courts['price'] <> '0.00'){ ?>
        <?php do {
        	if ($row_Courts['price'] <> '0.00'){ 
				if ($title2 <>  $row_Courts['type_Description']){ ?>
                       <br clear="all">
                       <h4><?php echo $row_Courts['type_Description']; ?></h4>
              <?php } 
                    //echo print_r($row_cart2); ?>
                        <form id="select" name="select" method="post" action="">  
                          <?php $title = $row_Courts['type_Description']; ?>
						  <input name="court" type="hidden" value="<?php echo $row_Courts['systemID']; ?>" />
                          <input name="courttype" type="hidden" value="<?php echo $row_Courts['courtSystem_SystemID']; ?>" />
                          <?php if (checkCourt($row_Courts['systemID']) == 'yes'){ ?>
                        <?php   if ($_SESSION['parent']!="N") { 

					$getID=checkSubCourt($row_Courts['systemID']);

                     if ($getID != 'no') { ?>
            	    <a  class="confirmLink" title="<?php echo $row_Courts['description']; ?>" href="procs/remove_subscribed_court.php?state=<?php echo $colname_Courts; ?>&id=<?php echo $getID; ?>"><img src="assets/icons/delete.gif"  align="absmiddle" /></a> <?php
            	   } else { ?>
                        
                          <a href="procs/remove_court_fromlist.php?state=<?php echo$colname_Courts; ?>&systemid=<?php echo $row_Courts['systemID']; ?>"><img src="assets/icons/delete.gif"  align="absmiddle" /></a> <?php }  }?>
                          <?php }else{ ?>
                          <?php if ($hasState==1){
							  }else{ ?>
                         <?php   if ($_SESSION['parent']!="N" && $row_SelectedState['courtSystem_Description'] != "") { ?>  <input name="" type="image" src="assets/icons/add.gif" /><?php } ?>
                          <?php } ?>
                          <?php } ?>
                          <p class="courtlist"><?php echo $row_Courts['description']; ?></p>  
                          <input type="hidden" name="MM_insert" value="select" />
                        </form>
					 
			  <?php
                    $title2 = $row_Courts['type_Description'];
							  }
				   } 
				  while ($row_Courts = mysql_fetch_assoc($Courts));
				   ?>
        <?php //} ?>

    </div></td>
    <td align="left" valign="bottom" class="sidebar"><?php 
			  // if user logged in show current subscriptions
			  if ($_SESSION['userid'] <> ''){ ?>
                <div class="widget">
                <table class="widget-wrap" width>
                      <tr>
                        <td class="yourcart"> 
						
<?php 
//print_r($_SESSION);
if ($_SESSION['fullname'] <> ''){ ?>
	<h4>
    
	Welcome 
    <?php 
   // print_r($_SESSION);
		 if ($_SESSION['parent'] != "N") { ?>
			 		 <a style="color:#FF6600;" href="update-<?php if ($_SESSION['trial']=="Y") { echo "trial"; } else { echo "card"; } ?>"> <?php echo $_SESSION['fullname']; ?></a>  <?php
		 } else { ?>
					<?php echo $_SESSION['fullname']; ?>  <?php
		 } ?>



<span class="userinfo"> (admin) </span>

	</h4><br clear="all" />
			  <?php 
		  
			  
			  
			  
			  } else{ ?>
<a href="<?php //echo $SSLDomain; ?>/login">Login</a><br clear="all" />
<?php } ?><h4>Your current subscriptions</h4></td>
                        <td class="yourcart">&nbsp;</td>
                      </tr>
                      <tr>
                        <td class="userinfo"><div class="divider"></div><strong>Users (<?php echo $totalRows_attornys_sub; ?>)</strong></td>
                        <td class="userinfo"></td>
                      </tr>
      	             <?php if ($totalRows_attornys_sub > 0) { // Show if recordset not empty ?>
					 <?php do { ?> <tr>
                       
  <td class="userinfo"><?php echo $row_attornys_sub['name']; ?></td>
                         <td class="userinfo">  <?php   
						 if ($_SESSION['parent']!="N") { 
						 	if ($_SESSION['fullname']!=$row_attornys_sub['name']) {?> <a class="confirmLink" title="user 
							<?php echo $row_attornys_sub['name']; ?>" href="procs/remove_subscribed_attorney.php?id=<?php echo $row_attornys_sub['attorneyID']; ?>"><img src="assets/icons/delete.gif" width="16" height="16" border="0" /></a><?php 
							} 
 						}
						 
						 
						 ?>
                         
                         
                         </td>
                         
                     </tr><?php } while ($row_attornys_sub = mysql_fetch_assoc($attornys_sub)); ?><?php } // Show if recordset not empty ?>
                      <tr>
                        <td><div class="divider"></div><strong>States  (<?php echo $totalRows_cartStateSub; ?>)</strong></td>
                        <td></td>
                      </tr>
                      <?php if ($totalRows_cartStateSub > 0) { // Show if recordset not empty ?>
                      <?php
						$statePrice = 0;
						 do { ?>
                      <tr>
                        <td><?php echo $row_cartStateSub['courtSystem_Description']; ?></td>
                        <td>  <?php   if ($_SESSION['parent']!="N") { ?> <a class="confirmLink" title="<?php echo $row_cartStateSub['courtSystem_Description']; ?>"  href="procs/remove_subscribed_court.php?id=<?php echo $row_cartStateSub['id']; ?>&amp;state=<?php echo $colname_Courts; ?>"><img src="assets/icons/delete.gif" width="16" height="16"  alt="delete" /></a><?php } ?></td>
                      </tr>
                      <?php $statePrice = $statePrice + $row_cartStateSub['Price']; ?>
                      <?php } while ($row_cartStateSub = mysql_fetch_assoc($cartStateSub)); ?>
                      <?php } // Show if recordset not empty ?>
                      <?php 
					   $state_courts = $totalRows_cartStateSub;
					   if ($state_courts == 1){
							$state_court_cost = $statePrice;   
					   }elseif ($state_courts == 0){
						   $state_court_cost = 0;
					   }else{
							$state_court_cost = ($state_courts - 1) * 19.95 + $statePrice;   
					   }
					   //echo "$".$statePrice;
					   ?>
                      <tr>
                        <td><div class="divider"></div><strong>Courts (<?php echo $totalRows_cartSub; ?>)</strong></td>
                        <td>&nbsp;</td>
                      </tr>
                      
   <?php if ($totalRows_cartSub > 0) { // Show if recordset not empty ?>
                      <?php do { ?>
                      <tr>
                        <td><?php echo $row_cartSub['description']; ?></td>
                        <td>  <?php   if ($_SESSION['parent']!="N") { ?> <a class="confirmLink" title="<?php echo $row_cartSub['description']; ?>" href="procs/remove_subscribed_court.php?id=<?php echo $row_cartSub['id']; ?>&state=<?php echo $colname_Courts; ?>"><img src="assets/icons/cancl_16.gif" border="0" width="16" height="16" alt="cancel" /></a><?php } ?></td>
                      </tr>
                      <?php } while ($row_cartSub = mysql_fetch_assoc($cartSub)); ?>
                      <?php } // Show if recordset not empty ?>
                      
                                            <?php 
					   $ind_courts = $totalRows_cartSub;
					   if ($ind_courts < 2){
						    // 1+1 package
							$ind_court_cost = 15.00;   
					   }elseif ($ind_courts >= 2 && $ind_courts <= 5){
						   $ind_court_cost = 50.00;
						}elseif ($ind_courts > 5 && $ind_courts <= 10){
						   $ind_court_cost = 95.00;   
					   }elseif ($ind_courts == 0){
						   $ind_court_cost = 0;
					   }else{
							// $ind_court_cost = ($ind_courts - 1) * 4.95 + 9.95;   
					   }
					  // $mo_cost = $ind_court_cost + $state_court_cost;
					   $mo_cost = $ind_court_cost;

					   ?>

<?php if ($row_userInfo['TrialAccount'] == 1) { ?>
                      <tr>
                        <td><div class="divider"></div>
                      <B>Note: your trial ends <?php echo date('D, M jS, Y', strtotime($row_userInfo['datecreated']. " +14 day")); ?></B><BR /><br /></td><td></td></tr>
                      <?php } ?>
                      

                       <?php include('include/inc_sub_pricing.php'); ?>
                      <tr>
                        <td align="right" class="cartTotal">Current Recurring Total: <strong>$<?php echo number_format($mo_cost, 2);?>/mo</strong></td>
                        <td align="right" class="cartTotal">
                        <?php
					  $updateSQL = sprintf("UPDATE users SET CurrentChargeAmount=%s WHERE id=%s",
                      GetSQLValueString(number_format($mo_cost, 2), "text"),
                      GetSQLValueString($row_userInfo['id'], "int"));
					  
					  //echo $updateSQL;
					  
					  mysql_select_db($database_docketData, $docketData);
					  $Result1 = mysql_query($updateSQL, $docketData) or die(mysql_error());
						?>
                        </td>
                      </tr>
                    </table>
                    </div>
                    
                    
                    
                    
                    
                <?php } ?>
<form id="form2" name="form2" method="post" action="">
      	        <div class="widget"><table class="widget-wrap">
      	              <tr>
      	             <td width="80%" class="yourcart"><h4>Your Cart<br /><?php //echo session_id(); ?></h4></td>
      	                <td width="10%" class="yourcart">&nbsp;</td>
                  </tr>
      	              <tr>
					  <?php if ($totalRows_attornys_cart==0) { ?>
      	                <td class="userinfo"><div class="divider"></div><strong>No <?php if ($totalRows_attornys_sub > 0) 
						{?>additional <?php } ?>users</strong></td> 
						<?php } else { ?>
                          <td width="10%"  class="userinfo"><div class="divider"></div><strong>Users (<?php echo $totalRows_attornys_cart; ?>)</strong></td>
                          <?php } ?>

      	                <td  class="userinfo">  <?php   if ($_SESSION['parent']!="N") { ?> <img id="create-user" src="assets/icons/add.gif"  alt="Add Attorney" /><?php } ?></td>
    	                </tr>
      	             <?php if ($totalRows_attornys_cart > 0) { // Show if recordset not empty ?>
					 <?php do { ?> <tr>
                       
  <td><?php echo $row_attornys_cart['name']."<br>"; ?></td>
                         <td width="10%">  <?php   if ($_SESSION['parent']!="N") { ?> <a href="procs/remove_attorney.php?id=<?php echo $row_attornys_cart['attorneyID']; ?>"><img src="assets/icons/delete.gif"  alt="delete" /></a><?php } ?></td>               
                     </tr><?php } while ($row_attornys_cart = mysql_fetch_assoc($attornys_cart)); ?><?php } // Show if recordset not empty ?>
      	              <tr>
      	                <td><div class="divider"></div><strong>States  (<?php echo $totalRows_cartState; ?>)</strong></td>
      	                <td width="10%">&nbsp;</td>
    	                </tr>
      	               <?php
					   $statePrice = 0;
					    if ($totalRows_cartState > 0) { // Show if recordset not empty ?>
      	                <?php
						 do { ?> <tr>
      	                  <td><div class="divider"></div><?php echo $row_cartState['courtSystem_Description']; ?></td>
      	                  <td width="10%">  <?php   if ($_SESSION['parent']!="N") { ?> <a href="procs/remove_court.php?id=<?php echo $row_cartState['id']; ?>&state=<?php echo $colname_Courts; ?>"><img src="assets/icons/delete.gif" alt="delete" /></a><?php } ?></td>
      	                 
                        </tr> 
                        <?php $statePrice = $statePrice + $row_cartState['Price']; ?>
   	                    <?php } while ($row_cartState = mysql_fetch_assoc($cartState)); ?>
                        <?php } // Show if recordset not empty ?>
                        
                       <?php 
					   
					   $state_courts = $totalRows_cartState;
					   if ($state_courts == 1){
							$state_court_cost = $statePrice;   
					   }elseif ($state_courts == 0){
						   $state_court_cost = 0;
					   }else{
							$state_court_cost = ($state_courts - 1) * 19.95 + $statePrice;   
					   }
					   ?>
      	                <tr>
      	                <td><div class="divider"></div><strong>Courts (<?php echo $totalRows_cart; ?>)</strong></td>
      	                <td width="10%">&nbsp;</td>
                      
                      </tr>
                        <?php if ($totalRows_cart > 0) { // Show if recordset not empty ?>
      	                <?php do { ?> <tr>
      	             
      	                  <td><?php echo $row_cart['description']; ?></td>
      	                  <td width="10%">  <?php   if ($_SESSION['parent']!="N") { ?> <a href="procs/remove_court.php?id=<?php echo $row_cart['id']; ?>&state=<?php echo $colname_Courts; ?>"><img src="assets/icons/delete.gif"  alt="delete" /></a><?php } ?></td>
      	                 
                        </tr> 
   	                    <?php } while ($row_cart = mysql_fetch_assoc($cart)); ?>
                        <?php } // Show if recordset not empty ?>
                        <?php  
				include('include/inc_pricing.php'); ?>
      	              <tr>
      	                <td align="right" class="cartTotal"><div class="divider"></div><p align="left"><a href="
      	                state=<?php echo $colname_Courts; ?>">Clear All</a></p>Recurring Total:&nbsp; <strong>$<?php echo number_format($new_mo_cost, 2);?>/mo</strong></td>
      	                <td width="10%" align="right" class="cartTotal">&nbsp;</td>
    	                </tr>
      	              <tr>
      	                <td align="right" class="cartTotal">Amount Charged Today:&nbsp;
                        <strong><?php
						// calculate days remaining for month
						if (date('j') > 1){ 
						//echo date("h:m:s",time());
							$daysused = date(d);
							//echo $daysused;
							$daysinmonth = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
							//echo $daysinmonth;
							$daysleft = $daysinmonth - $daysused;
							if ($daysleft==0) {
								$daysleft=1;
							}
							$current_charge = ($new_mo_cost/$daysinmonth) * $daysleft;
							echo '$'.number_format($current_charge, 2);
						}else{
							$current_charge = $new_mo_cost;
							echo '$'.number_format($new_mo_cost, 2);
						}
						?></strong>
                        </td>
      	                <td width="10%" class="smallText">&nbsp;</td>
    	                </tr>
      	              <tr><td colspan="2" class="smallText">
                      <?php 	if ($_SESSION['trial']=="N"){ ?>
      	                <br /><p>Your charge today will be prorated to the number of days remaining in this month. Beginning next month, your card will be charged the "Recurring Total" amount on the 1st of each month.</p> <?php } ?>
                          <br /><p class="checkout">


                      	<?php 

							if ($current_charge == 0){
									if (($totalRows_attornys_cart > 0 ||  $totalRows_cart > 0 || $totalRows_cartState > 0) && $row_userInfo['TrialActive'] == '1'){ 
                            			if ($row_userInfo['TrialActive'] == '1'){ ?>

                                   			<a  class="buttonstyle" href="/procs/process_trial.php" >Subscribe</a>&nbsp;&nbsp;
												                                        
<?php
                                		} else { ?>
                                        
                                			<a  class="buttonstyle" href="<?php echo $SSLDomain; ?>/update">Checkout</a>&nbsp;&nbsp;
<?php
                                 		} 
									} else { 
                                    	if ($totalRows_attornys_cart == 0 &&  $totalRows_cart == 0) {
											//echo "Add to your cart to Checkout"; 
										} else { ?>
	                                   		<a  class="buttonstyle" href="<?php echo $SSLDomain; ?>/checkout">Checkout</a>&nbsp;&nbsp;
<?php
										}
		                           	} 
								} else { 
									if ($_SESSION['userid'] <> ''){
										if (empty($row_userInfo['auth_payment_id'])){ ?>
                                 			<a  class="buttonstyle" href="<?php echo $SSLDomain; ?>/checkout1">Checkout</a>&nbsp;&nbsp;
<?php
 										} else { ?>
                                     		<a  class="buttonstyle" href="<?php echo $SSLDomain; ?>/update">Checkout</a>&nbsp;&nbsp;
<?php 
                                		} 
									} else { ?>
                                 		<a  class="buttonstyle" href="<?php echo $SSLDomain; ?>/checkout">Checkout</a>&nbsp;&nbsp;
<?php
                             		} 
                       			} ?>
<?php // echo " | ".$_SESSION['userid']; ?>
                          
                          
                          </p></td>
      	                </tr>
   	                </table>
                    
                    </div>
                    
   	          </form>              </td>
    </tr>
      	    <tr>
            <td width="596" align="left" valign="top">   
              
              
</td>
<td></td>
   	        </tr>
</table>




<div id="dialog" title="Confirmation Required">
  Cancelling your subscription to: <span id="courtName"></span>  will take place immediately. Your recurring charge will be updated as of the 1st of next month. <BR /><BR />Proceed with cancellation?
</div>

<div id="dialogConfirm" title="Confirm Items">
  Items successfully added to your trial account.
</div>


<div id="dialogAlert" title="Alert">
Please cancel individual court subscriptions to <span id="stateName"></span> in order to subscribe to the entire state.
</div>
	<div id="dialog-form" title="Add User">
	<p class="validateTips">All form fields are required.</p>
	<form action="<?php echo $editFormAction; ?>" id="addUserForm" method="post">
		<label for="fullname">Name</label>
		<input type="text" name="fullname" id="fullname" class="text ui-widget-content ui-corner-all" />
		<label for="email">Email <div id="msgbox2"></div></label>
		<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
        <label for="username">Username <div id="msgbox"></div></label>
		<input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all" />
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
    <input type="hidden" name="MM_insert" value="addUserForm" />
	</form>
</div>

<?php// print_r($subbedCourtList); 
//echo "<br>". $query_SubbedCourts;?>

<?php

//print_r($_SESSION);

mysql_free_result($States);

mysql_free_result($Courts);

mysql_free_result($SelectedState);

mysql_free_result($cart);

mysql_free_result($stateComments);

mysql_free_result($userInfo);

mysql_free_result($attornys_cart);
?>
 
<?php
}

genesis();
?>