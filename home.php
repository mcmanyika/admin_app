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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO users (fname, lname) VALUES (%s, %s)",
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['lname'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$maxRows_usr = 10;
$pageNum_usr = 0;
if (isset($_GET['pageNum_usr'])) {
  $pageNum_usr = $_GET['pageNum_usr'];
}
$startRow_usr = $pageNum_usr * $maxRows_usr;

mysql_select_db($database_connection, $connection);
$query_usr = "SELECT * FROM users ORDER BY id DESC";
$query_limit_usr = sprintf("%s LIMIT %d, %d", $query_usr, $startRow_usr, $maxRows_usr);
$usr = mysql_query($query_limit_usr, $connection) or die(mysql_error());
$row_usr = mysql_fetch_assoc($usr);

if (isset($_GET['totalRows_usr'])) {
  $totalRows_usr = $_GET['totalRows_usr'];
} else {
  $all_usr = mysql_query($query_usr);
  $totalRows_usr = mysql_num_rows($all_usr);
}
$totalPages_usr = ceil($totalRows_usr/$maxRows_usr)-1;

$queryString_usr = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_usr") == false && 
        stristr($param, "totalRows_usr") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_usr = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_usr = sprintf("&totalRows_usr=%d%s", $totalRows_usr, $queryString_usr);
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
</head>
<body>
 
<div data-role="page" id="page1">
  <div data-role="header">
    <h1>HIM Finance Dashboard</h1>
  </div>
  <div role="main" class="ui-content">
  <div class="col-xs-12"><a href="#defaultpanel" data-role="button" data-inline="true" data-icon="bars">Browse Links</a>
<input type="text" class="form-control input-lg" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
  
    <table id="myTable" width="100%">
      <tr class="header">
        <th style="width:60%;">Name</th>
        <th style="width:40%;">Phone</th>
        </tr>
        
      <?php do { ?>
      <tr>
        <td style="text-transform:capitalize"><a href="pay.php?recordID=<?php echo $row_usr['id']; ?>"><?php echo $row_usr['fname']; ?> <?php echo $row_usr['lname']; ?></a></td>
        <td><a href="pay.php?recordID=<?php echo $row_usr['id']; ?>"><?php echo $row_usr['phone']; ?></a></td>
        </tr>
     
        <?php } while ($row_usr = mysql_fetch_assoc($usr)); ?>
    </table>
    <br>
    <table border="0">
      <tr>
        <td><?php if ($pageNum_usr > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_usr=%d%s", $currentPage, 0, $queryString_usr); ?>">First</a>
            <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_usr > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_usr=%d%s", $currentPage, max(0, $pageNum_usr - 1), $queryString_usr); ?>">Previous</a>
            <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_usr < $totalPages_usr) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_usr=%d%s", $currentPage, min($totalPages_usr, $pageNum_usr + 1), $queryString_usr); ?>">Next</a>
            <?php } // Show if not last page ?></td>
        <td><?php if ($pageNum_usr < $totalPages_usr) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_usr=%d%s", $currentPage, $totalPages_usr, $queryString_usr); ?>">Last</a>
            <?php } // Show if not last page ?></td>
      </tr>
    </table>
Records <?php echo ($startRow_usr + 1) ?> to <?php echo min($startRow_usr + $maxRows_usr, $totalRows_usr) ?> of <?php echo $totalRows_usr ?> 
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>


</div><!-- /grid-a -->
    
  </div>
  
  
  <div data-role="panel" id="defaultpanel" data-theme="b">
    <div class="panel-content">
      <h1><button type="button" style="background-color:#093 !important" class="btn btn-info btn-lg btn-success" data-toggle="modal" data-target="#myModal">Add New Member</button></h1>
     	
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
        <button type="button" onclick="javascript:window.location.reload()" class="close" data-dismiss="modal" aria-hidden="true">Close</button>
          
       </div>
      </div>
     </div>
    </div> 
</body>
</html>
<?php
mysql_free_result($usr);
?>
