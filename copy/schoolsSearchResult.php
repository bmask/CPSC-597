<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="jquery.tzCheckbox/jquery.tzCheckbox.css" />
<script src="js/jquery.min.js"></script>
<script src="jquery.tzCheckbox/jquery.tzCheckbox.js"></script>
<script src="js/script.js"></script>
  <link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="js/jquery.min.tabs.js"></script>
  <script src="js/jquery-ui.min.tabs.js"></script>
<link rel="stylesheet" type="text/css" href="css/table.css" />
  <script>
  $(document).ready(function() {
    $("#tabs").tabs();
  });
  </script>
</head>
<!-- http://www.madebytj.com -->
<body bgcolor="#f2f2f2" >
 <style type="text/css"> 
 h2{font-family:Georgia ; font-style: italic;font-variant: small-caps; font-size: 2.5em; color: #C0C0C0; text-align:left; padding:0; margin-top:-80px;margin-bottom:100px;margin-right:50px;margin-left:50px;}
 h1 {font-size: 4.5em; font-family: "Brush Script MT", cursive; color: #fced01; text-align:left; padding:0; margin-top:-80px;margin-bottom:100px;margin-right:50px;margin-left:80px;}
 #help {padding:0; margin-top:-130px;margin-bottom:100px;margin-right:-700px;}
 #logo {position:relative; padding:0; margin-top:-130px;margin-bottom:200px;margin-right:-200px;margin-left:200px;}
#page {position:absolute; padding:0; margin-top:-320px;margin-bottom:200px;margin-right:-300px;margin-left:550px;}
#button {position:relative; padding:0; margin-top:-480px;margin-bottom:200px;margin-right:-230px;margin-left:260px;}
#button ul { list-style-type: none; }
 
</style>
<style type="text/css">
 .classname { 
	height: 40px; 
	width: 200px;  
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background-color:#ededed;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	color:#777777;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:1px 1px 0px #ffffff; 
}.classname:hover {
	background-color:#dfdfdf;
}.classname:active {
	position:relative;
	margin-top:1px;
}
 
</style>
<table border="0" width=100% height=100%>
<tr>
<td style="text-align: center; vertical-align: top;">
<img src="header.jpg" alt="header" />
<h1>University's Schools Info</h1> 
<img src="helpIcon.png" alt="help" id="help" />
</td>
</tr>
<tr>
<td>
<img src="logo.png" alt="logo" id="logo"/>
<div id="button">
 <ul>
	<li><button  class="classname" onClick="history.go(-1)"> << Previous Page</button></li>
	<li><button  class="classname" onclick="parent.location='MainPage.php'" > << Home Page </button></li>	
</ul>

</div>
<div id="page" style="font-size:62.5%;">  
  <div id="tabs">

	<?php
	   echo "<ul>";
        echo "<li><a href='#fragment-1'><span>Schools' Name</span></a></li>";
        echo "<li><a href='#fragment-2'><span>HomePage's Address</span></a></li>";
        echo "<li><a href='#fragment-3'><span>Homepages' Content</span></a></li>";
    echo "</ul>";
   // first tab	---------------------------------------------------------  
	echo "<div id='fragment-1'>";   
	session_start();
	$aDoor = $_POST['schoolInfo'];
	if(empty($aDoor))
	{
		header('Location:schools.php');
	}
	else
	{
		$selected = 0;
		$N = count($aDoor);
		for($i=0; $i < $N; $i++)
		{
			if($aDoor[$i]=="list")
			{
				$taylorsChosen=0;
				$selected=1;
				$s = count($_SESSION['view']);
				for($j=0; $j < $s; $j++)
				{
					if($_SESSION['view'][$j]=="taylors")
					{
						$taylorsChosen=1;
						$taylors= array("School of Architecture, Building and Design", "	School of Hospitality, Tourism and Culinary Arts", "School of Biosciences", "Language Centre","Taylor's Business School","Taylor's Law School","School of Communication","School of Medicine","School of Computing and IT","School of Pharmacy","The Design School","School of Engineering");				 
					}
					if($_SESSION['view'][$j]=="nottingham")
					{		
						$some_link = 'http://www.nottingham.edu.my/Departments/index.aspx';
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTMLFile($some_link); 
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;

						$filtered = $domxpath->query("// a" . '[@' . "class='sys_0 sys_t1003992']"); 
						$i = 1;
						$k=0;	
						while( $myItem = $filtered->item($i++) ){	
							$node = $newDom->importNode( $myItem, true );    // import node			 
							$newDom->appendChild($node);                    // append node
							$test = $newDom->saveHTML();					// convert to string
							if(strpos($test, "Foundation" ) ==true ){
								break;								// display node 
							}
							$nottingham [$k] = $test;								 
							$k++;
							$newDom->removeChild($node);					// reset object information 		 
						}							
	 						 					
					}
					if($_SESSION['view'][$j]=="sunway")
					{				
						$some_link = 'http://sunway.edu.my/university/undergraduate';
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTMLFile($some_link);
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;

						$filtered = $domxpath->query("//li" . '[@' . "class='leaf']");
						$i = 4;
						$k=0;
						while( $myItem = $filtered->item($i++) ){	
							$node = $newDom->importNode( $myItem, true );    // import node			 
							$newDom->appendChild($node);                    // append node
							$test = $newDom->saveHTML();					// convert to string
							$sunway [$k] = $test;								 
							$k++;
							$newDom->removeChild($node);					// reset object information 
						}
						 				
					}

					if($_SESSION['view'][$j]=="KDU")
					{
						$some_link = 'http://www.kdu.edu.my/programmes';
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTMLFile($some_link);
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;
						$filtered = $domxpath->query("//p" . '[@' . "style='line-height: 14px;']");
						$i = 0;
						$myItem = $filtered->item($i++) ;
						$out= $myItem->nodeValue;	
						$out = str_replace("PROGRAMMES", " ", $out);
						$KDU = explode("•", $out);
						$N = count($KDU);
						for($i=1; $i < $N; $i++)
						{
							$KDU[$i-1] = "School ".$KDU[$i];
						}
						unset($KDU [$N-1]);
					}
					
					if($_SESSION['view'][$j]=="UCSI")
					{
						$some_link = 'http://lms.ucsi.edu.my/academic-programmes;jsessionid=C68AFEF8EBBB9D37D18CE55DF0F1549E';
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTMLFile($some_link);
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;					
						$filtered = $domxpath->query("//ul" . '[@' . "class='child-menu']");					  
						$myItem = $filtered->item(2);
						$out= $myItem->nodeValue;	
						$out = trim ($out);
						$UCSI = explode("Faculty", $out);
						$N = count($UCSI);
						$O[$N] = explode("Centre", $UCSI[$N-1]);
						$UCSI[$N-1] = $O[$N][0];
						for($i=1; $i < $N; $i++)
						{
							$UCSI[$i-1] = "School ".$UCSI[$i];
						}
					
					}
				}
				// Display Table
				echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>Taylors University's school</th>";
							echo "<th>nottingham University's school</th>";
							echo "<th>Sunway's University's school</th>";
							echo "<th>KDU's University's school</th>";
							echo "<th>UCSI's University's school</th>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					for($i=0; $i < 21; $i++)
					{
						echo "<tr>";
						if ($taylorsChosen==1)
						{
							if (isset($taylors[$i]))
							{
								echo "<td width='33%'><strong>".$taylors[$i]."</strong></td>";
							}else{echo "<td> --- </td>";}
						} else{echo "<td> --- </td>";}
						if (isset($nottingham[$i]))
						{
						echo "<td width='33%'><strong>".$nottingham[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}
						if (isset($sunway[$i]))
						{
						echo "<td width='33%'><strong>".$sunway[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}	
						if (isset($KDU[$i]))
						{
						echo "<td width='33%'><strong>".$KDU[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}	
						if (isset($UCSI[$i]))
						{
						echo "<td width='33%'><strong>".$UCSI[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}						
						echo "</tr>";
					}
					echo "</tbody>";
				echo "</table>";
			}     
		}
	if($selected==0) {echo "This Item is not Selected"; } 
	} 			
   echo " </div>";
   
   // second tab	---------------------------------------------------------
   echo " <div id='fragment-2'>"; 
   	$selected = 0;
    $N = count($aDoor);
    for($i=0; $i < $N; $i++)
    {
		if($aDoor[$i]=="page")
		{
			$selected=1;
			//echo("You selected $N University(s): ");
			// get the universities name
			$s = count($_SESSION['view']);
			for($j=0; $j < $s; $j++)
			{
				if($_SESSION['view'][$j]=="taylors")
				{
					echo "</br><u><b>Taylors University - School</b></u>";
					echo "<br/><b>Web Address:	</b><br/>http://www.taylors.edu.my/en/university/schools		<a href='http://www.taylors.edu.my/en/university/schools' target='_blank'><font color='blue'>click on</font></a><br/>";
				}
				if($_SESSION['view'][$j]=="nottingham")
				{
					echo "</br><u><b>Nottingham University - School</b></u>";
					echo "<br/><b>Web Address:	</b><br/>http://www.nottingham.edu.my/Departments/index.aspx		<a href='http://www.nottingham.edu.my/Departments/index.aspx' target='_blank'><font color='blue'>click on</font></a><br/>";
				}
				if($_SESSION['view'][$j]=="sunway")
				{
					echo "</br><u><b>Sunway University - School</b></u>";
					echo "<br/><b>Web Address:	</b><br/>http://sunway.edu.my/university/undergraduate		<a href='http://sunway.edu.my/university/undergraduate' target='_blank'><font color='blue'>click on</font></a><br/>";
				}
				if($_SESSION['view'][$j]=="KDU")
				{
					echo "</br><u><b>KDU University - School</b></u>";
					echo "<br/><b>Web Address:	</b><br/>http://www.kdu.edu.my/programmes		<a href='http://www.kdu.edu.my/programmes' target='_blank'><font color='blue'>click on</font></a><br/>";
				}
				if($_SESSION['view'][$j]=="UCSI")
				{
					echo "</br><u><b>UCSI University - School</b></u>";
					echo "<br/><b>Web Address:	</b><br/>http://lms.ucsi.edu.my/academic-programmes;jsessionid=C68AFEF8EBBB9D37D18CE55DF0F1549E		<a href='http://lms.ucsi.edu.my/academic-programmes;jsessionid=C68AFEF8EBBB9D37D18CE55DF0F1549E' target='_blank'><font color='blue'>click on</font></a><br/>";
				}					
			}			
		}      
    }
	if($selected==0) {echo "This Item is not Selected"; } 	
   echo  "</div>";
   // third tab	---------------------------------------------------------
   echo "<div id='fragment-3'>";
	$selected = 0;
    for($i=0; $i < $N; $i++)
    {
		if($aDoor[$i]=="content")
		{
			$selected=1;
			// get the universities name
			$s = count($_SESSION['view']);
			for($j=0; $j < $s; $j++)
			{
				if($_SESSION['view'][$j]=="taylors")

				{		
					echo "</br><u><b>Taylors University - School</b></u>";	
					$tags = get_meta_tags('http://www.taylors.edu.my/en/university/schools');
					echo "</br><b>Page Content:	</b><br/>".$tags['description']."... <a href='http://www.taylors.edu.my/en/university/schools' target='_blank'><font color='blue'>Read More</font></a><br/>";

				}

			 	if($_SESSION['view'][$j]=="nottingham")
			 	{
					echo "</br><u><b>Nottingham University - School</b></u>";
 			 		echo "</br><b>Page Content:	</b><br/>The Page Does Not Include any Content... <a href='http://www.nottingham.edu.my/Departments/index.aspx' target='_blank'><font color='blue'>Read More</font></a><br/>";
			 	}
			 	if($_SESSION['view'][$j]=="sunway")
			 	{
			 		$tags = get_meta_tags('http://sunway.edu.my/university/undergraduate');
					// make the sentence short...
					$cut = strpos($tags['description'], '.'); 
					$brief = substr($tags['description'], 0, $cut+1);
					echo "</br><u><b>Sunway University - School</b></u>";
			 		echo "</br><b>Page Content:	</b><br/>".$brief."... <a href='http://sunway.edu.my/university/undergraduate' target='_blank'><font color='blue'>Read More</font></a><br/>";
			 	}
			 	if($_SESSION['view'][$j]=="KDU")
			 	{
					$tags = get_meta_tags('http://www.kdu.edu.my/programmes');
					// make the sentence short...
					$cut = strpos($tags['description'], '.'); 
					$brief = substr($tags['description'], 0, $cut+1);
					echo "</br><u><b>KDU University - School</b></u>";
			 		echo "</br><b>Page Content:	</b><br/>".$brief."... <a href='http://www.kdu.edu.my/programmes' target='_blank'><font color='blue'>Read More</font></a><br/>";
			 	}
			 	if($_SESSION['view'][$j]=="UCSI")
			 	{
					$tags = get_meta_tags('http://lms.ucsi.edu.my/academic-programmes;jsessionid=C68AFEF8EBBB9D37D18CE55DF0F1549E');
					// make the sentence short...
					echo "</br><u><b>UCSI University - School</b></u>";
			 		echo "</br><b>Page Content:	</b><br/>".$tags['description']."... <a href='http://lms.ucsi.edu.my/academic-programmes;jsessionid=C68AFEF8EBBB9D37D18CE55DF0F1549E' target='_blank'><font color='blue'>Read More</font></a><br/>";
			 	}					
			}			
		}      
    } 
	if($selected==0) {echo "This Item is not Selected"; } 		
    echo "</div>";
	?>
</div>  
</div>
</td> 
</tr>
</table>
</body>
</html>