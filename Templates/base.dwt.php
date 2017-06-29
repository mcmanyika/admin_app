<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- TemplateBeginEditable name="doctitle" -->
<title>HIM Finance Dashboard</title>
<!-- TemplateEndEditable -->
<link rel="stylesheet" href="../css/jquery.mobile-1.4.5.min.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.10.2.min.js"></script>
<script src="../js/jquery.mobile-1.4.5.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
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
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<!-- TemplateParam name="OptionalRegion1" type="boolean" value="true" -->
<!-- TemplateParam name="OptionalRegion2" type="boolean" value="true" -->
<!-- TemplateParam name="OptionalRegion3" type="boolean" value="true" -->
</head>
<body>
 
<div data-role="page" id="page1">
  <div data-role="header">
    <h1><a href="../index.php" data-role="button"  data-inline="true" data-icon="home" data-transition="flip" style="text-transform:capitalize">HIM Finance Dashboard</a></h1>
  </div>
  <div role="main" class="ui-content">
  <div class="col-xs-12"><!-- TemplateBeginIf cond="OptionalRegion2" --><!-- TemplateBeginEditable name="EditRegion5" -->
  
  <a href="#defaultpanel" data-role="button" data-inline="true" data-icon="bars">Browse Links</a>
  <!-- TemplateEndEditable --><!-- TemplateEndIf -->
  
  <!-- TemplateBeginEditable name="container" -->
  
  <!-- TemplateEndEditable -->
 
  </div><!-- /grid-a -->
    
  </div>
  
  
  <div data-role="panel" id="defaultpanel" data-theme="b">
    <div class="panel-content">
    <button type="button"><a href="../index.php">Home</a></button>
    <button type="button" class="btn btn-info btn-lg btn-success"><a href="../stats.php">Daily Stats</a></button>
      <button type="button" style="background-color:#093 !important" class="btn btn-info btn-lg btn-success" data-toggle="modal" data-target="#myModal">Add New Member</button>
	<!-- TemplateBeginIf cond="OptionalRegion1" --><!-- TemplateBeginEditable name="EditRegion4" -->
    
     	<!-- TemplateEndEditable --><!-- TemplateEndIf -->
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
                          <iframe src="../add_member.php" width="100%" height="200px" frameborder="0"></iframe>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" onclick="javascript:window.location.reload()" class="close" data-dismiss="modal" aria-hidden="true">          Close</button>
                   </div>
              </div>
         </div>
    </div>
 
    
<!-- TemplateBeginIf cond="OptionalRegion3" --><!-- TemplateBeginEditable name="EditRegion6" -->

  <!-- TemplateEndEditable --><!-- TemplateEndIf -->  
     
</body>
</html>