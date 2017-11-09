<?php
$user=$_POST['cId'];
if(isset($_POST["s1"])==TRUE)
{
	if(strlen($_POST["sub"])>0 && strlen($_POST["desc"])>0)
	{
		$conn=mysqli_connect("localhost","root","","pdept");
		if(!$conn)
		{
			die("Database connection failed");
		}
		$cid=$_POST["cId"];
		$sub=$_POST["sub"];
		$des=$_POST["desc"];
		
		$query="insert into fir values('$cid','$sub','$des','open')";
		$result=mysqli_query($conn,$query);
		if(!$result)
		{
			die("value could not be inserted");
		}
		header("location: clogin.php?cId=$cid");
	}
	else
	{
			echo "<script>alert(\"Fill all the fields\");</script>";
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
<script>space(10);</script>Subject(max 78):<script>space(4);</script><input type="text" name="sub" size="78" maxlength="78"><br><br><br>
<table>
<tr>
<td>
Description(max 180):
<script>line(21);</script>
</td>
<td>
<script>space(1);</script>
<textarea name="desc" rows="25" cols="80" maxlength="180"></textarea>
</td>
</tr>
</table>
<br>
<script>space(105);</script>
<input type="submit" name="s1">
</fieldset>
</form>
</body>
</html>