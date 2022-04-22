<?php

if (!empty($_POST["variablu"]) )
{
	
	$x = $_POST["variablu"];
	$x = str_replace("%","\%",$x); //best practice if we want to search by percent in Sql LIKE operator we must escape the string character
	//$x = str_replace("%","",$x); //we can also remove the character

	$x = str_replace("_","\_",$x); //best practice if we want to search by _ in Sql LIKE operator we must escape the string character
	
	/*Both above cases apply for LIKE in both eloquent laravel and unprepared statements as well*/
	/*In all other cases of not LIKE operation, both % and _ can be used normally as expected without escaping them*/

	/* 
	General Important Note for '' quotes:
	-In case our string contains ' quotes, if we use prepared statements(bindValue or bindParam) , the single quotes or automatically escaped
	This happens because the main reason prepeared statements (bindValue & bindParam) exist are to avoid SQL injection so they are automatically escaped
	That is one of the main reasons that we must ALWAYS use prepared statements
	- The same as above statement applies for Eloquent as well
	- For direct queries (neither eloquent nor prepared statements), if our string includes ' quotes, these in string quotes must be escaped
	- 
	*/
	
	
	
	
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
			$x2 = "%". $x2 . "%";
			$getdata_PRST = $CONNPDO->prepare("SELECT word FROM vocabulary WHERE word LIKE :var LIMIT 5");
			//$getdata_PRST->bindValue(":var", $x2 . "%");
			$getdata_PRST->bindParam(':var', $x2);
			$getdata_PRST->execute() or die($CONNPDO->errorInfo());
			$response = "";
			$z = "";
			while ($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$z = $getdata_RSLT["word"];
				$response .= $z . "<br>";
			}
			$time_elapsed_ms = (microtime(true) - $starttime)*1000;
		 echo $response . " <br># " . $time_elapsed_ms;	
	
	
	    }
		else
		{
		 echo "No PDO CONNECTION!!";
	    }
 }

 
	
	
?>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
