<?php
$conn=mysqli_connect("localhost","root","","pdept");
if(!$conn)
	die("Connection to database failed");
$user=$_GET['pId'];
$query="select count(*) as num from police where pId='$user'";
$result=mysqli_query($conn,$query);
if(!$result)
	die("error while accessing database");
if($result->fetch_assoc()["num"]<=0)
{
die("User does not exist");	
}
$query="select count(*) as num from fir";
$result=mysqli_query($conn,$query);
if(!$result)
{
	die("Connection with database failed");
}
$GLOBALS['fir_num']=$result->fetch_assoc()["num"];
$query="select count(*) as num from fir where status='open'";
$result=mysqli_query($conn,$query);
if(!$result)
	die("Connection with database failed");
$GLOBALS['fir_open']=$result->fetch_assoc()["num"];
$query="select count(*) as num from mis";
$result=mysqli_query($conn,$query);
if(!$result)
{
	die("data could not be fetched");
}
$GLOBALS['mis']=$result->fetch_assoc()["num"];
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
table.beta, th.beta, td.beta {
    border: 1px solid black;
}
</style>
<script type="text/javascript">
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
Number of FIR Open:<?php echo $GLOBALS['fir_open'];?><br>
</fieldset>
<br><br>
<script>space(10);</script>
<table>
<tr>
<td class="alpha">
<fieldset class="beta">
<form action="announcement.php" method="post">
<input type="hidden" name="pId" value="<?php echo $user;?>">
<input type="submit" value="Add new Announcement">
</form>
<br><br>
<form action="wanted.php" method="post">
<input type="hidden" name="pId" value="<?php echo $user;?>">
<input type="submit" value="Add new to Wanted List" style="width:162">
</form>
<br><br>
<form action="found.php" method="post">
<input type="hidden" name="pId" value="<?php echo $user;?>">
<input type="submit" value="Found and Lost List" style="width:162">
</form>
<br><br>
<form action="change.php" method="post">
<input type="hidden" name="pId" value="<?php echo $user;?>">
<input type="submit" value="Change fir status" style="width:162">
</form><br><br><br><br><br><br>	
</fieldset>
</td>
<td>
<script>space(10);</script>
<fieldset class="alpha">
<b>FIR</b><br>
<?php
$query="select fir.cId,name,subject,desp,status from fir inner join citizen on fir.cId=citizen.cId";
$result=mysqli_query($conn,$query);
if(!$result)
{
	
}
else
{
	echo"<table class=\"beta\" align=\"top\">";
	echo"<tr>";
	echo"<td class=\"beta\">";
	echo"Name";
	echo"</td>";
	echo"<td class=\"beta\">";
	echo"Subject";
	echo"</td>";
	echo"<td class=\"beta\">";
	echo"Status";
	echo"</td>";
	echo"</tr>";
	while($detail=$result->fetch_assoc())
	{
		
		$query="update fir set status='closed' where cId='".$detail['cId']."' and subject='".$detail['subject']."'";
		$desc=$detail['desp'];
		echo "<tr>";
		echo "<td class=\"beta\">";
		echo $detail['name'];
		echo "</td>";
		echo "<td class=\"beta\" onClick=\"alert('$desc');de;\">";
		echo $detail['subject'];
		echo "</td>";
		echo "<td class=\"beta\">";
		echo $detail['status'];
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
</fieldset>
</td>
<td>
<fieldset class="alpha">
<b>Misconduct Complaints</b><br>
<table class="beta">
<tr class="beta">
<th class="beta">
Poilice Name
</th>
<th class="beta">
Complaint
</th>
</tr>
<?php
$query="select * from mis";
$result=mysqli_query($conn,$query);
if(!$result)
{
	
}
else{
	while($d=$result->fetch_assoc())
	{
	echo"<tr class=\"beta\">";
	echo"<td class=\"beta\">";
	echo $d["pname"];
	echo"</td>";
	echo"<td class=\"beta\">";
	echo $d["cmp"];
	echo"</td>";
	echo"</tr>";
	}	
}
?>
<table>
</fieldset>
</td>
</tr>
</table>
</body>
</html>