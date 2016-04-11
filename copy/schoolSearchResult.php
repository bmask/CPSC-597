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
<script type="text/javascript" src="js/jMenu-VerticalTab.js"></script> 
<link rel="stylesheet" type="text/css" href="css/vertical-Tab.css" />
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
<h1>University's School Info</h1> 
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
        echo "<li><a href='#fragment-1'><span>Programmes Offered </span></a></li>";
        echo "<li><a href='#fragment-2'><span>HomePage's Address & Content</span></a></li>";
		echo "<li><a href='#fragment-3'><span>News & Events</span></a></li>";
    echo "</ul>";
   // first tab	---------------------------------------------------------  
	echo "<div id='fragment-1'>";   
	session_start();
	$arraySchool = $_POST['schoolInfo'];
	if(empty($arraySchool))
	{
		header('Location:schools.php');
	}
	else
	{
		$selected = 0;
		$N = count($arraySchool);
		for($i=0; $i < $N; $i++)
		{
			if($arraySchool[$i]=="program")
			{
				$selected=1;
				$s = count($_SESSION['view']);
				for($j=0; $j < $s; $j++)
				{
					if($_SESSION['view'][$j]=="taylors")
					{
						$some_link = 'http://www.taylors.edu.my/en/university/schools/computing';
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTMLFile($some_link);
						 
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;

						$filtered = $domxpath->query("// a" . '[@' . "class='link_computing']");
						$i = 0;
						$k = 0;
						while( $myItem = $filtered->item($i++) ){	
							$node = $newDom->importNode( $myItem, true );    // import node			 
							$newDom->appendChild($node);                    // append node
							$test = $newDom->saveHTML();					// convert to string
							$taylors [$k]= $test ;
							$k++;
							$newDom->removeChild($node);					// reset object information 
						}						
					}
					
					if($_SESSION['view'][$j]=="nottingham")
					{		
						$some_link = 'http://www.nottingham.edu.my/ComputerScience/Courses/Undergraduate/index.aspx';
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTMLFile($some_link);

						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;

						$filtered = $domxpath->query("//a" . '[@' . "class='sys_0 sys_t957291']");
						$key1 = 'Diploma '; 
							$key2 = "BSc"; 
							$i = 0;
							$k = 0;
							while( $myItem = $filtered->item($i++) ){
							
								$node = $newDom->importNode( $myItem, true );    // import node			 
								$newDom->appendChild($node);                    // append node
								$test = $newDom->saveHTML();					// convert to string
								// search for keyword
								if(strpos($test, $key1 ) ==true ){
									$nottingham [$k] = $test;								 
									$k++;							 
								}
								if(strpos($test, $key2 ) ==true ){
									$nottingham [$k] = $test;								 
									$k++;		
								}
								$newDom->removeChild($node);					// reset object information 
							}	 						 					
					}
					
					if($_SESSION['view'][$j]=="sunway")
					{
						$some_link = 'http://sunway.edu.my/university/sct';
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTMLFile($some_link);

						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;

						$filtered = $domxpath->query("// li" . '[@' . "class='expanded']");
						$key1 = 'Diploma '; 
						$key2 = "BSc"; 
						$i = 0;
						$k = 0;
						while( $myItem = $filtered->item($i++) ){							
							$node = $newDom->importNode( $myItem, true );    // import node			 
							$newDom->appendChild($node);                    // append node
							$test = $newDom->saveHTML();					// convert to string
							// search for keyword
							if(strpos($test, $key1 ) ==true ){
								$replace = $test;
								$newString = str_replace("Entry Requirements", "  ", $replace);
								$newString = str_replace("Programme Structure", "  ", $newString);
								$sunway [$k] = $newString;								 
								$k++;
								}
							if(strpos($test, $key2 ) ==true ){
								$replace = $test;
								$newString = str_replace("Entry Requirements", "  ", $replace);
								$newString = str_replace("Programme Structure", "  ", $newString);
								$sunway [$k] = $newString;								 
								$k++;
								}
							$newDom->removeChild($node);					// reset object information 
							}						 				
					}	

					if($_SESSION['view'][$j]=="KDU")
					{					
						$some_link = 'http://www.kdu.edu.my/programmes/information-technology.html';
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTMLFile($some_link);
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;
						$filtered = $domxpath->query("//span" . '[@' . "style='color: #0066cc;']"); 
						$key = "href";
						$i = 2;
						$k = 0;
						// get the tags
						while( $myItem = $filtered->item($i++) ){	
						   $node = $newDom->importNode( $myItem, true );    // import node			 
							$test = $newDom->appendChild($node);                    // append node		
							$tagName[$k] = $newDom->saveHTML(); 				 	
							$k++;	
							$newDom->removeChild($node);					// reset object information 
						}
						// function to get the tags attributes variables
						function getAttribute($attrib, $tag){
						  //get attribute from html tag
						  $re = '/'.$attrib.'=["\']?([^"\' ]*)["\' ]/is';
						  preg_match($re, $tag, $match);
						  if($match){
							return urldecode($match[1]);
						  }else {
							return false;
						  }
						}	
						// get the tags attributes variable 
						$D = count ($tagName);
						$k = 0;
						for ($i=0;$i<$D;$i++)
						{		
							$attr = getAttribute('href', $tagName[$i]);
							$attr = str_replace("/", " ", $attr);
							$attr = str_replace("-", " ", $attr);
							if(!empty($attr)){
								$KDU[$k] = $attr;
								$k++;			
							}
						}			
					}	

					if($_SESSION['view'][$j]=="UCSI")
					{
						$some_link = 'http://lms.ucsi.edu.my/faculty-of-business-and-information-science';
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTMLFile($some_link);
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;
						$filtered = $domxpath->query("//a" . '[@' . "class='xcolor2 xu']");
						$i = 0;
						$k = 0;
						while( $myItem = $filtered->item($i++) ){
							$out= $myItem->nodeValue;	
							if(strpos($out, "Information" ) ==true || strpos($out, "Computing" ) ==true )		
							{
								$UCSI[$k] = $out;
								$k++;
							}
						}					
					}						
				}	
					// Display Table
				echo "<table class='display' cellspacing='1'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>Taylors University</th>";
							echo "<th>nottingham University</th>";
							echo "<th>Sunway University</th>";	
							echo "<th>KDU University</th>";
							echo "<th>UCSI University</th>";							
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					for($i=0; $i < 10; $i++)
					{
						echo "<tr>";
						if (isset($taylors[$i]))
						{
							echo "<td width='20%'><strong>".$taylors[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}					
						if (isset($nottingham[$i]))
						{
							echo "<td width='20%'><strong>".$nottingham[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}
						if (isset($sunway[$i]))
						{
							echo "<td width='20%'><strong>".$sunway[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}	
						if (isset($KDU[$i]))
						{
							echo "<td width='20%'><strong>".$KDU[$i]."</strong></td>";
						}else{echo "<td> --- </td>";}	
						if (isset($UCSI[$i]))
						{
							echo "<td width='20%'><strong>".$UCSI[$i]."</strong></td>";
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
	$pageSelected=0;
	$contentSelected=0;
    $N = count($arraySchool);
    for($i=0; $i < $N; $i++)
    {
		if($arraySchool[$i]=="page")
		{$pageSelected=1;}
		if($arraySchool[$i]=="content")
		{$contentSelected=1;}
		if($arraySchool[$i]=="page" || $arraySchool[$i]=="content")
		{
			$selected=1;
			$Tselected;
			$Nselected;
			$Sselected;
			if($arraySchool[$i]=="page")
			{
				$Tselected=0;
				$Nselected=0;
				$Sselected=0;
				$Kselected=0;
				$Uselected=0;
				// get the universities name
				$s = count($_SESSION['view']);
				for($j=0; $j < $s; $j++)
				{
					if($_SESSION['view'][$j]=="taylors")
					{
						$Tselected=1;
						//echo "<br/>http://www.taylors.edu.my/en/university/schools/computing		<a href='http://www.taylors.edu.my/en/university/schools/computing' target='_blank'>click on</a>";
					}
					if($_SESSION['view'][$j]=="nottingham")
					{
						$Nselected=1;
						//echo "<br/>http://www.nottingham.edu.my/ComputerScience/index.aspx		<a href='http://www.nottingham.edu.my/ComputerScience/index.aspx' target='_blank'>click on</a>";
					}
					if($_SESSION['view'][$j]=="sunway")
					{
						$Sselected=1;
						//echo "<br/>http://sunway.edu.my/university/sct		<a href='http://sunway.edu.my/university/sct' target='_blank'>click on</a>";
					}	
					if($_SESSION['view'][$j]=="KDU")
					{
						$Kselected=1;
					}	
					if($_SESSION['view'][$j]=="UCSI")
					{
						$Uselected=1;
					}						
				}
			}  
 			if($arraySchool[$i]=="content")
			{
				// get the universities name
				$s = count($_SESSION['view']);
				for($j=0; $j < $s; $j++)
				{				
 					if($_SESSION['view'][$j]=="nottingham")
					{	
						$some_link = 'http://www.nottingham.edu.my/ComputerScience/index.aspx';
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTMLFile($some_link);  
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;
							
						$filtered = $domxpath->query("//p");
						$myItem = $filtered->item(1);
						$node = $newDom->importNode( $myItem, true );    // import node			 
						$newDom->appendChild($node);                    // append node
						$test = $newDom->saveHTML();					// convert to string
						// make the sentence short...
						$cut = strpos($test, '.'); 
						echo "</br><u><b>Nottingham University - Computing School</b></u>";
						if (!empty($Nselected))
						{
							if ($Nselected==1)
							{
								echo "<br/><b>Web Address:	</b><br/>http://www.nottingham.edu.my/ComputerScience/index.aspx		<a href='http://www.nottingham.edu.my/ComputerScience/index.aspx' target='_blank'><font color='blue'>click on</font></a>";
							}
						}
						echo "</br><b>Page Content:	</b><br/>".substr($test, 0, $cut+29)."... <a href='http://www.nottingham.edu.my/ComputerScience/index.aspx' target='_blank'><font color='blue'>Read More</font></a><br/>";			// display node info 
						$newDom->removeChild($node);					// reset object information 
					}
					if($_SESSION['view'][$j]=="sunway")
					{
						$some_link = 'http://sunway.edu.my/university/sct';
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTMLFile($some_link);  
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;
							
						$filtered = $domxpath->query("//p");

						$myItem = $filtered->item(1);
						$node = $newDom->importNode( $myItem, true );    // import node			 
						$newDom->appendChild($node);                    // append node
						$test = $newDom->saveHTML();					// convert to string
						// make the sentence short...
						$cut = strpos($test, '.');

						echo "</br><u><b>Sunway University - Computing School</b></u>";	
						if (!empty($Sselected))
						{
							if ($Sselected==1)
							{
								echo "<br/><b>Web Address:	</b><br/>http://sunway.edu.my/university/sct		<a href='http://sunway.edu.my/university/sct' target='_blank'><font color='blue'>click on</font></a>";
							}	
						}						
						echo "</br><b>Page Content:	</b><br/>".substr($test, 0, $cut+1)."... <a href='http://sunway.edu.my/university/sct' target='_blank'><font color='blue'>Read More</font></a><br/>";			// display node info 
						$newDom->removeChild($node);					// reset object information 					
					}
					if($_SESSION['view'][$j]=="taylors")
					{				
						$tags = get_meta_tags('http://www.taylors.edu.my/en/university/schools/computing');
						echo "</br><u><b>Taylors University - Computing School</b></u>";
						if (!empty($Tselected))
						{
							if ($Tselected==1)
							{
								echo "<br/><b>Web Address:	</b><br/>http://www.taylors.edu.my/en/university/schools/computing		<a href='http://www.taylors.edu.my/en/university/schools/computing' target='_blank'><font color='blue'>click on</font></a>";
							}
						}
						echo "<br/><b>Page Content:	</b><br/>".$tags['description']."... <a href='http://www.taylors.edu.my/en/university/schools/computing' target='_blank'><font color='blue'>Read More</font></a><br/>";	;  // a php manual
					}
					if($_SESSION['view'][$j]=="KDU")
					{				
						$tags = get_meta_tags('http://www.kdu.edu.my/programmes/information-technology.html');
						echo "</br><u><b>KDU University - Computing School</b></u>";
						if (!empty($Kselected))
						{
							if ($Kselected==1)
							{
								echo "<br/><b>Web Address:	</b><br/>http://www.kdu.edu.my/programmes/information-technology.html		<a href='http://www.kdu.edu.my/programmes/information-technology.html' target='_blank'><font color='blue'>click on</font></a>";
							}
						}
						echo "<br/><b>Page Content:	</b><br/>".$tags['description']."... <a href='http://www.kdu.edu.my/programmes/information-technology.html' target='_blank'><font color='blue'>Read More</font></a><br/>";	;  // a php manual
					}
					if($_SESSION['view'][$j]=="UCSI")
					{
						$some_link = 'http://lms.ucsi.edu.my/faculty-of-business-and-information-science';
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						@$dom->loadHTMLFile($some_link);  
						$domxpath = new DOMXPath($dom);
						$newDom = new DOMDocument;
						$newDom->formatOutput = true;						
						$filtered = $domxpath->query("//td" . '[@' . "style='text-align: justify']");
						$i = 0;
						$myItem = $filtered->item($i++)  ;
						$out= $myItem->nodeValue;
						// make the sentence short...
						$cut = strpos($out, '.'); 
						//echo "<li/>".substr($out, 0, $cut+1)."...";			// display node info 
						//echo "... <a href='http://lms.ucsi.edu.my/faculty-of-business-and-information-science' target='_blank'>Read More</a>";	;  // a php manual
						echo "</br><u><b>UCSI University - Computing School</b></u>";	
						if (!empty($Uselected))
						{
							if ($Uselected==1)
							{
								echo "<br/><b>Web Address:	</b><br/>http://lms.ucsi.edu.my/faculty-of-business-and-information-science		<a href='http://lms.ucsi.edu.my/faculty-of-business-and-information-science' target='_blank'><font color='blue'>click on</font></a>";
							}	
						}						
						echo "</br><b>Page Content:	</b><br/>".substr($out, 0, $cut+1)."... <a href='http://lms.ucsi.edu.my/faculty-of-business-and-information-science' target='_blank'><font color='blue'>Read More</font></a><br/>";			// display node info 
					}
					
				}
			}
		}      
    } 
	// if web address is selected but content page is not selected 
	if ($pageSelected==1 && $contentSelected==0)
	{	
		// get the universities name
		$s = count($_SESSION['view']);
		for($j=0; $j < $s; $j++)
		{
			if($_SESSION['view'][$j]=="taylors")
			{
				echo "</br><u><b>Taylors University - Computing School</b></u>";				
				echo "<br/><b>Web Address:	</b><br/>http://www.taylors.edu.my/en/university/schools/computing		<a href='http://www.taylors.edu.my/en/university/schools/computing' target='_blank'><font color='blue'>click on</font></a><br/>";
			}
			if($_SESSION['view'][$j]=="nottingham")
			{
				echo "</br><u><b>Nottingham University - Computing School</b></u>";		
				echo "<br/><b>Web Address:	</b><br/>http://www.nottingham.edu.my/ComputerScience/index.aspx		<a href='http://www.nottingham.edu.my/ComputerScience/index.aspx' target='_blank'><font color='blue'>click on</font></a><br/>";
			}
			if($_SESSION['view'][$j]=="sunway")
			{
				echo "</br><u><b>Sunway University - Computing School</b></u>";						
				echo "<br/><b>Web Address:	</b><br/>http://sunway.edu.my/university/sct		<a href='http://sunway.edu.my/university/sct' target='_blank'><font color='blue'>click on</font></a></br>";
			}
			if($_SESSION['view'][$j]=="KDU")
			{
				echo "</br><u><b>KDU University - Computing School</b></u>";						
				echo "<br/><b>Web Address:	</b><br/>http://www.kdu.edu.my/programmes/information-technology.html		<a href='http://www.kdu.edu.my/programmes/information-technology.html' target='_blank'><font color='blue'>click on</font></a></br>";
			}	
			if($_SESSION['view'][$j]=="UCSI")
			{
				echo "</br><u><b>UCSI University - Computing School</b></u>";						
				echo "<br/><b>Web Address:	</b><br/>http://lms.ucsi.edu.my/faculty-of-business-and-information-science		<a href='http://lms.ucsi.edu.my/faculty-of-business-and-information-science' target='_blank'><font color='blue'>click on</font></a></br>";
			}			
		}
	}
	if($selected==0) {echo "This Item is not Selected"; }     
   echo  "</div>";
   // third tab	---------------------------------------------------------
   echo "<div id='fragment-3'>";   
   $selected = 0;
    $N = count($arraySchool);
    for($i=0; $i < $N; $i++)
    {
		if($arraySchool[$i]=="news")
		{
			$selected = 1;
			echo "<div class='accordian'>";
			echo "<ul>";
			$s = count($_SESSION['view']);
			for($j=0; $j < $s; $j++)
			{	
			if($_SESSION['view'][$j]=="taylors"){		
				echo "<li>Taylor's University</li>";
				echo "<li><b>taylors' computing school's news & events ; </b>"."<a href='http://www.taylors.edu.my/en/university/schools/computing/news_and_events?q=14/5,102,98,100,101/0/4629#view' target='_blank'>click here </a></li>";
			}
			if($_SESSION['view'][$j]=="sunway"){
				echo "<li>Sunway University</li>";
				echo "<li>";		
					echo "<b>Sunway University's computing school's news & events ; </b>"."<a href='http://sunway.edu.my/university/sct/news-events' target='_blank'>click here</a>";
					$some_link = 'http://sunway.edu.my/university/sct/news-events';
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link);			 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					$filtered = $domxpath->query("// span" . '[@' . "style='color:#00f;']");
					$i = 0;
					while( $myItem = $filtered->item($i++) ){
						echo "<br/><font size='1' face='arial' color='blue'>".$out= $myItem->nodeValue."</font>"; 
					}	
				echo "</li>";
			}
			if($_SESSION['view'][$j]=="nottingham"){
				echo "<li>Nottingham University</li>";
				echo "<li>"; 		
					echo "<b>nottingham University's computing school's news & events ; </b>"."<a href='http://www.nottingham.edu.my/ComputerScience/News/index.aspx' target='_blank'>click here</a>";
					$some_link = 'http://www.nottingham.edu.my/ComputerScience/News/index.aspx';
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link);			 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					$filtered = $domxpath->query("//h3");
					$i = 1;
					while( $myItem = $filtered->item($i++) ){
						if($i>10){ 
							echo "<br/><font size='1' face='arial' color='blue'>.....</font>";
							break;
						}
						echo "<br/><font size='1' face='arial' color='blue'>".$out= $myItem->nodeValue."</font>"; 
					}			
				echo "</li>";
				}
			if($_SESSION['view'][$j]=="KDU"){
				echo "<li>KDU University</li>";
				echo "<li>"; 		
					echo "<b>KDU's computing school's news & events ; </b>No Proper Information is Found  "."<a href='http://www.kdu.edu.my/programmes/information-technology.html' target='_blank'>click here </a>";			
				echo "</li>";
				}
			if($_SESSION['view'][$j]=="UCSI"){
				echo "<li>UCSI University</li>";
				echo "<li>"; 	
					$some_link = 'http://www.ucsi.edu.my/v2/fobis/';				
					echo "<b>UCSI's computing school's news & events ; </b>"."<a href='$some_link' target='_blank'>click here </a>";								
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link); 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					$filtered = $domxpath->query("// a" . '[@' . "class='xcolor5']");
					$i = 0;
					while( $myItem = $filtered->item($i++) ){
						echo "<br/><font size='1' face='arial' color='blue'>".$out= $myItem->nodeValue."</font>"; 
					}
				echo "</li>";
				}
			}
			echo "</ul>";
			echo "</div>";
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