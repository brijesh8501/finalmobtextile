﻿<?php include("logcode.php"); error_reporting(0);
include("databaseconnect.php");
if(isset($_REQUEST['action']))
{
	$action = $_REQUEST['action'];
    if($action == "insert")
	{
	$decodeurl = $_REQUEST['Order_Id'];
	$durl = urldecode($decodeurl); 
	$turl = str_replace("'"," ",$durl);
	$urls = explode(" ",$turl);
	$Order_Id = $urls[1];
	$sql = "SELECT order_master.Order_Id, order_master.Om_Date, customer_details.Cu_En_Name,customer_details.Customer_Id, broker_details1.B_Name, broker_details1.Broker_Id FROM order_master, customer_details, broker_details1 WHERE customer_details.Customer_Id = order_master.Customer_Id AND broker_details1.Broker_Id = order_master.Broker_Id AND order_master.Order_Id='".$Order_Id."'  ";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$Order_Id = $row['Order_Id'];
	date_default_timezone_set('Asia/Calcutta');
	$Saree_D_C_Date = date('Y-m-d');
	$Customer_Id = $row['Customer_Id'];
	$Broker_Id = $row['Broker_Id'];
	$Cu_En_Name = $row['Cu_En_Name'];
	$B_Name = $row['B_Name'];
	$Saree_D_C_Id = getNewChallanID();
	 include("webrenew.php");
}
 if($action == 'update')
	{
		$decodeurl = $_REQUEST['Saree_D_C_Id'];
	$durl = urldecode($decodeurl); 
	$turl = str_replace("'"," ",$durl);
	$urls = explode(" ",$turl);
	$Saree_D_C_Id = $urls[1];
	$sql = "SELECT saree_d_c.Saree_D_C_Id, saree_d_c.Saree_D_C_Date, customer_details.Cu_En_Name,customer_details.Customer_Id, broker_details1.B_Name, broker_details1.Broker_Id, saree_d_c.Order_Id, saree_d_c.Total_Lot, saree_d_c.Entry_Id FROM saree_d_c, customer_details, broker_details1 WHERE customer_details.Customer_Id = saree_d_c.Customer_Id AND broker_details1.Broker_Id = saree_d_c.Broker_Id AND saree_d_c.Saree_D_C_Id = '".$Saree_D_C_Id."'  ";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$Saree_D_C_Id = $row['Saree_D_C_Id'];
	$Saree_D_C_Date = $row['Saree_D_C_Date'];
	$Customer_Id = $row['Customer_Id'];
	$Broker_Id = $row['Broker_Id'];
	$Cu_En_Name = $row['Cu_En_Name'];
	$B_Name = $row['B_Name'];
	$Order_Id = $row['Order_Id'];
	$Total_Lot = $row['Total_Lot'];
	$Entry_Id = $row['Entry_Id'];
	date_default_timezone_set('Asia/Calcutta');
	 include("webrenew.php");
	$sel_check_entry = "select count(Saree_Lot_Id) as count_saree from saree_dcorg where Saree_D_C_Id='$Saree_D_C_Id'";
	$sel_check_exe = mysql_query($sel_check_entry);
	$sel_check_fetch = mysql_fetch_array($sel_check_exe);
	if($sel_check_fetch[0]==$Total_Lot)
	{}else
	{
		$msg_check_saree ='<strong style="color:#F00;">'.'Please update this challan which is required</strong>';
	}}}
	 if(isset ($_REQUEST['submit']))
{
//insert
     if(!isset($_SESSION['User']))
{ } 
else
{   
	$Saree_D_C_Date = $_REQUEST['Saree_D_C_Date'];
	$Customer_Id = $_REQUEST['Customer_Id'];
	$Broker_Id = $_REQUEST['Broker_Id'];
	$Order_Id = $_REQUEST['Order_Id'];
	$Total_Lot = $_REQUEST['Total_Lot'];
	$Entry_Id = $row_result['Registration_Id'];
	$sql= "INSERT INTO  `saree_d_c` (`Saree_D_C_Id` ,`Saree_D_C_Date` ,`Customer_Id` ,`Broker_Id`,`Order_Id`,`Total_Lot`,`Entry_Id`)VALUES (NULL , '$Saree_D_C_Date' ,  '$Customer_Id',  '$Broker_Id',  '$Order_Id', '$Total_Lot','$Entry_Id')";
$result = mysql_query($sql);
$sel_sub = "select * from saree_d_c_2 where saree_d_c_2.Saree_D_C_Id = '$Saree_D_C_Id'";
$sel_exe = mysql_query($sel_sub);
while($sel_fetch = mysql_fetch_array($sel_exe))
{
	$ins_sub = "insert into saree_dcorg (Sa_D_C_Id,Saree_D_C_Id,Saree_Lot_Id,Saree_Lot_Meter,Saree_Weight,Saree_Pieces,Design_Id,Status,R_Id) values(NULL,'".$sel_fetch[1]."','".$sel_fetch[2]."','".$sel_fetch[3]."','".$sel_fetch[4]."','".$sel_fetch[5]."','".$sel_fetch[6]."','".$sel_fetch[7]."','".$sel_fetch[8]."')";
	mysql_query($ins_sub);
}
$del_sub = "delete from saree_d_c_2 where saree_d_c_2.Saree_D_C_Id='$Saree_D_C_Id'";
$del_exe = mysql_query($del_sub);
$sel_sub_or = "select * from saree_dcorg where saree_dcorg.Saree_D_C_Id = '$Saree_D_C_Id'";
$sel_exe_or = mysql_query($sel_sub_or);
$total_sel_row = mysql_num_rows($sel_exe_or);
if($total_sel_row==0)
{
	$msg_error='Something gone wrong so your sub entry is not inserted in your last inserted challan, now please update that challan first';
}
else
{
	$msg_error='Record inserted';
}
 $insertGoTo = "saree_d_c_list?msg_error=$msg_error";
  echo '<script>window.location="'.$insertGoTo.'";</script>';
}}
	 if(isset($_REQUEST['update']))
{
//update
if(!isset($_SESSION['User']))
{ } else{
    $Saree_D_C_Id = $_REQUEST['Saree_D_C_Id']; 
	$Saree_D_C_Date = $_REQUEST['Saree_D_C_Date'];
	$Customer_Id = $_REQUEST['Customer_Id'];
	$Broker_Id = $_REQUEST['Broker_Id'];
	$Order_Id = $_REQUEST['Order_Id'];
	$Total_Lot = $_REQUEST['Total_Lot'];
	$Entry_Id = $row_result['Registration_Id'];
	$sql= "UPDATE `saree_d_c` SET `Saree_D_C_Date` = '$Saree_D_C_Date', `Customer_Id` = '$Customer_Id', `Broker_Id` = '$Broker_Id', `Order_Id` = '$Order_Id', `Total_Lot` = '$Total_Lot', `Entry_Id` = '$Entry_Id' WHERE `saree_d_c`.`Saree_D_C_Id` = '".$Saree_D_C_Id."' ";
$result = mysql_query($sql);
 $updateGoTo = "saree_d_c_list?msg";
  echo '<script>window.location="'.$updateGoTo.'";</script>';
}}
?>
<!DOCTYPE html>
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
      <meta charset="UTF-8" />
    <title>Shingori Textile</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
    <noscript>
    <style> html {display:none; }</style>
     <META HTTP-EQUIV="Refresh" CONTENT="0; URL=javascripterror.php">
    </noscript>
    <link rel="shortcut icon" href="Icons/st85.png">
  <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/joint-jquery-ui-datepicker.css">
</head>
<body>
       <?php include("sidemenu.php") ?>
                <div class="inner">
                    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" align="center">SAREE CHALLAN</h1>
                </div>
            </div>
<div class="row">
<div class="col-lg-12">
    <div class="box dark">
        <div id="div-1" class="accordion-body collapse in body">
            <form class="form-horizontal" method="post" <?php if($action =='insert') { ?>onsubmit="if(submitting) {
alert('The record is being submitted, please wait a moment...');submit.disabled = true;return false;}if(checkQuotee(this)){submit.value = 'Submitting...';submitting = true;return true;}return false;" <?php } elseif($action=='update') { ?> onsubmit="if(submitting) {alert('The record is being updated, please wait a moment...');update.disabled = true;return false;}if(checkQuotee(this)){update.value = 'Updating...';submitting = true;return true;}return false;"<?php } ?>>
            <div class="form-group row">
            <div class="col-lg-4">
            <div class="form-group">
                    <label for="text2" class="control-label col-lg-5">Customer :</label>
                    <div class="col-lg-7">
                    <input type="text" id="Cu_En_Name" placeholder="" name="Cu_En_Name" value="<?php echo $Cu_En_Name; ?>" class="form-control" readonly />
                    <input type="hidden" name="Customer_Id" value="<?php echo $Customer_Id; ?>" />
                    </div>
                </div>
                        </div>
                       <div class="col-lg-4">
                       <div class="form-group">
                        <label class="control-label col-lg-5" >Challan Date :</label>
                        <div class="col-lg-7">
                              <input class="form-control" type="text" name="Saree_D_C_Date" id="Saree_D_C_Date" value="<?php echo $Saree_D_C_Date; ?>" readonly />
                        </div>
                    </div>
                        </div>
                         <div class="col-lg-4">
                         <div class="form-group">
                    <label for="text2" class="control-label col-lg-5">Challan ID :</label>
                    <div class="col-lg-7">
                    <input type="text" id="Saree_D_C_Id" placeholder="" class="form-control" name="Saree_D_C_Id" value="<?php echo $Saree_D_C_Id; ?>" readonly />
                    </div>
                </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                        <div class="form-group">
                    <label for="text2" class="control-label col-lg-5">Broker :</label>
                    <div class="col-lg-7">
                    <input type="text" id="B_Name" placeholder="" name="B_Name" class="form-control" value="<?php echo $B_Name; ?>" readonly />
                    <input type="hidden" name="Broker_Id" value="<?php echo $Broker_Id; ?>" />
                    </div>
                </div>
                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                        <div class="form-group">
                    <label for="text2" class="control-label col-lg-5">Order ID :</label>
                    <div class="col-lg-7">
                    <input type="text" id="Order_Id" placeholder="" class="form-control" name="Order_Id" value="<?php echo $Order_Id; ?>" readonly />
                    </div>
                </div>
                        </div>
                    </div>
                     <div class="form-group row">
                        <div class="col-lg-3">
                        <div class="form-group">
                    <label for="text2" class="control-label col-lg-5">Lot ID :</label>
                    <div class="col-lg-7">
                    <input type="text" id="Saree_Lot_Id" placeholder="" class="form-control" name="Saree_Lot_Id" onkeypress="return isNumberKey(event)" />
                    <span id="check"></span>
                    </div>
                </div>
                        </div>
                        <div id="show"></div>
                        <div class="col-lg-3">
                            <div class="form-group">
                    <label for="text2" class="control-label col-lg-5">Lot Meter :</label>
                    <div class="col-lg-7">
                    <input type="text" id="Saree_Lot_Meter" placeholder="" class="form-control" name="Saree_Lot_Meter" readonly /><input type="hidden" name="action" id="action" value="<?php echo $action;?>"/>
                    </div>
                </div>
                        </div>
                         <div class="col-lg-3">
                            <div class="form-group">
                    <label for="text2" class="control-label col-lg-5">Lot Weight :</label>
                    <div class="col-lg-7">
                    <input type="text" id="Saree_Weight" placeholder="" class="form-control" name="Saree_Weight" readonly />
                    </div>
                </div></div>
                        <div class="col-lg-3">
                            <div class="form-group">
                    <label for="text2" class="control-label col-lg-6">Lot Piecess :</label>
                    <div class="col-lg-6">
                    <input type="text" id="Saree_Pieces" placeholder="" class="form-control" name="Saree_Pieces" readonly />
                    </div>
                </div>
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-lg-4">
                        <input type="hidden" name="Quality_Id" id="Quality_Id" readonly />
                        <div class="form-group">
                    <label for="text2" class="control-label col-lg-5">Quality :</label>
                    <div class="col-lg-7">
                    <input type="text" id="Quality_Name" placeholder="" class="form-control" name="Quality_Name" readonly />
                    <input type="hidden" id="R_Id" name="R_Id" value="<?php echo $row_result['Registration_Id']; ?>"  />
                    </div>
                </div>
                        </div>
                        <div class="col-lg-4">
                        <input type="hidden" name="Design_Id" id="Design_Id" readonly />
                        <div class="form-group">
                    <label for="text2" class="control-label col-lg-5">Design :</label>
                    <div class="col-lg-7">
                    <input type="text" id="Design" placeholder="" class="form-control" name="Design" readonly />
                    </div>
                </div>
                        </div>
                        <div class="col-lg-4">
                        <div class="form-group">
<label class="control-label col-lg-5">Status :</label>
<div class="col-lg-7">
  <select name="Status" class="form-control" id="Status">
    <option value="Sale">Sale</option>
    <option value="Return">Return</option>
  </select>
  </div>
</div>
                        </div>
                    </div>
                   <div align="right">
                    <?php
                                            if($days_remaining<=0)
{}
elseif($days_remaining>0)
{
?>	
                        <input type="button" value="Add" class="btn btn-primary btn-grad " name="Add1" id="Add1" />
                      <?php } ?>      
                        </div>
                    <hr />
                       <div class="col-lg-12" >
                         <div class="row">
                <div class="col-lg-12" >
                            <div class="table-responsive" id="table" >
                            </div>
                        </div>
                    </div>
                        </div>
                        <hr />
                         <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                        <div style="color:#F00" align="right">Only 34 lot acceptable in one challan</div>
                        <div class="form-group">
                    <label for="text2" class="control-label col-lg-5">Total Lot :</label>
                    <div class="col-lg-7">
                    <input type="text" id="Total_Lot" placeholder="" class="form-control" name="Total_Lot" value="<?php echo $Total_Lot; ?>" readonly/>
                    </div>
                </div>
                        </div>
                         <?php if($action=='update')
						{
							?>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                        <div class="form-group">
                    <label for="text2" class="control-label col-lg-5">Entry #ID :</label>
                    <div class="col-lg-7">
                    <input type="text" id="Entry_Id" placeholder="" class="form-control" name="Entry_Id"  value="<?php echo $Entry_Id; ?>"  readonly/>
                    </div>
                </div>
                        </div>
                        <?php 
						}
						?>
                   <div style="text-align:center" class="form-actions no-margin-bottom">
                         <?php
						 if($days_remaining<=0)
{
	echo "<strong style='color:#F00;'>* Please renew your website</strong>";
} 
							if($action=='update')
                             {
								  echo $msg_check_saree;
							 }
							?>
                       <?php 
							if($action=="update" )
                             {
							?>
                                            <a href="saree_d_c_list"><input type="button" value="Back" class="btn btn-inverse btn-lg " name="back"/></a> <input type="submit" value=" Update Challan" class="btn btn-primary btn-lg" name="update" />
                        <?php }
						else if($action=="insert" )
						{
						?>
                                  <a href="order_listpage.php"><input type="button" value="Back" class="btn btn-inverse btn-lg " name="back1"/></a> 
                                   <?php
                                            if($days_remaining<=0)
{}
elseif($days_remaining>0)
{
?>	
                                  <input type="submit" value="Submit Challan" class="btn btn-primary btn-lg" name="submit" />
                        <?php } } ?>
                        </div>
                   </form>
            </div>
        </div>
    </div>
</div>
                    </div>
   <?php include("footer.php"); ?>
     <script src="assets/js/shortcut.js"></script>
<script src="assets/js/googleapi.js"></script>
<script src="assets/js/sareechallan.js"></script>
<script src="assets/js/jointjquerydateandpicker.js"></script>
<script>
$(document).ready(function(){
sql="?Saree_D_C_Id=<?php echo $Saree_D_C_Id; ?>&action=<?php echo $action;?>";
$("#table").load("saree_d_c85table.php"+sql);
});
<?php include("shortcutkeys.php");?>
</script>
</body>
</html>
<?php
function getNewChallanID()
{
	include("databaseconnect.php");
	$sql = "select max(Saree_D_C_Id)+1 from saree_d_c";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if($row != null && $row[0] > 0)
		{
			$new_id =  $row[0];
		}
		else
		{
			$new_id = '1';
		}
		return $new_id;
	}
	ob_flush(); ?>