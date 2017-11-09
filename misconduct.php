<?php
$user=$_POST['cId'];
if(isset($_POST['s2'])==TRUE)
{
	if(strlen($_POST['pname'])>0 && strlen($_POST['cmp'])>0)
	{
		$conn=mysqli_connect("localhost","root","","pdept");
		if(!$conn)
		{
			die("Database connection failed");
		}
		$cid=$_POST["cId"];
		$pname=$_POST["pname"];
		$cmp=$_POST["cmp"];
		
		$query="insert into mis values('$cid','$pname','$cmp')";
		$result=mysqli_query($conn,$query);
		if(!$result)
		{
			die("value could not be inserted");
		}
		header("location: clogin.php?cId=$cid");
	}
	else
	{
		echo "<script> alert(\"Fill all the fields\") </script>";
	}
}
?>
<html>
<body>
<style>
fieldset.alpha{
margin-top:80;
margin-left:300;
border:0;
}
</style>
<script>
function space(n)
{
for(var i=0;i<n;++i)
document.write("&nbsp");
}
function line(n)
{
	for(var i=0;i<n;++i)
		document.write("<br>")
}
</script>
<form  method="post">
<fieldset class="alpha">
<input type="hidden" name="cId" value="<?php echo $user;?>">
<script>space(13);</script>Police Name:<script>space(4);</script><input type="text" name="pname" size="30" maxlength="30"><br><br><br>
<table>
<tr>
<td>
Description(max 80):
<script>line(21);</script>
</td>
<td>
<script>space(1);</script>
<textarea name="cmp" rows="25" cols="80" maxlength="80"></textarea>
</td>
</tr>
</table>
<br>
<script>space(105);</script>
<input type="submit" name="s2">
</fieldset>
</form>
</body>
</html>