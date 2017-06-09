<?php require_once('Connections/connection.php'); ?><?php
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
  $insertSQL = sprintf("INSERT INTO t_finance (root_id, purpose, `currency`, amount, cashier) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['root_id'], "int"),
                       GetSQLValueString($_POST['purpose'], "text"),
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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>

  <link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery-1.10.2.min.js"></script>
  <script src="js/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
<div data-role="page" id="page1">
<div data-role="header">
    <h1>HIM Finance Dashboard</h1>
  </div>
  <div role="main" class="ui-content">
    <form method="POST" name="form1" action="<?php echo $editFormAction; ?>">
       <div class="col-md-12">
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
               </select><br />
               
<input type="text" class="form-control input-lg" name="amount" value="" size="32" placeholder="-- ---"><br />
          <input type="hidden" name="cashier" value="Admin" size="32">
          
          <input type="hidden" name="root_id" value="<?php echo $row_DetailRS1['id']; ?>" size="32">
          <center><input type="submit" value="Save Transaction" class="btn btn-lg"></center>
      <input type="hidden" name="MM_insert" value="form1">
       <div><br /><button  class="btn btn-lg btn-primary"><a href="index.php">Home</a></button></div>
      </div>
    </form>
   
    
    </div>
</div><!-- /grid-a -->
    
</div>

</body>
</html><?php
mysql_free_result($DetailRS1);

mysql_free_result($purpose);

mysql_free_result($currency);
?>