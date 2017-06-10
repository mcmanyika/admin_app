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

$maxRows_payments = 20;
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
$query_payments = sprintf("SELECT * FROM t_finance WHERE root_id = %s ORDER BY id DESC", GetSQLValueString($colname_payments, "int"));
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

$maxRows_payments = 20;
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
$query_payments = sprintf("SELECT * FROM t_finance WHERE root_id = %s ORDER BY id DESC", GetSQLValueString($colname_payments, "int"));
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

$colname_rcpt = "-1";
if (isset($_GET['recordID'])) {
  $colname_rcpt = $_GET['recordID'];
}
mysql_select_db($database_connection, $connection);
$query_rcpt = sprintf("SELECT * FROM t_finance WHERE root_id = %s ORDER BY id DESC", GetSQLValueString($colname_rcpt, "int"));
$rcpt = mysql_query($query_rcpt, $connection) or die(mysql_error());
$row_rcpt = mysql_fetch_assoc($rcpt);
$totalRows_rcpt = mysql_num_rows($rcpt);
?><!doctype html>
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
    <h1>HIM Finance Dashboard</h1>
  </div>
  <div role="main" class="ui-content">
  <div class="col-xs-12"><!-- InstanceBeginEditable name="EditRegion5" -->
   <div class="col-md-12">
      	<a href="#defaultpanel" data-role="button" data-inline="true" data-icon="bars" style="text-transform:capitalize"><?php echo $row_DetailRS1['fname']; ?> <?php echo $row_DetailRS1['lname']; ?></a>
        </div>
  <!-- InstanceEndEditable -->
  
  <!-- InstanceBeginEditable name="container" -->
    
    <form method="POST" name="form1" action="<?php echo $editFormAction; ?>">
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
               </select><br />
               
<input type="text" class="form-control input-lg" name="amount" value="" size="32" placeholder="-- ---"><br />
          <input type="hidden" name="cashier" value="Admin" size="32">
          
          <input type="hidden" name="root_id" value="<?php echo $row_DetailRS1['id']; ?>" size="32">
          
          <div class="col-md-12">
              <div class="col-md-6"><input type="submit" value="Save Transaction" onclick="javascript:window.location.reload()" class="btn btn-lg"></div>
              <div class="col-md-6">
              <button type="button" style="background-color:#093 !important" class="btn-lg" data-toggle="modal" data-target="#myReceipt">Print</button>
              </div>
          </div>
      <input type="hidden" name="MM_insert" value="form1">
       
      </div>
    </form>
   <div class="col-md-6">
       <div class="col-sm-12">
        <h4>Previous Payments </h4>
        </div>
   		<?php do { ?>
   		  <div class="col-sm-4">
   		    <?php echo $row_payments['purpose']; ?>
	      </div>
          <div class="col-sm-1">
   		   <strong><?php echo $row_payments['currency']; ?></strong>
	      </div>
          <div class="col-sm-2">
   		   <?php echo $row_payments['amount']; ?>
	      </div>
          <div class="col-sm-5">
   		    <?php echo $row_payments['date']; ?>
	      </div>
   		  <?php } while ($row_payments = mysql_fetch_assoc($payments)); ?>    
   </div> 
 
    
 
  
<!-- InstanceEndEditable -->
 
  </div><!-- /grid-a -->
    
  </div>
  
  
  <div data-role="panel" id="defaultpanel" data-theme="b">
    <div class="panel-content">
	<!-- InstanceBeginEditable name="EditRegion4" -->
    <button type="button"><a href="index.php">Home</a></button>
      <button type="button" style="background-color:#093 !important" class="btn btn-info btn-lg btn-success" data-toggle="modal" data-target="#myModal">Add New Member</button>
      
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

 <div class="modal fade" id="myReceipt" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
              <div class="modal-content">
                    <div class="modal-body">
                        <div style="height:280px"><center>
                        <div class="col-md-12">
                        <img src="img/logo.png" width="140" height="100"> <br />
                        <p>02 Sandy lane, Ashdown Park, Harare</p>
                        
                        <p>
                        Thank you <?php echo $row_DetailRS1['fname']; ?> <?php echo $row_DetailRS1['lname']; ?><br />
                        for your <?php echo $row_rcpt['purpose']; ?> of <br /><strong><br />
						 <?php echo $row_rcpt['currency']; ?> <?php echo $row_rcpt['amount']; ?>
                         </strong>
                         </p>
                         <p>May our God richly Bless you.<br />
                         NaJesu Zvinoita, naJesu Tinoenda Kure!!<br />
                         www.heartfeltonline.org
                         </p>
                        </div></center>
                      </div>
                    </div>
                    <div class="modal-footer"><center>
                      <button type="button" onclick="javascript:window.location.reload()" class="close" data-dismiss="modal" aria-hidden="true">          Close</button></center>
                   </div>
              </div>
         </div>
    </div>  
  
  <!-- InstanceEndEditable -->  
     
</body>
<!-- InstanceEnd --></html><?php
mysql_free_result($DetailRS1);

mysql_free_result($purpose);

mysql_free_result($currency);

mysql_free_result($payments);

mysql_free_result($rcpt);
?>