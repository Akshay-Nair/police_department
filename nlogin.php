<?php
if(isset($_POST["new"])==TRUE)
{
	$user=$_POST["cId"];
	$p=$_POST["pass"];
	$no=$_POST["pno"];
	$name=$_POST["name"];
	$conn=mysqli_connect("localhost","root","","pdept");
	if(!$conn)
		die("Connection failed");
	$query="select count(*) as num from citizen where cId='$user'";
	$result=mysqli_query($conn,$query);
	if($result->fetch_assoc()["num"]==0)
	{
		$query="insert into citizen values('$name','$p',$no,'$user')";
		$result=mysqli_query($conn,$query);
		if(!$result)
			die("query failed to execute");
		header("Location: clogin.php?cId=$user");
		exit();
	}
	else
	{
		echo "<script>alert(\"user already Exists\")</script>";
	}
}
?>
<html>
<body>
<style>
fieldset {
	margin-left:400;
	border: 0;
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
<br><br><br><br><br><script>space(115);</script><b><font size="6">New Citizen Sign Up</font></b>
<br><br><br>
<script>space(50);</script>
<form method="post">
<fieldset>
Enter the name :<script>space(19);</script><input type="text" name="name">
<br><br>
Enter Phone number :<script>space(10);</script><input type="number" name="pno">
<br><br>
Enter User Id :<script>space(21)</script><input type="text" name="cId">
<br><br>
Enter Password :<script>space(18)</script><input type="text" name="pass">
<br><br>
<script>space(55);</script><input type="submit" name="new">
</fieldset>
</form>
</body>
</html>