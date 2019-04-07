function searchWord()
{
	try 
	{				
		var xmlhttp;

		if (window.XMLHttpRequest) 
		{
			xmlhttp = new XMLHttpRequest();
			// most browsers
		} 
		else 
		{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			// internet explorer
		}
		
		var search;
		search = document.getElementById("srch").value;
		
		
		xmlhttp.onreadystatechange = function() 
		{			
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				var strOut;			
				strOut = xmlhttp.responseText;
			    //strOut2 = strOut.replace("}","");
				document.getElementById("result").innerHTML = strOut;
			}
		}
		
		xmlhttp.open("POST", "Ajax/DataSearch.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");			
		xmlhttp.send("variablu="+search);
	}
	catch(err) 
	{
		alert(err);
	}
}
	
	
	
	
	
	
	
	
	
	
	
