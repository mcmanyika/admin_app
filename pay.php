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
?>
<?php
$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}
mysql_select_db($database_connection, $connection);
$query_DetailRS1 = sprintf("SELECT * FROM users WHERE id = %s", GetSQLValueString($colname_DetailRS1, "int"));
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $connection) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;
?>

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO t_finance (root_id, flag, purpose, pay_option, `currency`, amount, cashier) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['root_id'], "int"),
					   GetSQLValueString($_POST['flag'], "text"),
                       GetSQLValueString($_POST['purpose'], "text"),
					   GetSQLValueString($_POST['pay_option'], "text"),
                       GetSQLValueString($_POST['currency'], "text"),
                       GetSQLValueString($_POST['amount'], "int"),
                       GetSQLValueString($_POST['cashier'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());

  $insertGoTo = "pay.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO t_pmFlag (id) VALUES (%s)",
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}

$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}
mysql_select_db($database_connection, $connection);
$query_DetailRS1 = sprintf("SELECT * FROM users WHERE id = %s", GetSQLValueString($colname_DetailRS1, "int"));
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $connection) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;

$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}
mysql_select_db($database_connection, $connection);
$query_DetailRS1 = sprintf("SELECT * FROM users WHERE id = %s", GetSQLValueString($colname_DetailRS1, "int"));
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $connection) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;

mysql_select_db($database_connection, $connection);
$query_purpose = "SELECT purpose FROM t_purpose";
$purpose = mysql_query($query_purpose, $connection) or die(mysql_error());
$row_purpose = mysql_fetch_assoc($purpose);
$totalRows_purpose = mysql_num_rows($purpose);

mysql_select_db($database_connection, $connection);
$query_currency = "SELECT * FROM t_dict WHERE category = 'currency'";
$currency = mysql_query($query_currency, $connection) or die(mysql_error());
$row_currency = mysql_fetch_assoc($currency);
$totalRows_currency = mysql_num_rows($currency);

$maxRows_payments = 5;
$pageNum_payments = 0;
if (isset($_GET['pageNum_payments'])) {
  $pageNum_payments = $_GET['pageNum_payments'];
}
$startRow_payments = $pageNum_payments * $maxRows_payments;

$colname_payments = "-1";
if (isset($_GET['recordID'])) {
  $colname_payments = $_GET['recordID'];
}
mysql_select_db($database_connection, $connection);
$query_payments = sprintf("SELECT id, root_id, flag, purpose, pay_option, currency, amount,   extract(year FROM date) as year, extract(month from date) as month, extract(day from date) as day, date FROM t_finance WHERE root_id = %s ORDER BY id DESC", GetSQLValueString($colname_payments, "int"));
$query_limit_payments = sprintf("%s LIMIT %d, %d", $query_payments, $startRow_payments, $maxRows_payments);
$payments = mysql_query($query_limit_payments, $connection) or die(mysql_error());
$row_payments = mysql_fetch_assoc($payments);

if (isset($_GET['totalRows_payments'])) {
  $totalRows_payments = $_GET['totalRows_payments'];
} else {
  $all_payments = mysql_query($query_payments);
  $totalRows_payments = mysql_num_rows($all_payments);
}
$totalPages_payments = ceil($totalRows_payments/$maxRows_payments)-1;

mysql_select_db($database_connection, $connection);
$query_pay_op = "SELECT * FROM t_dict WHERE category = 'pay_options'";
$pay_op = mysql_query($query_pay_op, $connection) or die(mysql_error());
$row_pay_op = mysql_fetch_assoc($pay_op);
$totalRows_pay_op = mysql_num_rows($pay_op);

mysql_select_db($database_connection, $connection);
$query_flag = "SELECT id FROM t_pmFlag ORDER BY id DESC";
$flag = mysql_query($query_flag, $connection) or die(mysql_error());
$row_flag = mysql_fetch_assoc($flag);
$totalRows_flag = mysql_num_rows($flag);

$maxRows_rcpt = 1;
$pageNum_rcpt = 0;
if (isset($_GET['pageNum_rcpt'])) {
  $pageNum_rcpt = $_GET['pageNum_rcpt'];
}
$startRow_rcpt = $pageNum_rcpt * $maxRows_rcpt;

$colname_rcpt = "-1";
if (isset($_GET['recordID'])) {
  $colname_rcpt = $_GET['recordID'];
}
mysql_select_db($database_connection, $connection);
$query_rcpt = sprintf("SELECT * FROM rcpt WHERE user_id = %s ORDER BY flag DESC", GetSQLValueString($colname_rcpt, "int"));
$query_limit_rcpt = sprintf("%s LIMIT %d, %d", $query_rcpt, $startRow_rcpt, $maxRows_rcpt);
$rcpt = mysql_query($query_limit_rcpt, $connection) or die(mysql_error());
$row_rcpt = mysql_fetch_assoc($rcpt);

if (isset($_GET['totalRows_rcpt'])) {
  $totalRows_rcpt = $_GET['totalRows_rcpt'];
} else {
  $all_rcpt = mysql_query($query_rcpt);
  $totalRows_rcpt = mysql_num_rows($all_rcpt);
}
$totalPages_rcpt = ceil($totalRows_rcpt/$maxRows_rcpt)-1;


$colname_p_entries = "-1";
if (isset($_GET['recordID'])) {
  $colname_p_entries = $_GET['recordID'];
}
mysql_select_db($database_connection, $connection);
$query_p_entries = sprintf("SELECT * FROM rcpt WHERE user_id = %s  ORDER BY user_id DESC", GetSQLValueString($colname_p_entries, "int"));
$p_entries = mysql_query($query_p_entries, $connection) or die(mysql_error());
$row_p_entries = mysql_fetch_assoc($p_entries);
$totalRows_p_entries = mysql_num_rows($p_entries);
?><!doctype html>
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
.cal {
	width:100px;
	height:60px;
	font-size:30;
	border-radius:8px;
	margin:3px;
	}
</style>
<style id="inset-tablist">
		.tablist-left {
			width: 25%;
			display: inline-block;
		}
		.tablist-content {
			width: 60%;
			display: inline-block;
			vertical-align: top;
			margin-left: 5%;
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
 
<div data-role="page" id="page1">
  <div data-role="header">
    <h1><a href="index.php" data-role="button" data-transition="flip"  data-inline="true" data-icon="home" style="text-transform:capitalize">HIM Finance Dashboard</a></h1>
  </div>
  <div role="main" class="ui-content">
  <div class="col-xs-12">
  
  <form method="post" id="form2" name="form2" action="<?php echo $editFormAction; ?>">
  <div class="col-md-12">
  	<div class="col-md-6">
        <input type="hidden" name="id">
        <button type="submit" data-inline="true" data-icon="action" style="background-color:#093; color:#fff !important">Click to Make Payment</button>
        <input type="hidden" name="MM_insert" value="form2">
     </div>
     <div class="col-md-3">
     	<div class="col-md-12">
     <button type="button" onClick="window.location.reload();" data-icon="refresh">Refresh Page</button>
     </div>
     </div>
     </div>   
        </form>
        <div class="col-md-12">
      <form method="POST" id="form1" name="form1" action="<?php echo $editFormAction; ?>">
            
              <div class="col-md-6">
                    <select name="purpose">
                      <?php do { ?>
                      <option value="<?php echo $row_purpose['purpose']; ?>"><?php echo $row_purpose['purpose']; ?></option>
                      <?php } while ($row_purpose = mysql_fetch_assoc($purpose)); ?>
                      </select>
                    <br />
                    
                    <select name="currency">
                      <?php do { ?>
                      <option value="<?php echo $row_currency['name']; ?>"><?php echo $row_currency['name']; ?></option>
                      <?php } while ($row_currency = mysql_fetch_assoc($currency)); ?>
                      </select>
                    <br />
                    <select name="pay_option">
                    <?php do { ?>
                      <option value="<?php echo $row_pay_op['name']; ?>"><?php echo $row_pay_op['name']; ?></option>
                      <?php } while ($row_pay_op = mysql_fetch_assoc($pay_op)); ?>
                      </select>
                    
                    <div class="col-md-12" style="padding-top:40px;">
                    <input type="hidden" name="cashier" value="Admin" size="32">
                    <input type="hidden" name="flag" value="<?php echo $row_flag['id']; ?>">
                    
                    <input type="hidden" name="root_id" value="<?php echo $row_DetailRS1['id']; ?>" size="32">
                    </div>
                    
                  </div>
                <div class="col-md-6">
                <style>
                .cal {
                width:115px;
                height:50px;
                font-size:60;
                border-radius:8px;
                margin:3px;
                }
            </style>
                  <div class="col-md-11">
                    <input type="text" class="form-control input-lg" name="amount" value=""  placeholder="0">
                    
                    <input type="button" value="7" onClick="document.form1.amount.value +='7'" class="cal"/>
                    <input type="button" value="8" onClick="document.form1.amount.value +='8'" class="cal"/>
                    <input type="button" value="9" onClick="document.form1.amount.value +='9'" class="cal"/>
                    <br />
                    <input type="button" value="4" onClick="document.form1.amount.value +='4'" class="cal"/>
                    <input type="button" value="5" onClick="document.form1.amount.value +='5'" class="cal"/>
                    <input type="button" value="6" onClick="document.form1.amount.value +='6'" class="cal"/>
                    <br />
                    <input type="button" value="1" onClick="document.form1.amount.value +='1'" class="cal"/>
                    <input type="button" value="2" onClick="document.form1.amount.value +='2'" class="cal"/>
                    <input type="button" value="3" onClick="document.form1.amount.value +='3'" class="cal"/>
                    <br />
                    <input type="button" value="0" onClick="document.form1.amount.value +='0'" class="cal"/>
                    <input type="button" value="C" onClick="btnclear()" class="cal" style="width:240px;"/>
                    <br />
                    <input type="submit" value="Enter" onclick="javascript:window.location.reload()" class="cal btn btn-lg" style="width:177px">
                    <a href="#myReceipt"  data-toggle="modal"><input type="button" value="Print" class="cal btn btn-lg" style="width:177px"></a>
                  
                  <script>
                    function btnclear() {
                        document.form1.amount.value ="";
                        document.form1.amount.style.textAlign="left";
                        }
                  </script>
                  </div>
                  
                  
                  </div> 
                  <input type="hidden" name="MM_insert" value="form1">
        
      
</div>
</form>
  </div><!-- /grid-a -->
  
  </div>
  
  
  <div data-role="panel" id="defaultpanel" data-theme="b">
    <div class="panel-content">
    <button type="button"><a href="index.php">Home</a></button>
    <button type="button" class="btn btn-info btn-lg btn-success"><a href="stats.php">Daily Stats</a></button>
      <button type="button" style="background-color:#093 !important" class="btn btn-info btn-lg btn-success" data-toggle="modal" data-target="#myModal">Add New Member</button>
</div><!-- /content wrapper for padding -->
  </div><!-- /defaultpanel -->
</div>
 
   <!-- defaultpanel  -->

<!-- Modal -->
<div class="modal fade" id="myReceipt" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
              <div class="modal-content">
                    <div class="modal-body">
                             <iframe src="receipt.php?recordID=<?php do { ?><?php echo $row_rcpt['flag']; ?><?php } while ($row_rcpt = mysql_fetch_assoc($rcpt)); ?>" frameborder="0" height="400" width="100%"></iframe>
                   
                    <div class="modal-footer">
                      <button type="button" onclick="javascript:window.location.reload()" class="close" data-dismiss="modal" aria-hidden="true">          Close</button>
                   </div>
              </div>
         </div>
    </div>


</body>
</html><?php
mysql_free_result($DetailRS1);

mysql_free_result($purpose);

mysql_free_result($currency);

mysql_free_result($payments);

mysql_free_result($pay_op);

mysql_free_result($flag);

mysql_free_result($rcpt);

mysql_free_result($p_entries);
?>