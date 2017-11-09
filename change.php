<?php
$user=$_POST['pId'];
$conn=mysqli_connect("localhost","root","","pdept");
if(!$conn)
	die("connection with database failed");
$query="select count(*) as num from police where pid='$user'";
$result=mysqli_query($conn,$query);
if(!$result)
{
die("database connection error");
}
if($result->fetch_assoc()["num"]<=0)
{
die("user does not exist");
}
if(isset($_POST['close'])==TRUE)
{
	$query="update fir set status='closed' where cId='".$_POST['cId']."' and subject='".$_POST['subject']."'";
	$result=mysqli_query($conn,$query);
	if(!$result)
	{
		echo '<script>alert("status could not be changed");</script>';
	}
	else
	{
		echo '<script>alert("FIR status changed");</script>';
	}
}
?>
<html>
<body>
<style>
fieldset
{
	border:0;
	margin-top:100;
	margin-left:200;
}
table,th,td{
    border: 1px solid black;
}
td
{
	vertical-align:middle;
	text-align:center;
}
</style>
<script>
function space(n)
{
	for(var i=0;i<n;++i)
	{
		document.write("&nbsp");
	}
}
</script>
<fieldset>
<?php
$query="select fir.cId,name,subject,status from fir inner join citizen on fir.cId=citizen.cId and fir.status='open'";
$result=mysqli_query($conn,$query);
if(!$result)
{
}
else
{

echo'<table width="1000" height="80">';
echo"<tr>";
echo"<td>";
echo"Name";
echo"</td>";
echo"<td>";
echo"Subject";
echo"</td>";
echo"<td>";
echo"</td>";
echo"</tr>"	;
while($detail=$result->fetch_assoc())
{
echo "<tr>";
echo "<td>";
echo $detail['name'];
echo "</td>";
echo "<td>";
echo $detail['subject'];
echo "</td>";
echo '<td align="middle">';
echo '<form method="post">';
echo '<input type="submit" name="close" value="change">';
echo '<input type="hidden" name="cId" value="'.$detail["cId"].'">';
echo '<input type="hidden" name="pId" value="'.$_POST["pId"].'">';
echo '<input type="hidden" name="subject" value="'.$detail["subject"].'">';
echo "</form>";
echo "</td>";
echo "</tr>";
}
}
?>
</table>
</fieldset>
</body>
</html>