<?php session_start();
include("databaseconnect.php");
    if(isset($_REQUEST['delete_id'])) {
      $Sa_Labour_Id = mysql_real_escape_string($_REQUEST['delete_id']);
	   if(!isset($_SESSION['User']))
		  {
		  }
		  else
		  {
    $result = mysql_query("delete from saree_labsal where Sa_Labour_Id = ".$Sa_Labour_Id);
    if($result !== false) {
        echo 'true';
      }
    }
    }
?>