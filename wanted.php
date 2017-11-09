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
if(isset($_POST['add'])==TRUE)
{
	if(strlen($_POST['name'])>0)
	{
		$a=$_POST['name'];
		$query="insert into wanted values('$a')";
		$result=mysqli_query($conn,$query);
		if(!$result)
		{
			die("Announcement could not be inserted");
		}
		header("location: plogin.php?pId=$user");
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
<form method="post">
<fieldset>
<input type="hidden" name="pId" value="<?php echo $user; ?>">
Enter the new wanted list name :&nbsp&nbsp&nbsp <input type="text" name="name" size="50" maxlength="30"><br><br>
<script>space(95);</script><input type="submit" name="add">
</fieldset>
</form>
</body>
</html>