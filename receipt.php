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

$colname_rcpt = "-1";
if (isset($_GET['recordID'])) {
  $colname_rcpt = $_GET['recordID'];
}
mysql_select_db($database_connection, $connection);
$query_rcpt = sprintf("SELECT * FROM rcpt WHERE flag = %s ORDER BY flag DESC", GetSQLValueString($colname_rcpt, "text"));
$rcpt = mysql_query($query_rcpt, $connection) or die(mysql_error());
$row_rcpt = mysql_fetch_assoc($rcpt);
$totalRows_rcpt = mysql_num_rows($rcpt);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>HIM Finance Dashboard</title>
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
<script>
function printContent (el) {
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}

</script>

</head>
<body>
 <div class="col-md-6">
      <button  type="button" onclick="printContent('div1')" class="btn btn-lg">Print Receipt</button>
  
<div id="div1" class="col-md-12" style="text-align:center">
    <center>
    <img src="img/logo.png" width="140" height="100"> </center>
    <p style="text-align:center">02 Sandy lane, Ashdown Park, Harare</p>
    
    <p style="text-align:center; text-transform:capitalize">
    Thank you <strong><?php echo $row_rcpt['fname']; ?> <?php echo $row_rcpt['lname']; ?></strong><br /> for your payment<br />
    <?php do { ?>
    <div><center>
        
      <?php echo $row_rcpt['purpose']; ?> : <?php echo $row_rcpt['currency']; ?> <?php echo $row_rcpt['amount']; ?>
        </center>
    </div>
    <?php } while ($row_rcpt = mysql_fetch_assoc($rcpt)); ?>
 
</p>
     <p style="text-align:center">May our God richly Bless you.<br />
     NaJesu Zvinoita, naJesu Tinoenda Kure!!<br />
     www.heartfeltonline.org
     </p>
     
  </div>
    
 
</body>
</html>
<?php
mysql_free_result($rcpt);
?>
