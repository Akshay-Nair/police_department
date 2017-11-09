<?php
$conn=mysqli_connect("localhost","root","","pdept");
if(!$conn)
	die("connection failed");
if(isset($_POST['citizen'])==TRUE)
{
$user=$_POST['cId'];
$p=$_POST['pass1'];
$query="select count(*) as num from citizen where cId='$user' AND pass='$p'";
$result=mysqli_query($conn,$query);	
if($result->fetch_assoc()["num"]==0)
{
	echo "<script>alert(\"You Entered Incorrect Credentials\")</script>";
}
else
{
	$cid=$_POST['cId'];
	header("Location: clogin.php?cId=$cid");
	exit();
}
}
else if(isset($_POST['police'])==TRUE)
{
$user=$_POST['pId'];
$p=$_POST['pass2'];
$query="select count(*) as num from police where pId='$user' AND pass='$p'";
$result=mysqli_query($conn,$query);	
if($result->fetch_assoc()["num"]==0)
{
	echo "<script>alert(\"You Entered Incorrect Credentials\")</script>";
}
else
{
	$pid=$_POST['pId'];
	header("Location: plogin.php?pId=$pid");
	exit();
}
}

?>
<html>
<body>
<style>
fieldset {
	margin-left:70;
	border: 0;
}
div{
	width: 10;
    height: 10;
    overflow: scroll;
};
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
<p align="center"><b><font size="6">Welcome to website of Jalandhar Police Department</font></b></p><br><br><br>
<script>space(100)</script><b>Citizen Login</b><script>space(100)</script><b>Police Login</b>
<script>space(10);</script><table>
<tr>
<td>
<form  method="post">
<fieldset>
<script>space(60);</script>ID :<script>space(2);</script><input name="cId" type="text"><br><br>
<script>space(50);</script>Password:&nbsp&nbsp<input name="pass1" type="text"><br><br>
<script>space(80);</script><input type="submit" name="citizen"><br><br>
<script>space(78);</script><a href="nlogin.php">New User?</a>
</fieldset>
</form>
<td>
<form  method="post">
<fieldset>
<script>space(50);</script>ID :<script>space(3);</script><input name="pId" type="text"><br><br>
<script>space(40)</script>Password:<script>space(3);</script><input type="text" name="pass2"><br><br>
<script>space(70)</script><input type="submit" name="police">
<br>
<br>
<br>
</fieldset>
</form>
</td>
</td>
</tr>
</table>
<br>
<br>
<p align="center" ><font size="4"><b>Announcements</b></font><p>
<marquee> <?php $query="select * from announcement";
$result=mysqli_query($conn,$query);
if(!$result)
{
	
}
else
{
	$s='';
	while($detail=$result->fetch_assoc())
	{
		$s.=$detail["announcement"]."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
	}
	echo $s;
}?></marquee>
<br>
<br>
<br>
<script>space(80);</script>
<b>Lost and found Items</b>
<script>space(120);</script>
<b>Wanted</b><br><br>
<script>space(80);</script>
<table>
<tr>
<td><script>space(78);</script></td>
<td>
<textarea readonly rows="10" cols="20" id="lost">
<?php
$query="select * from found";
$result=mysqli_query($conn,$query);
if(!$result)
{
	
}
else
{
	while($detail=$result->fetch_assoc())
	{
		echo $detail["found"]."\n";
	}
}
?>
</textarea>
</td>
<td><script>space(110);</script></td>
<td>
<textarea readonly rows="10" cols="20" id="wanted">
<?php
$query="select * from wanted";
$result=mysqli_query($conn,$query);
if(!$result)
{
	
}
else
{
	while($detail=$result->fetch_assoc())
	{
		echo $detail["name"]."\n";
	}
}
?>
</textarea>
</td>
</tr>
<table>
<br><br><br>
<fieldset align="center">
<b>Helpline Number</b>
<br>
<br>
64345123<br>
09546854<br>
23525847<br>
09586347<br>
<fieldset>
</body>
</html>
