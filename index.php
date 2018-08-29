<html>
<head>
	<title>
	Uncomplicated Firewall(UFW) web gui using php
	</title>
</head>
<body>
<center>Uncomplicated Firewall(UFW) gui</center>
<form action="" method="post" name="ban">
Enter IP : <input type="text" name="banip"> 
<input type="submit" value="ban"> Eg. : 192.168.0.10 or 192.168.0.0/16
</form>

<form action="" method="post" name="unban">
Enter IP : <input type="text" name="unbanip"> 
<input type="submit" value="Unban"> Eg. : 192.168.0.10 or 192.168.0.0/16
</form>
</body>
</html>
<?php
if (isset($_POST["banip"]))
	{
	$banip = $_POST["banip"];
	echo "Banned IP=".$banip;
	$output = shell_exec('sudo ufw insert 1 deny from '.$banip);
	echo $output;
	}
?>

<?php
if (isset($_POST["unbanip"]))
	{
	$unbanip = $_POST["unbanip"];
	echo "Unbanned IP=".$unbanip;
	$output = shell_exec('sudo ufw allow from '.$unbanip);
	echo $output."<br>";
	}
?>
<?php

echo "Deny IP List/Port";
$output = shell_exec("sudo ufw status | grep DENY | awk '{print $3}'");
echo "<pre>".$output."</pre>"

?>

<?php

echo "Allow IP List/Port";
$output = shell_exec("sudo ufw status | grep ALLOW | awk '{print $1,$2,$3}'");
echo "<pre>".$output."</pre>";

?>