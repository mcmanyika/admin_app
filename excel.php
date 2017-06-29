	
<!DOCTYPE html>
<html>
   <head>
      <title>table2excel</title>
      
<script src="js/jquery.mobile-1.4.5.min.js"></script>
<script src="js/bootstrap.min.js"></script>
   </head>
   <body>
      <div clas="tableholder">
         <table id="MyTable2export" border="1" cellpadding="5">
            <tr>
               <th>Heading 1</th>
            </tr>
            <tr>
               <td>Row</td>
             </tr> 
         </table>
         <button id="donwload">Download</button>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
      <script src="js/jquery.table2excel.js"></script>
      <script>
      	// button click
      	$('#donwload').on('click',function(){
      		// get the table id
      		$("#MyTable2export").table2excel();
      	});
      </script>
   </body>
</html>