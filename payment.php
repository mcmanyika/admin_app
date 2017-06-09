<?php
$maxRows_DetailRS2 = 10;
$pageNum_DetailRS2 = 0;
if (isset($_GET['pageNum_DetailRS2'])) {
  $pageNum_DetailRS2 = $_GET['pageNum_DetailRS2'];
}
$startRow_DetailRS2 = $pageNum_DetailRS2 * $maxRows_DetailRS2;

$colname_DetailRS2 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS2 = $_GET['recordID'];
}
mysql_select_db($database_connection, $connection);
$query_DetailRS2 = sprintf("SELECT * FROM users WHERE id = %s", GetSQLValueString($colname_DetailRS2, "int"));
$query_limit_DetailRS2 = sprintf("%s LIMIT %d, %d", $query_DetailRS2, $startRow_DetailRS2, $maxRows_DetailRS2);
$DetailRS2 = mysql_query($query_limit_DetailRS2, $connection) or die(mysql_error());
$row_DetailRS2 = mysql_fetch_assoc($DetailRS2);

if (isset($_GET['totalRows_DetailRS2'])) {
  $totalRows_DetailRS2 = $_GET['totalRows_DetailRS2'];
} else {
  $all_DetailRS2 = mysql_query($query_DetailRS2);
  $totalRows_DetailRS2 = mysql_num_rows($all_DetailRS2);
}
$totalPages_DetailRS2 = ceil($totalRows_DetailRS2/$maxRows_DetailRS2)-1;
?><?php require_once('Connections/connection.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO t_finance (root_id, receipt_no, purpose, amount, cashier) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['root_id'], "int"),
                       GetSQLValueString($_POST['receipt_no'], "int"),
                       GetSQLValueString($_POST['purpose'], "text"),
                       GetSQLValueString($_POST['amount'], "int"),
                       GetSQLValueString($_POST['cashier'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_connection, $connection);
$query_fin = "SELECT * FROM t_finance";
$fin = mysql_query($query_fin, $connection) or die(mysql_error());
$row_fin = mysql_fetch_assoc($fin);
$totalRows_fin = mysql_num_rows($fin);

mysql_select_db($database_connection, $connection);
$query_purpose = "SELECT purpose FROM t_purpose";
$purpose = mysql_query($query_purpose, $connection) or die(mysql_error());
$row_purpose = mysql_fetch_assoc($purpose);
$totalRows_purpose = mysql_num_rows($purpose);
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
</head>
<body>
 
<div data-role="page" id="page1">

  <div role="main" class="ui-content">
    <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
       <div class="col-md-10">
          <input type="text" class="form-control input-lg" name="receipt_no" value="" size="32" placeholder="Receipt Number"><br />
          
            <select name="purpose">
            <?php do { ?>
              <option><?php echo $row_purpose['purpose']; ?></option>
              <?php } while ($row_purpose = mysql_fetch_assoc($purpose)); ?>
            </select>
            <br />
          <input type="text" class="form-control input-lg" name="amount" value="" size="32" placeholder="-- ---"><br />
          <input type="hidden" name="cashier" value="Admin" size="32">
          
          <input type="text" name="root_id" value="<?php echo $row_DetailRS2['id']; ?>" size="32">
          <input type="submit" value="Save Transaction">
      <input type="hidden" name="MM_insert" value="form1">
      </div>
    </form>
    <p>&nbsp;</p>
</div><!-- /grid-a -->
    
</div>
		
<table border="1" align="center">
  
  <tr>
    <td>id</td>
    <td> </td>
  </tr>
  <tr>
    <td>username</td>
    <td><?php echo $row_DetailRS2['username']; ?> </td>
  </tr>
  <tr>
    <td>password</td>
    <td><?php echo $row_DetailRS2['password']; ?> </td>
  </tr>
  <tr>
    <td>fname</td>
    <td><?php echo $row_DetailRS2['fname']; ?> </td>
  </tr>
  <tr>
    <td>lname</td>
    <td><?php echo $row_DetailRS2['lname']; ?> </td>
  </tr>
  <tr>
    <td>email</td>
    <td><?php echo $row_DetailRS2['email']; ?> </td>
  </tr>
  <tr>
    <td>phone</td>
    <td><?php echo $row_DetailRS2['phone']; ?> </td>
  </tr>
  <tr>
    <td>subscribe</td>
    <td><?php echo $row_DetailRS2['subscribe']; ?> </td>
  </tr>
  <tr>
    <td>date</td>
    <td><?php echo $row_DetailRS2['date']; ?> </td>
  </tr>
  
  
</table>

 
</body>
</html>
<?php
mysql_free_result($DetailRS2);

mysql_free_result($fin);

mysql_free_result($purpose);
?>
