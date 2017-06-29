<html>
<head>
<script language="javascript">
function Sum()
{
var num1,num2,res;
num1=document.getElementById("txtnum1").value;
num2=document.getElementById("txtnum2").value;
res=parseInt(num1)+parseInt(num2);
document.getElementById("txtres").value=res;
}

function Subtract()
{
var num1,num2,res;
num1=document.getElementById("txtnum1").value;
num2=document.getElementById("txtnum2").value;
res=num1-num2;
document.getElementById("txtres").value=res;
}



</script>
</head>
<body>
<table align="center">
<tr>
<td>Num1</td>
<td><input id="txtnum1" onChange="Sum()" /></td>
</tr>
<tr>
<td>Num2</td>
<td><input id="txtnum2" onChange="Sum()"  /></td>
</tr>
<tr>
<td>Result</td>
<td><input id="txtres" /></td>
</tr>

</table>
</body>
<html>