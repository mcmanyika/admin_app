
<?php require_once('Connections/connection.php'); ?>
<?php

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
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

$fDate_stats = "-1";
if (isset($_GET['fDate'])) {
  $fDate_stats = $_GET['fDate'];
}
$tDate_stats = "-1";
if (isset($_GET['tDate'])) {
  $tDate_stats = $_GET['tDate'];
}
mysql_select_db($database_connection, $connection);
$query_stats = sprintf("SELECT purpose, currency, sum(amount) as total, pay_option FROM t_finance WHERE `date` BETWEEN %s AND %s GROUP BY purpose, currency,  pay_option ORDER BY purpose desc", GetSQLValueString($fDate_stats, "date"),GetSQLValueString($tDate_stats, "date"));
$stats = mysql_query($query_stats, $connection) or die(mysql_error());
$row_stats = mysql_fetch_assoc($stats);
$totalRows_stats = mysql_num_rows($stats);
?>
<!doctype html>
<html lang="en"><!-- InstanceBegin template="/Templates/base.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- InstanceBeginEditable name="doctitle" -->
<title>HIM Finance Dashboard</title>
<!-- InstanceEndEditable -->
<link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery.mobile-1.4.5.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
<!-- InstanceBeginEditable name="head" -->

<!-- InstanceEndEditable -->
<!-- InstanceParam name="OptionalRegion1" type="boolean" value="true" -->
<!-- InstanceParam name="OptionalRegion2" type="boolean" value="true" -->
<!-- InstanceParam name="OptionalRegion3" type="boolean" value="true" -->
</head>
<body>
 
<div data-role="page" id="page1">
  <div data-role="header">
    <h1><a href="index.php" data-role="button"  data-inline="true" data-icon="home" data-transition="flip" style="text-transform:capitalize">HIM Finance Dashboard</a></h1>
  </div>
  <div role="main" class="ui-content">
  <div class="col-xs-12"><!-- InstanceBeginEditable name="EditRegion5" -->
  <div class="col-md-3">
  <a href="#defaultpanel" data-role="button" data-inline="true" data-icon="bars">Browse Links</a>
  </div>
  <div class="col-md-3">
     <button type="button" onClick="window.location.reload();" data-icon="refresh">Refresh Page</button>
     </div>
  <!-- InstanceEndEditable -->
  
  <!-- InstanceBeginEditable name="container" -->
  
  <div class="col-md-8" style="padding-top:20px">
  <?php if($row_stats>0) { ?>
         <table id="MyTable2export" width="100%" cellpadding="5">
            <tr>
               <th><strong>Purpose</strong></th>
               <th><strong>Currency</strong></th>
               <th><strong>Total</strong></th>
               <th><strong>Payment Options</strong></th>
            </tr>
            <?php do { ?>
            <tr>
			
               <td><?php echo $row_stats['purpose']; ?></td>
               <td><?php echo $row_stats['currency']; ?></td>
               <td><?php echo $row_stats['total']; ?></td>
               <td><?php echo $row_stats['pay_option']; ?></td>
             </tr> 
    <?php } while ($row_stats = mysql_fetch_assoc($stats)); ?>
     
         </table>
        <?php } else 
		 echo "No records"; ?>
        
      </div>
  
  	
    <div class="col-md-4">
    <script src="js/jquery.form.js"></script> 
 
    <script> 
        // wait for the DOM to be loaded 
        $(document).ready(function() { 
            // bind 'myForm' and provide a simple callback function 
            $('#filter').ajaxForm(function() {}); 
        }); 
    </script>
    	<form action="" method="GET" enctype="application/x-www-form-urlencoded" id="filter" name="filter">
        <input name="fDate" type="date" data-role="date" value="">
        <input name="tDate" type="date" value="">
        <input name="Search" type="submit" class="btn-success btn-lg">
        <button id="download" >Download</button>
        </form>
    </div>
    <script src="js/jquery.min.js"></script>
      <script src="js/jquery.table2excel.js"></script>
      <script>
      	// button click
      	$('#download').on('click',function(){
      		// get the table id
      		$("#MyTable2export").table2excel();
      	});
      </script>


  <!-- InstanceEndEditable -->
 
  </div><!-- /grid-a -->
    
  </div>
  
  
  <div data-role="panel" id="defaultpanel" data-theme="b">
    <div class="panel-content">
    <button type="button"><a href="index.php">Home</a></button>
    <button type="button" class="btn btn-info btn-lg btn-success"><a href="stats.php">Daily Stats</a></button>
      <button type="button" style="background-color:#093 !important" class="btn btn-info btn-lg btn-success" data-toggle="modal" data-target="#myModal">Add New Member</button>
	<!-- InstanceBeginEditable name="EditRegion4" -->
   
     	<!-- InstanceEndEditable -->
    </div><!-- /content wrapper for padding -->
  </div><!-- /defaultpanel -->
</div>
 
   <!-- defaultpanel  -->

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
              <div class="modal-content">
                    <div class="modal-body">
                        <div style="height:210px">
                          <iframe src="add_member.php" width="100%" height="200px" frameborder="0"></iframe>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" onclick="javascript:window.location.reload()" class="close" data-dismiss="modal" aria-hidden="true">          Close</button>
                   </div>
              </div>
         </div>
    </div>
 
    
<!-- InstanceBeginEditable name="EditRegion6" -->
  <!-- InstanceEndEditable -->  
     
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($stats);
?>
