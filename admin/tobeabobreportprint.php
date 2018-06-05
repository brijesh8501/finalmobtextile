<?php include("logcode.php"); error_reporting(0);
include("databaseconnect.php");

if(isset($_REQUEST['print']))
{
	$reportrange = $_REQUEST['reportrange']; 
	
	$splitdate = explode("-",$reportrange);
$date = $splitdate[0];
$date1 = $splitdate[1];
$dt = date('Y-m-d', strtotime($date));
$dt1 = date('Y-m-d', strtotime($date1)); 
$Machine_Id = $_REQUEST['Machine_Id'];
	$query1 = "select sum(saree_details.Saree_Lot_Meter) as Sum_Meter, sum(saree_details.Saree_Pieces) as Sum_Pieces, quality_details.Quality_Name, design_details.Design, machine_details.Machine_No from saree_details,saree_production,quality_details,design_details,machine_details,beam_machine where saree_production.Sa_Pro_Id = saree_details.Sa_Pro_Id AND beam_machine.Be_M_Id = saree_production.Be_M_Id AND machine_details.Machine_Id = beam_machine.Machine_Id AND design_details.Design_Id = saree_details.Design_Id AND quality_details.Quality_Id = design_details.Quality_Id AND beam_machine.Machine_Id = '$Machine_Id' AND saree_details.Date between '".$dt."' and '".$dt1."' group by quality_details.Quality_Name order by quality_details.Quality_Name asc";
 $rsMain = mysql_query($query1);
	$rowMain = mysql_fetch_array($rsMain);
	$totalRowsRsMain = mysql_num_rows($rsMain);
	}
////////////////////////////////// number format in point 
  function moneyFormatIndia($num){
$explrestunits = "" ;
$num=preg_replace('/,+/', '', $num);
$words = explode(".", $num);
$des="00";
if(count($words)<=2){
    $num=$words[0];
    if(count($words)>=2){$des=$words[1];}
    if(strlen($des)<2){$des="$des0";}else{$des=substr($des,0,2);}
}
if(strlen($num)>3){
    $lastthree = substr($num, strlen($num)-3, strlen($num));
    $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
    $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
    $expunit = str_split($restunits, 2);
    for($i=0; $i<sizeof($expunit); $i++){
        // creates each of the 2's group and adds a comma to the end
        if($i==0)
        {
            $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
        }else{
            $explrestunits .= $expunit[$i].",";
        }
    }
    $thecash = $explrestunits.$lastthree;
} else {
    $thecash = $num;
}
return "$thecash.$des"; // writes the final format where $currency is the currency symbol.

}
////////////////////////////////// number format without point 
function moneyFormatIndia1($num){
    $explrestunits = "" ;
    if(strlen($num)>3){
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++){
            // creates each of the 2's group and adds a comma to the end
            if($i==0)
            {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            }else{
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}	
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
table{
	border-collapse:collapse;
}
</style>
<link rel="shortcut icon" href="Icons/st85.png">
</head>
<body onload="window.print() ">
<table width="990" border="0" align="center" cellpadding="5" cellspacing="5" >
  <tr  style="font-size:24px">
    <?php date_default_timezone_set("Asia/Calcutta"); ?>
    <td>
      <div id="print-header-wrapper">
                    <div class="row-fluid">&nbsp;Machine-Wise Production <b>Report</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><?php echo $date.' - '.$date1;?></i></div>
                    <div class="row-fluid" align="center"><strong>!! Shree Ganeshayan Namaha !!</strong><br/>
    <strong>SHINGORI TEXTILE</strong></div>
                    <div class="row-fluid" align="right"><b>Machine No : <?php echo $rowMain['Machine_No'];?></b>&nbsp;&nbsp;&nbsp;<?php echo date('Y/m/d h:i:s A'); ?>&nbsp;&nbsp;</div>
                   </div>
    </td>
  </tr>
  <tr>  
    <td colspan="10" valign="top">
        <table width="100%" border="1" cellspacing="2" cellpadding="2" class="table" id="table_data" >
        <thead>
          <tr>
      
                                       <th width="7%"><center>Sr No.</center></th>
                                             <th width="10%"><center>Total Meter</center></th>
                                             <th width="10%"><center>Total Piecess</center></th>
                                            <th width="30%"><center>Quality</center></th>
                                            <th width="20%"><center>Design</center></th>
                                       
      </tr> 
       </thead>
       <tbody>
    
    <?php
			$i = 0;
			$i++;						
									
									do { ?>                                    
                                      
  <tr align="center"> 
    
   <td><?php echo $i++; ?></td>
    <td><?php echo moneyFormatIndia($rowMain['Sum_Meter']); ?></td>
    <td><?php echo moneyFormatIndia1($rowMain['Sum_Pieces']); ?></td>
    <td><?php echo $rowMain['Quality_Name']; ?></td>
    <td><?php echo $rowMain['Design']; ?></td>
    <?php   $Tot_Mtr = $Tot_Mtr + $rowMain['Sum_Meter'];
	$Tot_Piecess = $Tot_Piecess + $rowMain['Sum_Pieces'];
     } while($rowMain = mysql_fetch_assoc($rsMain)); ?>
     <tr>
     <td colspan="5" align="right"><b>Total Meter (Saree) : <?php echo moneyFormatIndia($Tot_Mtr); ?>&nbsp;&nbsp;Total Piecess (Saree) : <?php echo moneyFormatIndia1($Tot_Piecess);?></b></td>
     </tr>
</tbody>
        </table>
        </td>
        </tr>
</table>
</body>
</html>
<?php
 ob_flush(); ?>