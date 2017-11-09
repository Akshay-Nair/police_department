<?php
$conn=mysqli_connect("localhost","root","","pdept");
if(!$conn)
	die("Connection to database failed");
$user=$_GET['cId'];
$query="select count(*) as num from fir where cId='$user'";
$result=mysqli_query($conn,$query);
if(!$result)
{
	die("Connection with database failed");
}
$GLOBALS['fir_num']=$result->fetch_assoc()["num"];
$query="select count(*) as num from fir where cId='$user' and status='closed'";
$result=mysqli_query($conn,$query);
if(!$result)
	die("Connection with database failed");
$GLOBALS['fir_closed']=$result->fetch_assoc()["num"];
?>
<html>
<body>
<style>
fieldset.alpha{
	margin-left:100;
	border: 0;
}
fieldset.beta{
	margin-left:100;
	border:0;
}
</style>
<script>
function space(a)
{
 for(var i=0;i<a;++i)
 {
	document.write("&nbsp");
 }	
}
</script>
<br><br>
<fieldset class="alpha">
Number of FIR filed :<?php echo $GLOBALS['fir_num'];?><br>
Number of FIR closed:<?php echo $GLOBALS['fir_closed'];?><br>
</fieldset>
<br><br>
<script>space(10);</script>
<table>
<tr>
<td class="alpha">
<fieldset class="beta">
<form action="/fir.php" method="post">
<input type="hidden" name="cId" value="<?php echo $user; ?>">
<input type="submit" value="Register new FIR" style="width: 127px"><br><br>
</form>
<form action="misconduct.php" method="post">
<input type="hidden" value="<?php echo $user; ?>" name="cId">
<input type="submit" value="Report Misconduct"><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</form>
</fieldset>
</td>
<td>
<script>space(10);</script>
<fieldset class="alpha">
<b>FIR History</b><br>
<textarea readonly rows="25" cols="80"> 
<?php  
$conn=mysqli_connect("localhost","root","","pdept");
if(!$conn)
	die("Connection to database failed");
$user=$_GET['cId'];
$query="select * from fir where cId='$user'";
$result=mysqli_query($conn,$query);
if(!$result)
{
	die("Connection with database failed");
}
while($detail=$result->fetch_assoc())
{
	echo "subject : ".$detail["subject"]."                    status : ".$detail["status"]."\n";
}
?>
</textarea>
</fieldset>
</td>
</tr>
</table>
</body>
</html>