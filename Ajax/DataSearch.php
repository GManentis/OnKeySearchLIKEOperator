<?php

if (!empty($_POST["variablu"]) )
{
	
	$x = $_POST["variablu"];
	$x = str_replace("%","",$x);
	$x = str_replace("_","",$x);
	
	$x2 = $x;
	
	
	    $hostname_DB = "127.0.0.1";
		$database_DB = "projectword";
		$username_DB = "root";
		$password_DB = "";

		try 
		{
			$CONNPDO = new PDO("mysql:host=".$hostname_DB.";dbname=".$database_DB.";charset=UTF8", $username_DB, $password_DB, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_TIMEOUT => 3));
		} 
		catch (PDOException $e) 
		{
			$CONNPDO = null;
		}
		if ($CONNPDO != null && strlen($x2) > 0) 
		{
			$starttime = microtime(true);
			$x2 = $x2 . "%";
			$getdata_PRST = $CONNPDO->prepare("SELECT word FROM vocabulary WHERE word LIKE :var LIMIT 5");
			//$getdata_PRST->bindValue(":var", $x2 . "%");
			$getdata_PRST->bindParam(':var', $x2);
			$getdata_PRST->execute() or die($CONNPDO->errorInfo());
			$response = "";
			$z = "";
			while ($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$z = $getdata_RSLT["word"];
				$response .= $z . ",";
			}
			$time_elapsed_ms = (microtime(true) - $starttime)*1000;
		 echo $response . " # " . $time_elapsed_ms;	
	
	
	    }
		else
		{
		 echo "No PDO CONNECTION";
	    }
 }

	
	
?>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
