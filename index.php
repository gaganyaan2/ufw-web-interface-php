<html>
<head>
	<title>
	Uncomplicated Firewall(UFW) web gui using php
	</title>
</head>
<body>
<center>Uncomplicated Firewall(UFW) gui
</br>
<?php $output=shell_exec("sudo ufw status verbose | awk 'FNR == 1 {print}'"); echo $output; ?>
</br>
Default rule : <?php $output=shell_exec("sudo ufw status verbose | awk 'FNR == 3 {print $2 $3 $4 $5}'"); echo $output; ?>
</br>
</center>

<form action="" method="post" name="deny">
Enter IP : <input type="text" name="denyip"> 
<input type="submit" value="Deny"> Eg. : 192.168.0.10 or 192.168.0.0/16
</form>


<form action="" method="post" name="allow">
Enter IP : <input type="text" name="allowip"> 
<input type="submit" value="Allow"> Eg. : 192.168.0.10 or 192.168.0.0/16
</form>

</body>
</html>

<!--deny-->  
<?php
if (isset($_POST["denyip"]))
	{
	$denyip = $_POST["denyip"];
	$cleanip=str_replace(";","lol",$denyip);
	echo "Banned IP=".$cleanip." ";
	$output = shell_exec("sudo ufw -f insert 1 deny from ".$cleanip);
	echo $output;
	}
?>
<!--allow-->  
<?php
if (isset($_POST["allowip"]))
	{
	$allowip = $_POST["allowip"];
	$cleanip=str_replace(";","lol",$allowip);
	echo "Allow IP=".$allowip." ";
	$output = shell_exec("sudo ufw allow from ".$cleanip);
	echo $output."<br>";
	echo $c;
	}
?>
<!--unban-->  
<?php
if (isset($_POST["unbanip"]))
	{
	$unbanip = $_POST["unbanip"];
	$cleanip=str_replace(";","lol",$unbanip);
	echo "Banned IP=".$cleanip;
	$numbered = shell_exec("sudo ufw status numbered | cat -n | grep ".$cleanip." | awk '{print $1}'");
	$output = shell_exec("sudo ufw -f delete ".((int)$numbered-4));
	echo $output."<br>";
	}
?>
</br>
<?php
	echo "Deny IP List/Port";
	$output = shell_exec("sudo ufw status | grep DENY | awk '{print $3}'| head -n 10");
	echo "<pre>".$output."</pre>"
?>

<?php
	echo "Allow IP List/Port";
	$output = shell_exec("sudo ufw status | grep ALLOW | awk '{print $1,$2,$3}'|  head -n 10");
	echo "<pre>".$output."</pre>";
?>
